@props(['label' => 'holder', 'text' => ''])
<?php
    $class = "p-5 font-[16px] bg-white rounded-[15px] text-[18px]";
?>
<div class="flex relative flex-col gap-[10px] w-full">
    <label class="font-[700] font-cabinet text-[20px]">{{ $label }}</label>
    <a class="text-[#AAAAAA] text-[20px] font-manrope">{{ $text }}</a>
</div>