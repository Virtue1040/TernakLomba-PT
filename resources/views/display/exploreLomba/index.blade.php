<x-layouts.default footer=false>
    <section class="text-center px-6 relative bg-gradient-to-b from-[#822bf2] to-[#b378ff] h-[310px]">
        <x-navbar/>
        <div class="mt-4 flex flex-col gap-8 p-6 px-12 max-w-[1175px] w-full">
            <h1 class="font-bold text-[48px] text-left leading-[110%] tracking-[-0.03em] text-white">Explore Lomba</h1>
            <div class="flex gap-3">
                <x-finder class="w-[500px]" icon_pos="left"/>
                <x-filter class="w-[112px]"/>
            </div>
        </div>
    </section>
    <section class="p-6 pt-2">
        <div x-data="{ menu: 'kompetisi' }" class="flex flex-col gap-8 px-12">
            <div class="flex flex-col gap-4" name="tab">
                <div class="flex w-full h-[63px]">
                    <button @click="menu = 'kompetisi'" class="w-auto py-[20px] px-[24px] font-[18px] h-full border-b-[2px]"
                        x-bind:class="menu === 'kompetisi' ? 'text-[#B378FF] border-b-[#B378FF]' : 'border-b-transparent'">
                        <b>Kompetisi</b>
                    </button>
                    <button @click="menu = 'orang'" class="w-auto py-[20px] px-[24px] font-[18px] h-full border-b-[2px]"
                        x-bind:class="menu === 'orang' ? 'text-[#B378FF] border-b-[#B378FF]' : 'border-b-transparent'">
                        <b>Orang</b>
                    </button>
                </div>
                <div class="flex gap-4 w-full h-[52px] items-center" name="filter">
                    <x-filter class="w-[105px] !bg-[#F0F0F0] h-[44px]"/>    
                    <div class="w-[1px] h-[50%] bg-[#F0F0F0]">
                    </div>
                    <div class="flex gap-2">
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
                </div>
            </div>
            <div x-show="menu === 'kompetisi'" class="flex overflow-x-auto flex-row gap-4 w-full">
                <x-cards.lomba-card title="4C National Competition" university="Stanford University"/>
                <x-cards.lomba-card title="4C National Competition" university="Stanford University"/>
            </div>
        </div>
    </section>
</x-layouts.default>