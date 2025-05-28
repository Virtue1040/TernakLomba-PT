<x-layouts.navigation>
    <section class="text-center px-6 relative bg-gradient-to-b from-[#822bf2] to-[#b378ff] h-fit">
        <div class="flex flex-col gap-8 p-6 px-4 w-full">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-[48px] text-left leading-[110%] tracking-[-0.03em] text-white">
                    Explore
                </h1>
                <div x-data="{ showPopup: false }" class="flex relative items-center space-x-4">
                    <div x-show="showPopup" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" @click.away="showPopup = false"
                        class="absolute top-16 left-[-200px] md:left-[-300px] w-[320px] md:w-[400px] bg-white rounded-lg shadow-lg overflow-hidden z-50 text-left">
                        <!-- N 1 -->
                        <div class="p-4 border-b border-gray-100">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 mr-4 bg-purple-100 rounded-full">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-base text-gray-700">
                                        <span class="font-semibold">Fathie</span> telah mengajukan diri untuk bergabung
                                        ke dalam Compspace <span class="font-semibold">Tim Hore</span>
                                    </p>
                                    <div class="flex mt-3 space-x-2">
                                        <button
                                            class="px-6 py-2 text-white bg-black rounded-full transition-colors hover:bg-gray-800">
                                            Terima
                                        </button>
                                        <button
                                            class="px-6 py-2 text-black bg-white rounded-full border border-gray-300 transition-colors hover:bg-gray-50">
                                            Tolak
                                        </button>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">2m ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- N 2 -->
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 mr-4 bg-orange-100 rounded-full">
                                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-base text-gray-700">
                                        Selamat! Kamu telah diterima di Compspace <span class="font-semibold">Tim
                                            Hore!</span>
                                    </p>
                                    <div class="flex mt-3 space-x-2">
                                        <button
                                            class="px-6 py-2 text-white bg-black rounded-full transition-colors hover:bg-gray-800">
                                            Lihat Detail
                                        </button>
                                        <button
                                            class="flex justify-center items-center px-6 py-2 text-black bg-white rounded-full border border-gray-300 transition-colors hover:bg-gray-50">
                                            <svg class="mr-1 w-5 h-5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path
                                                    d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                            </svg>
                                            Chat
                                        </button>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">2m ago</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
                    <button @click="menu = 'orang'" class="w-auto py-[20px] px-[24px] font-[18px] h-full border-b-[2px]"
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
            <div class="grid grid-cols-1 w-full">

                <div x-show="menu === 'kompetisi'" class="flex overflow-x-auto gap-4 pb-2 w-full">
                    @foreach ($lombas as $lomba)
                        @if (now()->between($lomba->start_date, $lomba->end_date))
                            <a href="/detail/{{ $lomba->id_lomba }}">
                                <x-cards.lomba-card title="{{ $lomba->lombaDetail->title }}"
                                    university="{{ $lomba->lombaDetail->penyelenggara_name }}" startDate="{{ $lomba->start_date }}"
                                    endDate="{{ $lomba->end_date }}" gambar="{{ $lomba->id_lomba }}"/>
                            </a>
                        @endif
                    @endforeach
                </div>
                <div x-show="menu === 'orang'" class="flex overflow-x-auto gap-4 pb-2 w-full">
                    @foreach ($users as $user)
                        @php
                            $prestasiArray = $user->prestasi->map(function($p) {
                                return "{$p->title} - Juara {$p->juara} - Tingkat {$p->tingkatan}";
                            })->toArray();
                        @endphp
                        <a href="/profile/{{ $user->id_user }}">
                            <x-cards.orang-card name="{{ $user->lombaDetail->first_name ?? '' }} {{ $user->lombaDetail->last_name ?? '' }}" 
                                kampus="{{ $user->mahasiswa->kampus ?? '-' }}" :prestasi="$prestasiArray"/>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-layouts.navigation>
