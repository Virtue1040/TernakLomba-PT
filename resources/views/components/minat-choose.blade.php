@props(["name", "title" => '', 'value' => ''])
<?php
    $class = "peer hidden p-5 font-[16px] bg-white rounded-[15px] text-[18px]";
    if ($errors->has($value)) {
        $class = "$class border-[2px] border-red-400";
    } else {
        $class = "$class border-[2px] border-[#C6C6C6]";
    }
?>
<div>
    <label for="{{ "input_" . $name . $title}}">
        <input hidden type="checkbox" id="{{ "input_" . $name . $title}}" name="{{ $name }}" value="{{ $value }}" {{ $attributes->merge(['class' => $class]) }}/>
        <div class="cursor-pointer w-[268px] h-[62px] border-[1px] border-[#C6C6C6] text-[#C6C6C6] text-[20px] font-[500] font-manrope px-[20px] py-[15px] rounded-[15px] flex justify-center items-center
            peer-checked:bg-[#822BF20D] peer-checked:bg-opacity-5 peer-checked:border-[#822BF2] peer-checked:text-[#822BF2]">
            {{ $title }}    
        </div>
    </label>
</div>