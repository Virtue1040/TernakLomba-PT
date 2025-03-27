<x-layouts.default footer=false>
    @isset($script)
        <x-slot name="script">
            {{ $script }}
        </x-slot>
    @endisset
    <section class="flex w-full h-screen">
        <div class="bg-white p-[42px] pb-[47px] w-[50%] h-full flex justify-center items-center">
            {{ $left_side }}
        </div>
        <div class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] w-[50%] flex flex-col justify-between h-full">
            <div class="px-[95px] flex flex-col gap-5 w-full h-[230px] text-white">
                <a class="text-[48px] font-bold mt-20 leading-[66.51px]">Kuasai Kompetisi, Perkuat Relasi dan evaluasi</a>
                <a class="text-[24px]">Temukan lomba yang ingin kamu ikuti di Ternak Lomba, dan Temukan tim baru mu!</a>
            </div>
            <div class="overflow-hidden relative w-full h-full">
                <img class="absolute bottom-[-60px] w-full h-[586px]" src="{{ asset('images/unsplash_vector.png') }}">
                <img class="absolute bottom-0 w-full h-full" src="{{ asset('images/unsplash_FPQlXQtjkqU.png') }}">
            </div>
        </div>
    </section>
</x-layouts.default>
