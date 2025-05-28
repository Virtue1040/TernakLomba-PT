@props(['title', 'ItemColor'])

<div class="flex items-center p-2 md:p-4">
    <a href="{{ route('dashboard-explore') }}" class="{{ $ItemColor }}">
        <i class="text-xl fas fa-chevron-left"></i>
    </a>
    <h1 class="ml-4 text-xl font-semibold {{ $ItemColor }}">{{ $title }}</h1>
    <div class="flex items-center ml-auto space-x-4">
 
    </div>
</div>
