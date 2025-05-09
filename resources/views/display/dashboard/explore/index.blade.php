<x-layouts.navigation>
    <section class="text-center px-6 relative bg-gradient-to-b from-[#822bf2] to-[#b378ff] h-fit">
        <div class="flex flex-col gap-8 p-6 px-4 w-full">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-[48px] text-left leading-[110%] tracking-[-0.03em] text-white">
                    Explore
                </h1>
                <button>
                    <svg width="65" height="66" viewBox="0 0 65 66" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_354_1993)">
                            <path
                                d="M35.2924 45.006C35.0578 45.4103 34.7212 45.7459 34.3162 45.9792C33.9112 46.2125 33.452 46.3353 32.9846 46.3353C32.5172 46.3353 32.058 46.2125 31.653 45.9792C31.2479 45.7459 30.9113 45.4103 30.6768 45.006M40.9884 27.6643C40.9884 25.5415 40.1452 23.5057 38.6442 22.0047C37.1431 20.5037 35.1073 19.6604 32.9846 19.6604C30.8618 19.6604 28.826 20.5037 27.325 22.0047C25.824 23.5057 24.9807 25.5415 24.9807 27.6643C24.9807 37.0021 20.9788 39.6701 20.9788 39.6701H44.9904C44.9904 39.6701 40.9884 37.0021 40.9884 27.6643Z"
                                stroke="#D4D0D0" stroke-width="2.66796" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="39.3875" cy="23.3955" r="6.4031" fill="#921923" stroke="white"
                                stroke-width="3.20155" />
                        </g>
                        <defs>
                            <filter id="filter0_d_354_1993" x="-2.08703" y="-0.543393" width="70.1431"
                                height="70.1431" filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dy="1.52801" />
                                <feGaussianBlur stdDeviation="1.52801" />
                                <feComposite in2="hardAlpha" operator="out" />
                                <feColorMatrix type="matrix"
                                    values="0 0 0 0 0.905208 0 0 0 0 0.913917 0 0 0 0 0.916667 0 0 0 0.25 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix"
                                    result="effect1_dropShadow_354_1993" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_354_1993"
                                    result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </button>
            </div>
            <div class="flex sm:flex-row flex-col gap-3 mt-[100px]">
                <div class="w-full md:w-full lg:w-[500px] h-auto">
                    <x-finder class="w-full" icon_pos="left" placeholder="Cari Lomba" />
                </div>
                <x-filter class="w-full md:w-auto lg:w-[112px] h-auto md:h-[50px]" />
            </div>
        </div>
    </section>
    <section class="p-6 pt-2">
        <div x-data="{ menu: 'kompetisi' }" class="flex flex-col gap-8 px-4">
            <div class="flex flex-col gap-4" name="tab">
                <div class="flex w-full h-[63px]">
                    <button @click="menu = 'kompetisi'"
                        class="w-auto py-[20px] px-[24px] font-[18px] h-full border-b-[2px]"
                        x-bind:class="menu === 'kompetisi' ? 'text-[#B378FF] border-b-[#B378FF]' : 'border-b-transparent'">
                        <b>Kompetisi</b>
                    </button>
                    <button @click="menu = 'orang'"
                        class="w-auto py-[20px] px-[24px] font-[18px] h-full border-b-[2px]"
                        x-bind:class="menu === 'orang' ? 'text-[#B378FF] border-b-[#B378FF]' : 'border-b-transparent'">
                        <b>Orang</b>
                    </button>
                </div>
                <div class="flex gap-4 w-full h-[52px] items-center" name="filter">
                    {{-- <x-filter class="w-[105px] !bg-[#F0F0F0] h-[44px]" /> --}}
                    <div class="w-[1px] h-[50%] bg-[#F0F0F0]">
                    </div>
                    <div class="flex overflow-x-auto gap-2">
                        <div
                            class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
                            All
                        </div>
                        <div
                            class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
                            Finance
                        </div>
                        <div
                            class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
                            Business
                        </div>
                        <div
                            class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
                            Design
                        </div>
                        <div
                            class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
                            AI & Machine Learning
                        </div>
                    </div>
                </div>
            </div>
            <div x-show="menu === 'kompetisi'" class="flex overflow-x-auto flex-row gap-4 w-full">
                <x-cards.lomba-card title="4C National Competition" university="Stanford University" />
                <x-cards.lomba-card title="4C National Competition" university="Stanford University" />
                <x-cards.lomba-card title="4C National Competition" university="Stanford University" />
                <x-cards.lomba-card title="4C National Competition" university="Stanford University" />
                <x-cards.lomba-card title="4C National Competition" university="Stanford University" />
                <x-cards.lomba-card title="4C National Competition" university="Stanford University" />
                <x-cards.lomba-card title="4C National Competition" university="Stanford University" />
                <x-cards.lomba-card title="4C National Competition" university="Stanford University" />
            </div>
            <div x-show="menu === 'orang'" class="flex overflow-x-auto flex-row gap-4 py-1 w-full">
                <x-cards.orang-card />
                <x-cards.orang-card />
                <x-cards.orang-card />
                <x-cards.orang-card />
                <x-cards.orang-card />
                <x-cards.orang-card />
                <x-cards.orang-card />
                <x-cards.orang-card />
                <x-cards.orang-card />
            </div>
        </div>
    </section>
</x-navigation>