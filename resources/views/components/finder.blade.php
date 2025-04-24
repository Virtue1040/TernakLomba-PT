@props(['icon', 'icon_pos' => 'right', 'placeholder' => 'placeholder here...'])
<?php
    $class = 'p-4 font-[16px] px-7 bg-white rounded-full ';
    if ($icon_pos == 'right') {
        $class = "$class pr-16";
    } else {
        $class = "$class pl-16";
    }
?>

<div class="flex relative w-fit">
    <input {{ $attributes->merge(['class' => $class]) }} type="text" placeholder="{{ $placeholder }}">
    <div
        class="absolute flex justify-center items-center
        @if ($icon_pos == 'right') 
            right-3
        @else
            left-3 
        @endif
        w-fit h-fit min-w-[30px] min-h-[30px] top-[50%] -translate-y-1/2">
        @isset($icon)
            {{ $icon }}
        @else
            <x-svg.search width="24px" height="24px" fill=#767676 />
        @endisset
    </div>
</div>
