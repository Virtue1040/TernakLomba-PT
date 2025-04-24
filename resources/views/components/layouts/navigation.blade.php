<x-layouts.default footer=false>
    <div x-data="{ menu: 'dashboard' }" class="flex min-h-screen">
        <div class="w-[294px] border-r bg-white p-8 flex flex-col">
            <div
                class="text-[31.48px] bg-gradient-to-b from-[#822BF2] to-[#B378FF] bg-clip-text text-transparent font-semibold mb-12">
                Ternak Lomba
            </div>

            <nav class="space-y-4">
                <h2 class="text-lg text-[#757575]">Menu</h2>
                <x-navigation-button href="{{ route('dashboard-index') }}" :active="request()->routeIs('dashboard-index')" name="Dashboard">
                    <x-svg.dashboard :active="request()->routeIs('dashboard-index')" />
                </x-navigation-button>

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

            <div class="flex items-center mt-auto mb-6">
                <img src="{{ asset('images/juara2.png') }}" alt="Profile" class="mr-3 w-10 h-10 rounded-full">
                <div>
                    <div class="font-semibold">{{ $user->user_detail->first_name }} {{ $user->user_detail->last_name }}</div>
                    <div class="text-sm text-gray-500">{{ $user->getRoleNames()[0] == 'User' ? 'Students' : $user->getRoleNames()[0] }}</div>
                </div>
            </div>

            <button class="flex items-center justify-start bg-[#FEBB0E] p-3 gap-1 rounded-[10px]">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.3333 14.1667L17.5 10M17.5 10L13.3333 5.83333M17.5 10H7.5M7.5 2.5H6.5C5.09987 2.5 4.3998 2.5 3.86502 2.77248C3.39462 3.01217 3.01217 3.39462 2.77248 3.86502C2.5 4.3998 2.5 5.09987 2.5 6.5V13.5C2.5 14.9001 2.5 15.6002 2.77248 16.135C3.01217 16.6054 3.39462 16.9878 3.86502 17.2275C4.3998 17.5 5.09987 17.5 6.5 17.5H7.5"
                        stroke="#141111" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p>Logout</p>
            </button>
        </div>

        <div class="flex-1">
            {{ $slot }}
        </div>
    </div>
</x-layouts.default>