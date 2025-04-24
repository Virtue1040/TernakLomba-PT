@props(['name', 'label' => 'holder', 'placeholder', 'required' => false])
<div class="flex relative flex-col gap-[10px] w-full">
    <label for="{{ "input_" . $name }}" class=" font-[700] font-cabinet text-[20px]">{{ $label }}@if($required) <span class="text-red-400">*</span>@endif</label>
    <select id="{{ "input_" . $name }}" @required($required) name="{{ $name }}" {{ $attributes->merge(['class' => 'h-[66px] font-[16px] bg-white rounded-[15px] border-[1px] border-[#C6C6C6] text-[18px]']) }} placeholder="{{ $placeholder }}">
        @isset($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endisset
        {{ $slot }}
    </select>
</div>