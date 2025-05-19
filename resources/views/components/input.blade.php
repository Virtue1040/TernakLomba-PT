@props(['name', 'type' => 'text', 'max' => '', 'min' => '', 'label' => 'holder', 'placeholder' => 'placeholder here...', 'required' => false, 'tip'])
<?php
    $class = "sm:p-3 md:p-4 lg:p-5 font-[16px] bg-white rounded-[15px] text-[18px]";
    if ($errors->has($name)) {
        $class = "$class border-[1px] border-red-400";
    } else {
        $class = "$class border-[1px] border-[#C6C6C6]";
    }
?>
<div class="flex relative flex-col gap-[10px] w-full">
    <label for="{{ "input_" . $name }}" class="font-[700] font-cabinet sm:text-[15px] md:text-[18px] lg:text-[20px]">{{ $label }}@if($required) <span class="text-red-400">*</span>@endif</label>
    <input  id="{{ "input_" . $name}}" name="{{ $name }}" value="{{ old($name) }}" max="{{ $max }}" min="{{ $min }}" {{ $attributes->merge(['class' => $class]) }} type="{{ $type }}" placeholder="{{ $placeholder }}">
    @error($name)
        <span class="text-red-400 text-[14px]">{{ $message }}</span>
    @else
        @isset($tip)
            <span class="text-[#C6C6C6] text-[14px]">{{ $tip }}</span>
        @endisset
    @enderror
</div>