@props(['name', 'label' => 'holder', 'required' => false, "size" => 15, "accept" => ""])
<?php
    $class = "sm:p-3 md:p-4 lg:p-5 font-[16px] bg-white rounded-[15px] text-[18px] w-auto cursor-pointer";
    if ($errors->has($name)) {
        $class = "$class border-[1px] border-red-400";
    } else {
        $class = "$class border-[1px] border-[#C6C6C6]";
    }
?>
<label {{ $attributes->merge(['class' => $class]) }}>
    <div class='flex flex-row gap-4 justify-center items-center'>
        <x-svg.upload width="20" height="18px"/>
        <a class="text-[#5C5C5C] text-[20px]">{{ $label }}</a>
    </div>
    <input id="{{ "input_" . $name}}" name="{{ $name }}" type="file" accept="{{ $accept }}" hidden></input> 
</label>