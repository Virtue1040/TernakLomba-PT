<x-layouts.navigation>
    <x-slot name="script">
        <script>
            let cardContact = [];
            let activeChannel = null;
            let activedUser = [];
            let pendingMessage = [];

            $(document).ready(function() {

            })

            function updateChannel() {
                $.ajax({
                    url: "{{ route('chat.getChannel') }}",
                    type: 'GET',
                    data: {
                        id: {{ $user->id_user }}
                    },
                    success: function(response) {
                        if (response.data.channels.length > 0) {
                            console.log(response);
    
                        }
                    }
                })
            }
            updateChannel();
            setInterval(() => {
                updateChannel();
            }, 5000);
        </script>
    </x-slot>
    <div x-data="{ openSideContact: true }" class="flex w-full h-full">
        <div x-show="openSideContact" x-transition:enter="transition-transform ease-out duration-300"
            x-transition:enter-start="translate-x-[-100%]" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform ease-in duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-[-100%]" class="flex float-left flex-col gap-2 h-full"
            class="dark:bg-[#18181B]  bg-[#EDEDED]">
            <div
                class=" h-full w-[300px] 2xl:w-[400px] border-r-[1px]  dark:border-[#272729] border-gray-200 rounded-l-xl pt-[30px] px-[0px] flex flex-col">
                <h3
                    class=" px-[30px] flex justify-between items-center text-lg font-semibold text-gray-800  dark:text-gray-200">
                    <a class="text-black dark:text-gray-300 text-[30px] mt-[15px]">Message</a>
                    <div class="flex gap-[10px]">
                        {{-- <button
                            class="disabled:bg-gray-300 disabled:text-gray-500 disabled:dark:bg-gray-800 disabled:cursor-not-allowed inline-flex items-center px-4 py-2 border-[1px] border-gray-200 bg-[#5E93DA] dark:bg-[#5E93DA] border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-[#315079] focus:bg-gray-700 dark:focus:bg-[#5E93DA] active:bg-gray-900 dark:active:bg-[#5E93DA] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 !rounded-full !p-[8px] !py-[5px]"
                            onclick="createChannelPrivate();">
                            <div class="flex relative justify-center items-center w-full h-full">
                                <a class="text-sm">+ Chat</a>
                            </div>
                        </button> --}}
                        @if ($user->hasRole('Admin'))
                            <button
                                class="disabled:bg-gray-300 disabled:text-gray-500 disabled:dark:bg-gray-800 disabled:cursor-not-allowed inline-flex items-center px-4 py-2 border-[1px] border-gray-200 bg-[#5E93DA] dark:bg-[#5E93DA] border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-[#315079] focus:bg-gray-700 dark:focus:bg-[#5E93DA] active:bg-gray-900 dark:active:bg-[#5E93DA] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 !rounded-full !bg-red-500 hover:!bg-red-600 !p-[8px] !py-[5px] !bg-opacity-90">
                                <div class="flex relative justify-center items-center w-full h-full">
                                    <a class="text-sm" onclick="resetChannel();">Reset</a>
                                </div>
                            </button>
                        @endif
                    </div>
                </h3>
                <div class="flex flex-col px-6 py-8 h-full gap-[25px]">
                    <x-finder class="w-full !border-1px !border-[#DADADA]" icon_pos="left"
                        placeholder="Find Messages" />
                    <div class="flex flex-col gap-[14px]">
                        <div class="flex gap-[5px] items-center">
                            <x-svg.chat2 width=22 height=22 fill="#707070" />
                            <a class="text-[11px] text-[#707070] font-semibold">My Compspace</a>
                        </div>
                        <!-- Channel List -->
                        <div class="flex flex-col gap-1" id="channelContainer">
                            <x-cards.chat-channel />
                            <x-cards.chat-channel />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex relative flex-col px-[45px] w-full h-full" id="overview">
            <div
                class="flex flex-col py-[25px] gap-[18px] bg-white rounded-tr-xl border-b-[1px] dark:border-[#272729] border-gray-200 dark:bg-[#18181B]">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-[15px] cursor-pointer">
                        <div class="hidden items-center -me-2 ml-[-15px] md:flex">
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
                                    <img class="" id="username_image"
                                        onerror="let getFirst = $(this).attr('name'); $(this).parent().find('p').text(getFirst.charAt(0)); $(this).css('display', 'none')"
                                        alt="Profile Image" name="Tim Kocak Abis"
                                        src="https://lh3.googleusercontent.com/a/ACg8ocIQCtG3ch_RzIDd1_vy6LdLNrt8_7TNtjtOBKqMvUIzNFhDm9g=s96-c"
                                        style="display: block;">
                                    <p class="text-black"></p>
                                </div>
                                <div class="flex flex-col gap-[1px]">
                                    <span class="font-semibold text-gray-900 dark:text-gray-200" id="channelName">Tim
                                        Kocak Abis</span>
                                    <span class="text-[12px] text-[#9F9F9F] font-semibold " id="channelLomba">4C
                                        Competition</span>
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
                            <x-svg.campaign width=20 height=20 fill="#000000" />
                        </div>
            
                    </div>
                </div>
                <div class="border-[1px] border-[#E7E7E7] p-[11px] rounded-lg flex gap-3 items-center">
                    <div
                        class="rounded-full min-w-[27px] h-[27px] flex justify-center items-center bg-[#5645A126] bg-opacity-15">
                        <x-svg.campaign weight=15 height=15 fill="#2A62E3" />
                    </div>
                    <p class="text-[11px]">📢 Attention, everyone! 🕑 Quick update: We'll need everyone to continue
                        working until 2:00 PM today. Your dedication is greatly appreciated! If you have any questions
                        or concerns, feel free to ask. Keep your spirits up! 💪</p>
                </div>
            </div>

            <!-- Chat Messages -->
            <div
                class="overflow-y-auto flex-grow h-full py-[45px] bg-[url('/public/img/chat-bg.png')]  dark:bg-black dark:bg-opacity-90 dark:bg-blend-multiply
                                [&amp;::-webkit-scrollbar]:w-2
                                [&amp;::-webkit-scrollbar-track]:rounded-full
                                [&amp;::-webkit-scrollbar-thumb]:rounded-full
                                [&amp;::-webkit-scrollbar-thumb]:bg-[#5E93DA]">
                <div class="flex flex-col space-y-4 gap-[21px]" id="chatContainer">
                    <x-cards.chat-self />
                    <x-cards.chat-opponent />
                </div>
            </div>

            <!-- Input Message (Fixed at Bottom) -->
            <div
                class="relative mb-[20px] flex border-[1px] min-h-[60px] border-[#ECECF1] dark:border-[#464649] bg-white dark:bg-white dark:bg-opacity-10 flex-grow mr-4 w-full rounded-[10px] focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white">
                <input value="" autocomplete="off" class="py-3 w-full h-full border-none rounded-[10px]"
                    type="text" placeholder="Type a message..." id="chatBox" maxlength="255">
                <div class="absolute right-3 top-[50%] -translate-y-1/2 flex justify-between w-[108px]">
                    <button
                        class="w-[30px] disabled:bg-gray-300 disabled:text-gray-500 disabled:dark:bg-gray-800 disabled:cursor-not-allowed inline-flex items-center p-[6px] tracking-widest hover:bg-gray-700 dark:hover:bg-[#315079] focus:bg-gray-700 dark:focus:bg-[#5E93DA] active:bg-gray-900 dark:active:bg-[#5E93DA] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        id="chatAttachment">
                        <x-svg.attachment width=18 height=18 fill="#5645A1" />
                    </button>
                    <button
                        class="w-[30px] disabled:bg-gray-300 disabled:text-gray-500 disabled:dark:bg-gray-800 disabled:cursor-not-allowed inline-flex items-center p-[6px] tracking-widest hover:bg-gray-700 dark:hover:bg-[#315079] focus:bg-gray-700 dark:focus:bg-[#5E93DA] active:bg-gray-900 dark:active:bg-[#5E93DA] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 "
                        id="chatMic">
                        <x-svg.microphone width=18 height=18 fill="#5645A1" />
                    </button>
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
