<x-layouts.default footer=false>
    @isset($script)
        <x-slot name="script">
            {{ $script }}
        </x-slot>
    @endisset
    <section class="flex flex-col w-full min-h-screen lg:flex-row">
        <div class="bg-white p-5 sm:p-6 lg:p-[42px] w-full lg:w-1/2 flex justify-center items-center min-h-screen">
            <div class="w-full max-w-[606px] px-4 sm:px-6 lg:px-0">
                {{ $left_side }}
            </div>
        </div>
        
        <div class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] w-full lg:w-1/2 hidden lg:flex lg:flex-col lg:justify-between min-h-screen">
            <div class="px-8 xl:px-[95px] flex flex-col gap-4 xl:gap-5 w-full pt-12 xl:pt-20 text-white">
                <h1 class="text-3xl xl:text-[48px] font-bold leading-tight xl:leading-[66.51px]">Kuasai Kompetisi, Perkuat Relasi dan evaluasi</h1>
                <p class="text-xl xl:text-[24px]">Temukan lomba yang ingin kamu ikuti di Ternak Lomba, dan Temukan tim baru mu!</p>
            </div>
            <div class="overflow-hidden relative flex-grow w-full">
                <img class="absolute bottom-[-30px] xl:bottom-[-60px] w-full h-auto xl:h-[586px] object-contain" src="{{ asset('images/unsplash_vector.png') }}">
                <img class="object-cover absolute bottom-0 w-full h-full" src="{{ asset('images/unsplash_FPQlXQtjkqU.png') }}">
            </div>
        </div>
    </section>
</x-layouts.default>