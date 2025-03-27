<x-layouts.default footer=false>
    <div class="p-4 max-cards.h-screen bg-gradient-to-b from-[#822bf2] to-[#b378ff]">
        <x-nav-2 title="Compspace" ItemColor="text-white" />

        <h1 class="text-[48px] max-w-[600px] font-bold text-center text-white mx-auto my-3">Temukan Compspace
            dan Bergabung Denga Tim</h1>

        <div class="flex justify-center my-5">
            <x-finder class="w-[671px] h-[60px] !pr-[142px]" placeholder="Masukkan Kode Compspace untuk Join atau Cari dibawah ini">
                <x-slot name="icon">
                    <button class="font-[700] px-6 py-2 w-full h-[44px] text-sm text-white bg-black rounded-full transition-colors hover:bg-gray-800">
                        Lihat Hasil
                    </button>
                </x-slot>
            </x-finder>
        </div>
    </div>

    <div class="flex gap-2 p-4">
        <div class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full">
            All
        </div>
        <div class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full">
            Finance
        </div>
        <div class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full">
            Business
        </div>
        <div class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full">
            Design
        </div>
        <div class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full">
            AI & Machine Learning
        </div>
    </div>

    <div class="grid grid-cols-4 gap-4 px-4 pb-4">
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
