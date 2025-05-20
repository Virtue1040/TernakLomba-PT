<x-layouts.default footer=false>
    @isset($script)
        <x-slot name="script">
            <script type=module>
                import { StreamChat } from 'https://cdn.jsdelivr.net/npm/stream-chat'

                //GETSTREAM API AUTHORIZATION
                const apiKey = "{{ env('STREAM_API_KEY') }}"
                const userId = "{{ $user->id_user }}"
                const userToken = "{{ $streamToken ?? '' }}"
                const client = new StreamChat(apiKey)
                // async function refreshUnread() {
                //     const unreadCounts = await client.getUnreadCount()
                //     if (unreadCounts['total_unread_count'] > 0) {
                //         $("#chatNotification").css('display', 'flex')
                //     } else {
                //         $("#chatNotification").css('display', 'none')
                //     }
                //     $("#chatNotification").html(unreadCounts['total_unread_count'])
                // }
                async function connectUser() {
                    await client.connectUser({
                            id: userId,
                            name: "{{ $user->user_detail->first_name }} {{ $user->user_detail->last_name }}",
                        },
                        userToken)
                    // refreshUnread()
                    // setInterval(() => {
                    //     refreshUnread()
                    // }, 5000)
                }
                connectUser()
            </script>
            {{ $script }}
        </x-slot>
    @endisset
    <div x-data="{ menu: 'dashboard' }" class="flex w-full min-h-screen h-fit">
        <div class="lg:flex border-r bg-white p-8 hidden flex-col w-[294px] ">
            <div
                class="text-[31.48px] bg-gradient-to-b from-[#822BF2] to-[#B378FF] bg-clip-text text-transparent font-semibold mb-12 text-nowrap">
                Ternak Lomba
            </div>

            <nav class="space-y-4">
                <h2 class="text-lg text-[#757575]">Menu</h2>
                <x-navigation-button href="{{ route('dashboard-index') }}" :active="request()->routeIs('dashboard-index')" name="Dashboard">
                    <x-svg.dashboard :active="request()->routeIs('dashboard-index')" />
                </x-navigation-button>

                @if($user->hasRole("Admin"))
                    <x-navigation-button href="{{ route('dashboard-admin') }}" :active="request()->routeIs('dashboard-admin')" name="Admin">
                        <x-svg.fact-check :active="request()->routeIs('dashboard-admin')" />
                    </x-navigation-button>
                @endif
                
                <x-navigation-button href="{{ route('dashboard-explore') }}" :active="request()->routeIs('dashboard-explore')" name="Explore">
                    <x-svg.explore :active="request()->routeIs('dashboard-explore')" />
                </x-navigation-button>

                <x-navigation-button href="{{ route('dashboard-chat') }}" :active="request()->routeIs('dashboard-chat')" name="Chat">
                    <x-svg.chat :active="request()->routeIs('dashboard-chat')" />
                </x-navigation-button>

                <x-navigation-button href="{{ route('dashboard-chat') }}" :active="request()->routeIs('dashboard-chat')" name="Penyelenggara (Temp)">
                    <x-svg.chat :active="request()->routeIs('dashboard-chat')" />
                </x-navigation-button>
            </nav>

            <div class="flex flex-col p-[14px] border-[1px] border-[#E9E9E9] rounded-[10px] mt-auto ">
                <div onclick="window.location.href = '{{ route('profile') }}'" class="flex items-center p-1 mb-5 rounded-xl cursor-pointer hover:bg-gray-100 hover:bg-opacity-50">
                    <img src="{{ asset('images/juara2.png') }}" alt="Profile" class="mr-3 w-10 h-10 rounded-full">
                    <div>
                        <div class="font-semibold">{{ $user->user_detail->first_name }} {{ $user->user_detail->last_name }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $user->getRoleNames()[0] == 'User' ? 'Students' : $user->getRoleNames()[0] }}</div>
                    </div>
                </div>
    
                <button onclick="window.location.href = '{{ route('logout') }}'" class="flex items-center justify-start bg-[#FEBB0E] p-3 gap-1 rounded-[10px]">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.3333 14.1667L17.5 10M17.5 10L13.3333 5.83333M17.5 10H7.5M7.5 2.5H6.5C5.09987 2.5 4.3998 2.5 3.86502 2.77248C3.39462 3.01217 3.01217 3.39462 2.77248 3.86502C2.5 4.3998 2.5 5.09987 2.5 6.5V13.5C2.5 14.9001 2.5 15.6002 2.77248 16.135C3.01217 16.6054 3.39462 16.9878 3.86502 17.2275C4.3998 17.5 5.09987 17.5 6.5 17.5H7.5"
                            stroke="#141111" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p>Logout</p>
                </button>
            </div>
        </div>
        
        <div x-data="{ isProfileOpen: false }" class="w-full h-screen">
            <div class="flex flex-col h-full">
                <div class="px-4 py-3 bg-white border-b shadow-sm lg:hidden">
                    <div class="flex justify-start items-center">
                        <div
                            class="text-xl bg-gradient-to-b from-[#822BF2] to-[#B378FF] bg-clip-text text-transparent font-semibold">
                            Ternak Lomba
                        </div>
                    </div>
                </div>
                <div class="overflow-auto flex-1 max-w-full">
                    {{ $slot }}
                </div>
                <div class="bg-white border-t shadow-lg lg:hidden">
                    <div class="flex justify-around items-center px-2 py-3">
                        <a href="{{ route('dashboard-index') }}"
                        class="flex flex-col items-center justify-center {{ request()->routeIs('dashboard-index') ? 'text-[#822BF2]' : 'text-[#757575]' }}">
                        <x-svg.dashboard :active="request()->routeIs('dashboard-index')" class="w-6 h-6" />
                            <span class="mt-1 text-xs">Dashboard</span>
                        </a>
    
                        <a href="{{ route('dashboard-explore') }}"
                            class="flex flex-col items-center justify-center {{ request()->routeIs('dashboard-explore') ? 'text-[#822BF2]' : 'text-[#757575]' }}">
                            <x-svg.explore :active="request()->routeIs('dashboard-explore')" class="w-6 h-6" />
                            <span class="mt-1 text-xs">Explore</span>
                        </a>
    
                        <a href="{{ route('dashboard-chat') }}"
                            class="flex flex-col items-center justify-center {{ request()->routeIs('dashboard-chat') ? 'text-[#822BF2]' : 'text-[#757575]' }}">
                            <x-svg.chat :active="request()->routeIs('dashboard-chat')" class="w-6 h-6" />
                            <span class="mt-1 text-xs">Chat</span>
                        </a>
    
                        <button @click="isProfileOpen = !isProfileOpen" class="flex flex-col justify-center items-center"
                            :class="isProfileOpen ? 'text-[#822BF2]' : 'text-[#757575]'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="mt-1 text-xs">Profile</span>
                        </button>
                    </div>
                </div>
    
            </div>

            <div x-show="isProfileOpen" @click.away="isProfileOpen = false"
                class="fixed right-2 bottom-16 z-50 p-4 w-52 bg-white rounded-lg border shadow-lg sm:hidden"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95">
                <div class="flex items-center p-1 pb-3 mb-4 rounded-xl border-b cursor-pointer hover:bg-gray-100 hover:bg-opacity-50">
                    <img src="{{ asset('images/juara2.png') }}" alt="Profile" class="mr-3 w-8 h-8 rounded-full">
                    <div>
                        <div class="text-sm font-semibold">{{ $user->user_detail->first_name }} {{ $user->user_detail->last_name }}</div>
                        <div class="text-xs text-gray-500">
                            {{ $user->getRoleNames()[0] == 'User' ? 'Students' : $user->getRoleNames()[0] }}</div>
                    </div>
                </div>

                <a href="{{ route('dashboard-chat') }}"
                    class="flex items-center py-2 px-1 hover:bg-gray-100 rounded-md {{ request()->routeIs('dashboard-chat') ? 'text-[#822BF2]' : 'text-gray-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-sm">Profile</span>
                </a>

                <button onclick="window.location.href = '{{ route('logout') }}'" href="{{ route('logout') }}" class="flex items-center justify-start bg-[#FEBB0E] p-2 gap-1 rounded-[10px] w-full mt-3">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.3333 14.1667L17.5 10M17.5 10L13.3333 5.83333M17.5 10H7.5M7.5 2.5H6.5C5.09987 2.5 4.3998 2.5 3.86502 2.77248C3.39462 3.01217 3.01217 3.39462 2.77248 3.86502C2.5 4.3998 2.5 5.09987 2.5 6.5V13.5C2.5 14.9001 2.5 15.6002 2.77248 16.135C3.01217 16.6054 3.39462 16.9878 3.86502 17.2275C4.3998 17.5 5.09987 17.5 6.5 17.5H7.5"
                            stroke="#141111" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="text-sm">Logout</p>
                </button>
            </div>

            <style>
                body {
                    padding-bottom: 60px
                    padding-top: 56px
                }

                @media (min-width: 640px) {
                    body {
                        padding-bottom: 0
                        padding-top: 0
                    }
                }
            </style>
        </div>
</x-layouts.default>
