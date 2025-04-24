@props(["title" => "", "order" => 1, "active" => false])
<div class="flex flex-col gap-3 items-center w-[233px] ">
    <div class="flex relative justify-center w-full h-fit">
        <div x-bind:class="step >= {{ $order }} ? '!bg-gradient-to-b !from-[#822bf2] !to-[#b378ff] !opacity-100' : ''" 
        class="rounded-full w-[36.36px] p-[2px] h-[36.36px] relative z-10
            @if($active)
                bg-gradient-to-b from-[#822bf2] to-[#b378ff] 
            @else
                bg-[#141111] opacity-20
            @endif
            flex justify-center items-center">
            
            <a class="text-[24px] font-[700] text-white">{{ $order }}</a>
        </div>
        <div x-bind:class="`${stepMax === {{ $order }} ? 'w-0' : 'w-[196.8px]'} ${step > {{ $order }} ? '!bg-gradient-to-b !from-[#822bf2] !to-[#b378ff] !opacity-100' : ''}`"
        class=" right-0 
        @if ($active)
            bg-gradient-to-b from-[#822bf2] to-[#b378ff] 
        @else
            bg-[#141111] opacity-20
        @endif
        h-[3px] absolute top-1/2 left-[57.8%] transform -translate-y-1/2 z-0"></div>
    </div>

    <a x-bind:class="step >= {{ $order }} ? '!text-[#B378FF] !opacity-100' : ''"  class="font-manrope text-[24px] 
        @if ($active)
            text-[#B378FF]
        @else
            text-[#141111] opacity-20
        @endif
    ">{{ $title }}</a>
</div>
