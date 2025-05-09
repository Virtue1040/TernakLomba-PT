<?php
$universities = file_get_contents('http://universities.hipolabs.com/search?country=indonesia');
$decoded = json_decode($universities, true);
?>
<x-layouts.default footer=false>
    <x-slot name="script">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
            integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(function() {
                $("select[name='competitionLevel']").selectize({
                    plugins: {
                        dropdown_header: {
                            title: '{!! __('global.competitionLevel') !!}'
                        }
                    },
                })

            })

            function updateConfirmation() {
x 
            }

            function next(step, stepMax) {
                if (step === stepMax) {
                    updateConfirmation()
                }
            }
        </script>
    </x-slot>

    <x-setup-topbar />
    <div class="flex justify-center items-center w-[70%] mx-auto">
        <div x-data="{ step: 1, stepMax: 4 }" class="flex flex-col gap-[58px] p-8 px-0 w-full max-w-[1107px] mt-8 items-center">
            <x-cards.step>
                <x-cards.step-bullet title="Informasi Kompetisi" order=1 :active=false />
                <x-cards.step-bullet title="Panduan" order=2 :active=false />
                <x-cards.step-bullet title="Pendaftaran & Hadiah" order=3 :active=false />
                <x-cards.step-bullet title="Kontak Penyelenggara" order=4 :active=false />
            </x-cards.step>
            <form method="POST" action="{{ route('usersDetail-store') }}"
                @submit.prevent="step === stepMax + 1 && $el.submit()" class="flex flex-col gap-[42px] w-full"
                novalidate>

                {{-- Informasi Dasar Kompetisi --}}
                <div x-show="step === 1" class="flex flex-col gap-[42px]" name="informasi_kompetisi">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">Informasi Dasar Kompetisi</h2>
                        <br>
                    </div>

                    <div class="flex lg:flex-row flex-col gap-[44px]">
                        <div class="flex flex-col gap-[36px] w-full">
                            <x-input :required=true name="lomba_name" label="Nama Kompetisi" type="text"
                                placeholder="Masukan nama kompetisi disini" />
                            <x-input :required=true name="opening_date" label="Tanggal Pendaftaran Buka" type="date"
                                placeholder="MM/DD/YYYY" />
                                <x-select name="competitionLevel" label="{!! __('global.competitionLevel') !!}"
                                placeholder="{!! __('profiling.placeholder_competitionLevel') !!}">
                                    <option value="1">Internasional</option>
                                    <option value="2">Nasional</option>
                                    <option value="3">Lokal</option>
                                </x-select>
                        </div>
                        <div class="flex flex-col gap-[36px] w-full">
                            <x-input :required=true name="penyelenggara_name" label="Nama Penyelenggara" type="text"
                                placeholder="Masukan nama penyelenggara di sini" />
                            <x-input :required=true name="closing_date" label="Tanggal Pendaftaran Ditutup" type="date"
                                placeholder="MM/DD/YYYY" />
                            <x-input :required=true name="end_date" label="Tanggal Kompetisi Berakhir" type="date"
                                placeholder="MM/DD/YYYY" />
                        </div>
                    </div>
                </div>

                {{-- Panduan --}}
                <div x-show="step === 2" class="flex flex-col gap-[42px]" name="akademik">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">Deskripsi & Panduan</h2>
                        <br>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-input name="nama_lomba " label="Deskripsi Kompetisi"
                            placeholder="Masukan deskripsi kompetisi disini" />
                    </div>

                    <div>
                        <x-multi-select name="minat2" label="{!! __('profiling.interests') !!}">
                            <div class="flex gap-[10px] flex-wrap">
                                @foreach ($listMinat as $minat)
                                    <x-minat-choose name="bidang[]" title="{{ $minat->name }}"
                                        value="{{ $minat->id_bidang }}" />
                                @endforeach
                            </div>
                        </x-multi-select>
                    </div>
                </div>

                {{-- Pendaftaran & Hadiah --}}
                <div x-show="step === 3" class="flex flex-col gap-[42px]" name="detail_hadiah">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">Detail Pendaftaran & Hadiah</h2>
                        <p class="text-center text-[20px] text-gray-500">Tambahkan data riwayat prestasi agar lebih mudah ditemukan orang untuk ikut kompetisi</p>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-input name="cost_perTeam" label="Biaya Pendaftaran Per Tim"
                            placeholder="Masukan jumlah biaya pendaftaran (Rp)" type="number"/>
                            <x-input name="max_member" label="Maksimal Jumlah Anggota Tim"
                            placeholder="Masukan jumlah maksimal anggota per tim (contoh : 3)" type="number"/>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-input name="total_hadiah" label="Total Hadiah"
                            placeholder="Masukan jumlah total hadiah kompetisi (Rp)" type="number"/>
                            <x-input name="cost_perTeam" label="Total Juara"
                            placeholder="Berapa Total Juara dalam kompetisi ini " type="number"/>
                    </div>
                </div>

                {{-- Kontak Penyelenggara --}}
                <div x-show="step >= 4" class="flex flex-col gap-[42px] h-full" name="detail_akun">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">Kontak Penyelenggara</h2>
                        <p class="text-center text-[20px] text-gray-500">Tambahkan data riwayat prestrasi agar lebih mudah ditemukan orang untuk ikut kompetisi</p>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-input name="pic_name" label="Nama PIC"
                            placeholder="Masukan nama penanggung jawab" type="text"/>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-input name="pic_tel" label="No Whatsapp PIC"
                            placeholder="Masukan Nomor Whatsapp Aktif" type=" "/>
                            <x-input name="pic_email" label="Email PIC"
                            placeholder="Masukan email resmi untuk komunikasi" type="email"/>
                    </div>
                </div>
                <div class="flex gap-[28px] justify-end">
                    <button x-show="step > 1" @click="step > 1 ? step-- : ''"
                        class="w-[144px] text-[20px] border-[1px] border-[#C6C6C6] h-[68px] text-black rounded-[10px] transition duration-300">{!! __('global.back') !!}
                    </button>
                    <button x-text="step >= stepMax ? 'Daftarkan Kompetisi' : '{!! __('global.next') !!}'"
                        @click="if (step <= stepMax) { step++ } next(step, stepMax)"
                        class="w-auto text-[20px] font-manrope py-[22px] px-[39px] bg-gradient-to-b from-[#822bf2] to-[#b378ff] border-none h-[68px] text-white rounded-[10px] hover:bg-purple-700 transition duration-300">{!! __('global.next') !!}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.default>
