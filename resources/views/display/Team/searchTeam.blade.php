<x-layouts.default footer=false>
    <div class="p-4 max-cards.h-screen bg-gradient-to-b from-[#822bf2] to-[#b378ff]">
        <x-nav-2 title="Compspace" ItemColor="text-white" />

        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-[48px] max-w-[300px] sm:max-w-[450px] md:max-w-[500px] lg:max-w-[600px] font-bold text-center text-white mx-auto my-3 mt-5 lg:leading-[120%]">
            Temukan Compspace dan
            Bergabung Dengan Tim
        </h1>
        <div class="flex justify-center my-8 mb-7">
            <x-finder class="lg:w-[671px] md:w-[500px] sm:w-[400px] lg:h-[60px] md:h-[55px] sm:h-[50px] h-[45px] !pr-[142px]" placeholder="Masukkan Kode Compspace untuk Join atau Cari dibawah ini">
                <x-slot name="icon">
                    <button class="flex justify-center items-center px-4 w-full h-8 text-sm font-bold text-white bg-black rounded-full lg:text-base sm:h-9 md:h-10 lg:h-11 sm:px-5 lg:px-6">
                        Lihat Hasil
                    </button>
                </x-slot>
            </x-finder>
        </div>
    </div>

    <div class="flex overflow-x-auto gap-2 p-4">
        <div class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
            All
        </div>
        <div class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
            Finance
        </div>
        <div class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
            Business
        </div>
        <div class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
            Design
        </div>
        <div class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
            AI & Machine Learning
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 px-4 pb-4 mx-auto w-full max-w-6xl">
        <x-cards.team-card team-name="Sayonara Team" date="Des 2021"
            description="Halo gais, kami lagi butuh UI/UX Designer dengan UX Researcher" participants="2/4" />
        <x-cards.team-card team-name="Sayonara Team" date="Des 2021"
            description="Halo gais, kami lagi butuh UI/UX Designer dengan UX Researcher" participants="2/4" />
        <x-cards.team-card team-name="Sayonara Team" date="Des 2021"
            description="Halo gais, kami lagi butuh UI/UX Designer dengan UX Researcher" participants="2/4" />
        <x-cards.team-card team-name="Sayonara Team" date="Des 2021"
            description="Halo gais, kami lagi butuh UI/UX Designer dengan UX Researcher" participants="2/4" />
    </div>
</x-layouts.default>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>