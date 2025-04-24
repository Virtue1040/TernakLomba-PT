@props(['title', 'university'])

<div class="w-[303px] min-w-[303px] h-[271px] rounded-lg border border-[#E7E7E7] overflow-hidden">
    <img src="{{ asset('images/4cnational.png') }}" alt="4C National Competition"
        class="w-[303px] min-w-[303px] h-[154px] object-cover">
    <div class="p-4">
        <h2 class="text-[16px] font-bold leading-tight">{{ $title }}</h2>
        <p class="text-gray-500 text-[12px]">{{ $university }}</p>
        <div class="flex gap-2 mt-3">
            <span class="bg-[#F3F3F3] text-gray-700 px-3 py-1 text-xs rounded-full">10 Days Left</span>
            <span class="bg-[#F3F3F3] text-gray-700 px-3 py-1 text-xs rounded-full">Offline</span>
            <span class="bg-[#F3F3F3] text-gray-700 px-3 py-1 text-xs rounded-full">Mahasiswa</span>
        </div>
    </div>
</div>