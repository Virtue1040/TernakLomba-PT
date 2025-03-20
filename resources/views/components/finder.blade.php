@props(['icon', 'icon_pos' => 'right', 'placeholder' => 'placeholder here...'])
<?php
    $class = 'p-4 font-[16px] px-4 bg-white rounded-full border-none';
    if ($icon_pos == 'right') {
        $class = "$class pr-16";
    } else {
        $class = "$class pl-16";
    }
?>

<div class="flex relative w-fit">
    <input {{ $attributes->merge(['class' => $class]) }} type="text" placeholder="{{ $placeholder }}">
    <button
        class="absolute 
        @if ($icon_pos == 'right') 
            right-5
        @else
            left-5 
        @endif
        w-[30px] h-[30px] top-[50%] -translate-y-1/2">
        @isset($icon)
            {{ $icon }}
        @else
            <x-svg.search width="24px" height="24px" fill=#767676 />
        @endisset
    </button>
</div>
