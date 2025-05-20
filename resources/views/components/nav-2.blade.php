@props(['title', 'ItemColor'])

<div class="flex items-center p-2 md:p-4">
    <a href="{{ route('dashboard-explore') }}" class="{{ $ItemColor }}">
        <i class="text-xl fas fa-chevron-left"></i>
    </a>
    <h1 class="ml-4 text-xl font-semibold {{ $ItemColor }}">{{ $title }}</h1>
    <div class="flex items-center ml-auto space-x-4">
        <button class="text-[#8E8E8E]">
            <i class="text-xl far fa-question-circle"></i>
        </button>
        <button class="relative text-[#8E8E8E]">
            <i class="text-xl fas fa-bell"></i>
            <span
                class="flex absolute -top-1 -right-1 justify-center items-center w-3 h-3 border border-white b-2 text-xs text-white bg-red-500 rounded-full"></span>
        </button>
    </div>
</div>
