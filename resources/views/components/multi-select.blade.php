@props(['name', 'label' => 'holder', 'required' => false, 'tip'])
<div class="flex relative flex-col gap-[10px] w-full">
    <label for="{{ "input_" . $name }}" class="font-[700] font-cabinet text-[20px]">{{ $label }}@if($required) <span class="text-red-400">*</span>@endif</label>
    {{
        $slot
    }}
</div>