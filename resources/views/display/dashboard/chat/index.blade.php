<x-layouts.navigation>
    <x-slot name="script">
        <script type="module">
            import { StreamChat } from 'https://cdn.jsdelivr.net/npm/stream-chat'

            //GETSTREAM API AUTHORIZATION
            const apiKey = "{{ env('STREAM_API_KEY') }}"
            const userId = "{{ Auth::user()->id_user }}"
            const userToken = "{{ $streamToken ?? '' }}"
            const client = new StreamChat(apiKey)

            let cardContact = []
            let activeChannel = null
            let activedUser = []
            let pendingMessage = []

            async function connect() {
                await client.connectUser({
                            id: userId,
                            name: "{{ $user->user_detail->first_name }} {{ $user->user_detail->last_name }}",
                        },
                        userToken)
            }

            connect()

            $(document).ready(function() {
                async function sendMessage() {
                    if (activeChannel === null) {
                        return
                    }
                    const messageInput = $("#chatBox")
                    const text = messageInput.val()
                    if (text) {
                        let clone = $("#chat-card_sample").clone()
                        clone.find('[name="message"]').html(text)
                        clone.find('[name="time"]').html(formatLastChatTime(new Date()))
                        clone.removeClass("hidden")

                        pendingMessage.push({
                            object: clone
                        })

                        chatContainer.append(clone[0])
                        scrollBottom()
                        $.ajax({
                            url: "{{ route('chat.sendMessage') }}",
                            type: 'POST',
                            data: {
                                channel_type: activeChannel.channel.type,
                                id_channel: activeChannel.id,
                                message: text
                            },
                            success: function(response) {
                                if (response.success) {

                                }
                            },
                            error: function(xhr) {
                                console.log(xhr)
                            }
                        })
                        messageInput.val('')
                    }
                }

                async function onChatChange() {
                    if (activeChannel !== null) {
                        if (!isTyping) {
                            clearTimeout(isTyping)
                            isTyping = setTimeout(async () => {
                                await activeChannel.channel.stopTyping()
                                isTyping = false
                            }, 2000)
                        }

                        await activeChannel.channel.keystroke()
                    }
                }

                $("#chatSubmit").click(function() {
                    sendMessage()
                })
                $("#chatBox").onEnter(function() {
                    sendMessage()
                })
                let isTyping = false
                $("#chatBox").on('input', function() {
                    onChatChange()
                })
                $("#reset_button").click(function() {
                    resetChannel()
                })
            })

            function scrollBottom() {
                $("#chatContainer").parent().animate({
                    scrollTop: $("#chatContainer").height()
                }, 0)
            }

            function formatLastChatTime(updatedAt) {
                const now = new Date()
                const lastChatTime = new Date(updatedAt)

                const isToday =
                    lastChatTime.toDateString() === now.toDateString()
                const isYesterday =
                    new Date(now.setDate(now.getDate() - 1)).toDateString() === lastChatTime.toDateString()

                if (isToday) {
                    return lastChatTime.toLocaleTimeString([], {
                        hour: '2-digit',
                        hour12: true,
                        minute: '2-digit'
                    })
                } else if (isYesterday) {
                    return "Yesterday"
                } else {
                    return lastChatTime.toLocaleDateString()
                }
            }

            let bounceChat = false
            let intervalBounce = false
            async function openChat(id_channel, compspace_name) {
                pendingMessage = []
                if (bounceChat) {
                    if (!intervalBounce) {
                        intervalBounce = setInterval(() => {
                            if (!bounceChat) {
                                clearInterval(intervalBounce)
                                intervalBounce = false
                                openChat(id_channel, compspace_name)
                            }
                        }, 10)
                    }
                    return
                }
                
                bounceChat = true

                function checkRead(channel, created_at) {
                    let allMember = true
                        Object.keys(channel.state.members).forEach(key => {
                            if (key === userId) {
                                return
                            }
                            const member = channel.state.members[key]
                            const messageTimestamp = new Date(created_at)
                            const userLastRead = new Date(channel.state.read[member.user.id].last_read)
                            if (messageTimestamp > userLastRead) {
                                allMember = false
                                return true
                            }
                        })

                        return allMember
                }

                function createText(isEvent, message, time, messageOwnerId, username) {
                    let clone

                    if (messageOwnerId === userId) {
                        if (isEvent !== undefined && pendingMessage.length > 0) {
                            let pendObject = pendingMessage[0].object
                            pendingMessage.pop()
                            let allMembers = checkRead(channel, isEvent.created_at)
                            
                            pendObject.attr('id', isEvent.message.id)
                            pendObject.removeClass("hidden")
                            pendObject.find('[name="signal"]').removeClass("hidden")
                            pendObject.find('[name="sent-signal"]').remove()
                            clone = pendObject
                            if (allMembers) {
                                pendObject.find('[name="signal"]').addClass('!fill-[#12B740]')
                            } else {
                                pendObject.find('[name="signal"]').removeClass('!fill-[#12B740]')
                            }
                            
                            return clone
                        }
                        clone = $("#chat-card_sample").clone()
                    } else {
                        clone = $("#chat-opp-card_sample").clone()
                    }

                    clone.removeClass('hidden')
                    
                    clone.find("a[name='message']").html(message)
                    clone.find("a[name='time']").html(formatLastChatTime(time))
                    clone.find("a[name='username']").html(username)

                    return clone
                }

                const onMessageNew = async (event) => {
                    await activeChannel.channel.markRead()

                    let clone = createText(event, event.message.text, event.message.updated_at, event.message.user.id, event.message.user.name)

                    chatContainer.append(clone)
                    scrollBottom()
                }
                const onMessageRead = async (event) => {
                    if (event.user.id === userId) {
                        return
                    }

                    setTimeout(function() {
                        $("#chatContainer").find('[name="signal"]').each(function() {
                            $(this).removeClass("hidden")
                            $(this).addClass('!fill-[#12B740]')
                        })
                    }, 1000)
                }

                if (activeChannel !== undefined && activeChannel !== null) {
                    activeChannel.channel.off('message.new', activeChannel.event)
                    activeChannel.channel.off('message.read', activeChannel.eventRead)
                }

                const channel = client.channel(cardContact[id_channel]['type'], id_channel)
                const state = await channel.watch({
                    presence: true
                })

                await channel.markRead()
                cardContact[id_channel].read()

                activeChannel = {
                    id: id_channel,
                    state: state,
                    channel: channel,
                }

                let chatContainer = $("#chatContainer")
                chatContainer.empty()

                function createForAlreadyMessage(event) {
                    let clone = createText(undefined, event.text, event.updated_at, event.user.id, event.user.name)
                    if (event.user.id === userId) {
                        let allMember = checkRead(channel, event.created_at)
     
                        clone.find('[name="signal"]').removeClass("hidden")
                        clone.find('[name="sent-signal"]').remove()
                        if (allMember) {
                            clone.find('[name="signal"]').addClass('!fill-[#12B740]')
                        }
                        else {
                            clone.find('[name="signal"]').removeClass('!fill-[#12B740]')
                        }
                        clone.attr('id', event.id)
                    }
                    chatContainer.append(clone)
                }

                activeChannel.channel.state.messages.forEach(event => {
                    createForAlreadyMessage(event)
                })
                activeChannel.event = onMessageNew
                activeChannel.eventRead = onMessageRead
                activeChannel.channel.on('message.new', activeChannel.event)
                activeChannel.channel.on('message.read', activeChannel.eventRead)
                let profileChannel = $("#profileChannel")
                profileChannel.attr('type', activeChannel.channel.type)

                $("#channelName").html(compspace_name)
                $("#overview").removeClass('hidden')

                scrollBottom()
                bounceChat = false
            }

            function updatePerChannel(data) {
                let object = cardContact[data.channel.id]['object']
                let getUnreadMessage = cardContact[data.channel.id]['channel'].state.read[userId]['unread_messages']
                let hideUnread = 'hidden'
                let online = 'hidden'
                if (getUnreadMessage > 0) {
                    hideUnread = ''
                }

                object.click(function() {
                    openChat(data.channel.id, data.channel.compspace_name)
                })
            }

            function createChannel(data) {
                let channelContainer = $("#channelContainer")
                if (cardContact[data.channel.id] !== undefined) {
                    return
                }

                let channel = data.channel
                let type = channel.type
                let member = data.members
                let messages = data.messages
                let id_channel = data.channel.id

                let clone = $("#chat-channel-sample").clone()
                clone.attr("id", id_channel)
                clone.removeClass('hidden')

                function update() {
                    clone.removeClass("animate-pulse")
                    clone.removeClass("bg-[#ebebeb]")

                    let new_channel = cardContact[id_channel]['channel']
                    let compspace_name = new_channel.data.compspace_name
                    console.log(new_channel.state)
                    let messageSets = new_channel.state.messageSets[0].messages
                    let getLastChatTime = messageSets.length > 0 ? formatLastChatTime(messageSets[messageSets.length - 1].updated_at) : '00:00'
                    let getLastMessage = messageSets.length > 0 ? messageSets[messageSets.length - 1].text : 'No message'
                    clone.find('a[name="team_name"]').html(compspace_name)
                    clone.find('a[name="last_update"]').html(getLastChatTime)
                    clone.find('a[name="last_message"]').html(getLastMessage)

                    let getUnreadMessage = cardContact[id_channel]['channel'].state.read[userId]['unread_messages']

                    if (getUnreadMessage > 0) {
                        clone.find(`[name='channel_unread']`).removeClass('hidden')
                        clone.find(`[name='unread_messages']`).html(getUnreadMessage)
                    } else {
                        clone.find(`[name='channel_unread']`).addClass('hidden')
                    }
                }

                channelContainer.append(clone)

                cardContact[data.channel.id] = {
                    object: clone,
                    type: type,
                    update: function(data) {
                        update()
                        channelContainer.prepend(clone)
                    },
                    read: function() {
                        clone.find(`[name='channel_unread']`).addClass('hidden')
                    }
                }

                async function onMessageNew() {
                    let channels = client.channel(type,id_channel)
                    let states = await channels.watch({
                        presence: true
                    })
                    cardContact[id_channel]['channel'] = channels
                    channels.on('message.new', async (event) => {
                        cardContact[event.channel_id].update(event)
                    })
                    channels.on('typing.start', async (event) => {
                        if (event.user.id === userId) {
                            return
                        }
                        clone.find('a[name="last_message]').html('Typing...')
                        clone.find('a[name="last_message]').addClass('!text-[#5E93DA]')
                    })
                    channels.on("typing.stop", (event) => {
                        if (event.user.id === userId) {
                            return
                        }
                        clone.find('a[name="last_message]').html(channels.state.messages[channels.state.messages.length - 1].text)
                        clone.find('a[name="last_message]').removeClass('!text-[#5E93DA]')
                    })

                    setTimeout(() => {
                        update()
                        updatePerChannel(data)
                    }, 1000)
                }
                
                onMessageNew()
            }

            function updateChannel() {
                $.ajax({
                    url: "{{ route('chat.getChannel') }}",
                    type: 'GET',
                    data: {
                        id: {{ $user->id_user }}
                    },
                    success: function(response) {
                        if (response.data.channels.length > 0) {
                            response.data.channels.forEach(data => {
                                createChannel(data)
                            })
                        }
                    }
                })
            }

            function resetChannel() {
                $.ajax({
                    url: "{{ route('chat.resetChannel') }}",
                    type: 'POST',
                    success: function(response) {
                        if (response.success) {
                            spawnNotification(
                                    "Berhasil reset channel chat",
                                    "",
                                    "success",
                                    1500,
                                    () => {
                                        console.log("confirmed")
                                    },
                                    () => {
                                        console.log("denied")
                                    },
                                    () => {
                                        Object.keys(cardContact).forEach(key => {
                                            if (cardContact[key] !== undefined) {
                                                cardContact[key].object.remove();
                                                cardContact[key] = undefined;
                                            }
                                        });
                                        cardContact = [];
                                        updateChannel();
                                    }
                                );
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                })
            }

            updateChannel()

            setInterval(() => {
                updateChannel()
            }, 5000)
        </script>
    </x-slot>
    <div x-data="{ openSideContact: true }" class="flex justify-between h-full">
        <div x-show="openSideContact" x-transition:enter="transition-transform ease-out duration-300"
            x-transition:enter-start="translate-x-[-100%]" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform ease-in duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-[-100%]" class="flex flex-col gap-2 h-full">
            <div
                class=" h-full w-[300px] 2xl:w-[400px] border-r-[1px]  dark:border-[#272729] border-gray-200 rounded-l-xl pt-[30px] px-[0px] flex flex-col">
                <h3
                    class=" px-[30px] flex justify-between items-center text-lg font-semibold text-gray-800  dark:text-gray-200">
                    <a class="text-black dark:text-gray-300 text-[30px] mt-[15px]">Message</a>
                    <div class="flex gap-[10px]">
                        {{-- <button
                            class="disabled:bg-gray-300 disabled:text-gray-500 disabled:dark:bg-gray-800 disabled:cursor-not-allowed inline-flex items-center px-4 py-2 border-[1px] border-gray-200 bg-[#5E93DA] dark:bg-[#5E93DA] border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-[#315079] focus:bg-gray-700 dark:focus:bg-[#5E93DA] active:bg-gray-900 dark:active:bg-[#5E93DA] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 !rounded-full !p-[8px] !py-[5px]"
                            onclick="createChannelPrivate()">
                            <div class="flex relative justify-center items-center w-full h-full">
                                <a class="text-sm">+ Chat</a>
                            </div>
                        </button> --}}
                        @if ($user->hasRole('Admin'))
                            <button id="reset_button"
                                class="disabled:bg-gray-300 disabled:text-gray-500 disabled:dark:bg-gray-800 disabled:cursor-not-allowed inline-flex items-center px-4 py-2 border-[1px] border-gray-200 bg-[#5E93DA] dark:bg-[#5E93DA] border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-[#315079] focus:bg-gray-700 dark:focus:bg-[#5E93DA] active:bg-gray-900 dark:active:bg-[#5E93DA] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 !rounded-full !bg-red-500 hover:!bg-red-600 !p-[8px] !py-[5px] !bg-opacity-90">
                                <div class="flex relative justify-center items-center w-full h-full">
                                    <a class="text-sm">Reset</a>
                                </div>
                            </button>
                        @endif
                    </div>
                </h3>
                <div x-data="{ selectedChannel: '' }" class="flex flex-col px-6 py-8 h-full gap-[25px]">
                    <x-finder class="w-full !border-1px !border-[#DADADA]" icon_pos="left"
                        placeholder="Find Messages" />
                    <div class="flex flex-col gap-[14px]">
                        <div class="flex gap-[5px] items-center">
                            <x-svg.chat2 width=12 height=12 fill="#707070" />
                            <a class="text-[11px] text-[#707070] font-semibold">My Compspace</a>
                        </div>
                        
                        <!-- Channel List -->
                        <div class="flex flex-col gap-2" id="channelContainer">
                            
                        </div>

                        {{-- Sample --}}
                        <x-cards.chat-channel />
                    </div>
                </div>
            </div>
        </div>
        <div class="flex relative flex-col lg:px-[40px] px-[10px] w-full h-full hidden" id="overview">
            <div
                class="flex flex-col py-[25px] gap-[18px] bg-white rounded-tr-xl border-b-[1px] dark:border-[#272729] border-gray-200 dark:bg-[#18181B]">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-[15px] cursor-pointer">
                        <div class="items-center -me-2">
                            <button @click="openSideContact = ! openSideContact"
                                class="inline-flex justify-center items-center p-2 text-gray-400 rounded-md transition duration-150 ease-in-out dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400"
                                id="sideBarHumberger">
                                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ 'hidden': openSideContact, 'inline-flex': !openSideContact }"
                                        class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                    <path :class="{ 'hidden': !openSideContact, 'inline-flex': openSideContact }"
                                        class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <a class="p-1 rounded-xl  dark:hover:bg-[#FAFAFA] dark:hover:bg-opacity-10 hover:bg-gray-100"
                            id="openProfileLink"
                            href="https://8000-idx-tubes-semester-3-1728983615977.cluster-e3wv6awer5h7kvayyfoein2u4a.cloudworkstations.dev/view/profile/4/overview">
                            <div class="flex gap-[15px] items-center">
                                <div id="profileChannel"
                                    class="flex justify-center items-center rounded-full w-[35px] h-[35px] bg-white overflow-hidden"
                                    type="messaging" userid="4">
                                    <x-svg.chat2 width=16 height=16 />
                                    {{-- <img class="" id="username_image"
                                        onerror="let getFirst = $(this).attr('name') $(this).parent().find('p').text(getFirst.charAt(0)) $(this).css('display', 'none')"
                                        alt="Profile Image" name="Tim Kocak Abis"
                                        src="https://lh3.googleusercontent.com/a/ACg8ocIQCtG3ch_RzIDd1_vy6LdLNrt8_7TNtjtOBKqMvUIzNFhDm9g=s96-c"
                                        style="display: block"> --}}
                                    <p class="text-black"></p>
                                </div>
                                <div class="flex flex-col gap-[1px]">
                                    <span class="font-semibold text-gray-900 dark:text-gray-200" id="channelName">Tim
                                        Kocak Abis</span>
                                    <span class="text-[12px] text-[#9F9F9F] font-semibold " id="channelLomba"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="flex gap-[13px]">
                        <div
                            class="w-[36px] h-[36px] p-2 flex items-center justify-center border-[1px] border-[#C2C2C2] rounded-[7px]">
                            <x-svg.search width=20 height=20 fill="#000000" />
                        </div>
                        <div
                            class="w-[36px] h-[36px] p-2 flex items-center justify-center border-[1px] border-[#C2C2C2] rounded-[7px]">
                            <x-svg.star width=20 height=20 fill="#000000" />
                        </div>
                        <div
                            class="w-[36px] h-[36px] p-2 flex items-center justify-center border-[1px] border-[#C2C2C2] rounded-[7px]">
                            <x-svg.campaign width=20 height=20 fill="none" stroke="#000000" />
                        </div>

                    </div>
                </div>
                <div class="border-[1px] border-[#E7E7E7] p-[11px] rounded-lg flex gap-3 items-center">
                    <div
                        class="rounded-full min-w-[30px] h-[30px] flex justify-center items-center bg-[#5645A126] bg-opacity-15">
                        <x-svg.campaign weight=16 height=16 fill="#822BF2" />
                    </div>
                    <p class="text-[13px]">📢 Attention, everyone! 🕑 Quick update: We'll need everyone to continue
                        working until 2:00 PM today. Your dedication is greatly appreciated! If you have any questions
                        or concerns, feel free to ask. Keep your spirits up! 💪</p>
                </div>
            </div>

            <!-- Chat Messages -->
            <div
                class="overflow-y-auto  h-full py-[45px] bg-[url('/public/img/chat-bg.png')] dark:bg-black dark:bg-opacity-90 dark:bg-blend-multiply
                                [&amp::-webkit-scrollbar]:w-2
                                [&amp::-webkit-scrollbar-track]:rounded-full
                                [&amp::-webkit-scrollbar-thumb]:rounded-full
                                [&amp::-webkit-scrollbar-thumb]:bg-[#5E93DA]">
                <div class="flex flex-col space-y-4 gap-[21px] mx-6" id="chatContainer">

                </div>
            </div>

            {{-- Sample --}}
            <x-cards.chat-self />
            <x-cards.chat-opponent />

            <!-- Input Message (Fixed at Bottom) -->
            <div
                class="relative mb-[20px] flex border-[1px] min-h-[60px] border-[#ECECF1] dark:border-[#464649] bg-white dark:bg-white dark:bg-opacity-10 flex-grow mr-4 w-full rounded-[10px] focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white">
                <input value="" autocomplete="off"
                    class="py-3 px-5 pr-[150px] w-full h-full border-none rounded-[10px]" type="text"
                    placeholder="Type a message..." id="chatBox" maxlength="255">
                <div class="absolute right-3 top-[50%] -translate-y-1/2 flex justify-end w-[108px]">
                    {{-- <button
                        class="w-[30px] disabled:bg-gray-300 disabled:text-gray-500 disabled:dark:bg-gray-800 disabled:cursor-not-allowed inline-flex items-center p-[6px] tracking-widest rounded-[7.5px]  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        id="chatAttachment">
                        <x-svg.attachment width=18 height=18 fill="#5645A1" />
                    </button>
                    <button
                        class="w-[30px] disabled:bg-gray-300 disabled:text-gray-500 disabled:dark:bg-gray-800 disabled:cursor-not-allowed inline-flex items-center p-[6px] tracking-widest rounded-[7.5px]  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 "
                        id="chatMic">
                        <x-svg.microphone width=18 height=18 fill="#5645A1" />
                    </button> --}}
                    <button
                        class="w-[30px] disabled:bg-gray-300 disabled:text-gray-500 disabled:dark:bg-gray-800 disabled:cursor-not-allowed inline-flex items-center p-[6px] bg-[#12B740] dark:bg-[#12B740] rounded-[7.5px] text-white dark:text-white tracking-widest hover:bg-gray-700 dark:hover:bg-[#315079] focus:bg-gray-700 dark:focus:bg-[#5E93DA] active:bg-gray-900 dark:active:bg-[#5E93DA] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        id="chatSubmit">
                        <x-svg.plane width=18 height=18 fill="#FFFFFF" />
                    </button>
                </div>

            </div>
        </div>

    </div>
</x-layouts.navigation>