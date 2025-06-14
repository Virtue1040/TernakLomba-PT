@props(['team_name', 'date', 'description', 'participants', 'show_join' => true, 'show_joined' => false, 'team_code'])

<div class="p-4 space-y-3 w-full max-w-xs bg-white rounded-[25px] border border-gray-200">
    <div class="flex justify-between items-center">
        <div class="flex flex-row gap-2">
            <h3 class="text-sm font-semibold sm:text-lg">{{ $team_name }}</h3>
            @if ($show_joined) 
                <span
                class="px-1 whitespace-nowrap text-[12px] flex items-center text-gray-500 bg-[#FCFCFD] border border-[#c1c1c1] rounded-full">Tim Kamu</span>
            @endif
        </div>
        <span
            class="px-1 whitespace-nowrap text-[12px] text-gray-500 bg-[#FCFCFD] border border-[#c1c1c1] rounded-full">{{ $date }}</span>
    </div>

    <p class="text-sm text-gray-600">
        {{ $description }}
    </p>

    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-2 bg-[#6B6CF70D] px-2 py-1 rounded-full text-[#6B6CF7]">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="8.5" cy="7" r="4" />
                <path d="M20 8v6" />
                <path d="M23 11h-6" />
            </svg>
            <span class="text-[12px]">{{ $participants }}</span>
        </div>

        @if ($show_join)
            <button @click="formOpen = true" onclick="sync({{ $team_code }})" id="{{ $team_code }}"
                class="px-2 py-1 text-xs text-white whitespace-nowrap bg-black rounded-full transition-colors md:px-4 md:py-2 md:text-sm hover:bg-gray-800">
                Request Join
            </button>
        @endif
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
