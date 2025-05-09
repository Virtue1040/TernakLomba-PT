@props(['title','case','juara','tingkat'])

<div class="border-b border-gray-100 bg-[#F7F7F7] p-2 rounded-[16px]">
    <p class="font-semibold text-[#553737]">{{ $title }}</p>
    <p class="text-sm text-[#553737]">{{ $case }}</p>
    <div class="flex mt-2 gap-2">
        <span class="text-xs text-[#553737]">{{ $juara }}</span>
        <span class="text-xs text-[#553737]">{{ $tingkat }}</span>
    </div>
</div>