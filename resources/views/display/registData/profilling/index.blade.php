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
                $("select[name='kampus']").selectize({
                    plugins: {
                        dropdown_header: {
                            title: 'University'
                        }
                    },
                    sortField: 'text'
                })
                $("select[name='gender']").selectize({
                    plugins: {
                        dropdown_header: {
                            title: '{!! __('global.gender') !!}'
                        }
                    },
                })
                $("select[name='champion']").selectize({
                    plugins: {
                        dropdown_header: {
                            title: '{!! __('global.champion') !!}'
                        }
                    },
                })
                $("select[name='competitionLevel']").selectize({
                    plugins: {
                        dropdown_header: {
                            title: '{!! __('global.competitionLevel') !!}'
                        }
                    },
                })

            })

            function updateConfirmation() {
                full_name = $("input[name='full_name']").val()
                birth_date = $("input[name='birth_date']").val()
                gender = $("select[name='gender'] option:selected").text()
                birth_place = $("input[name='birth_place']").val()
                email = $("input[name='email']").val()
                telp = $("input[name='telp']").val()
                kampus = $("select[name='kampus'] option:selected").text()
                jurusan = $("input[name='jurusan']").val()
                bidang = $("input[name='bidang[]']:checked").map(function() {
                    return $(this).closest('label').find('div').text().trim()
                }).get();

                detail_full_name = $(`a[name='detail_full_name']`).html(full_name)
                detail_birth_date = $(`a[name='detail_birth_date']`).html(birth_date)
                detail_gender = $(`a[name='detail_gender']`).html(gender)
                detail_birth_place = $(`a[name='detail_birth_place']`).html(birth_place)
                detail_email = $(`a[name='detail_email']`).html(email)
                detail_telp = $(`a[name='detail_telp']`).html(telp)
                detail_kampus = $(`a[name='detail_kampus']`).html(kampus)
                detail_jurusan = $(`a[name='detail_jurusan']`).html(jurusan)
                detail_bidang = $(`a[name='detail_bidang']`).html(bidang.join(', '))
                console.log(bidang.join(', '))
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
                <x-cards.step-bullet title="{!! __('profiling.step1') !!}" order=1 :active=false />
                <x-cards.step-bullet title="{!! __('profiling.step2') !!}" order=2 :active=false />
                <x-cards.step-bullet title="{!! __('profiling.step3') !!}" order=3 :active=false />
                <x-cards.step-bullet title="{!! __('profiling.step4') !!}" order=4 :active=false />
            </x-cards.step>
            <form method="POST" action="{{ route('usersDetail-store') }}"
                @submit.prevent="step === stepMax + 1 && $el.submit()" class="flex flex-col gap-[42px] w-full"
                novalidate>
                <input name="email" value="{{ Auth::user()->email }}" hidden />

                {{-- Informasi Pribadi --}}
                <div x-show="step === 1" class="flex flex-col gap-[42px]" name="informasi_pribadi ">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">{!! __('profiling.fill_form') !!}</h2>
                        <p class="text-center text-[20px] text-gray-500">{!! __('profiling.subfill_form') !!}</p>
                    </div>

                    <h2 class="my-4 text-[24px] font-[700]">{!! __('profiling.aboutyou') !!}</h2>
                    <div class="flex lg:flex-row flex-col gap-[44px]">
                        <div class="flex flex-col gap-[36px] w-full">
                            <x-input :required=true name="full_name" label="{!! __('global.full_name') !!}" type="text"
                                placeholder="{!! __('profiling.placeholder_full_name') !!}" />
                            <x-input :required=true name="birth_date" label="{!! __('global.birth_date') !!}" type="date"
                                placeholder="MM/DD/YYYY" />
                            <x-input :required=true name="telp" label="{!! __('global.tel') !!}" type="tel"
                                placeholder="+62 08xxxxxx" />
                        </div>
                        <div class="flex flex-col gap-[36px] w-full">
                            <x-select :required=true name="gender" label="{!! __('global.gender') !!}" type="text"
                                placeholder="{!! __('profiling.placeholder_gender') !!}">
                                <option value="male">{!! __('global.male') !!}</option>
                                <option value="female">{!! __('global.female') !!}</option>
                            </x-select>
                            <x-input :required=true name="birth_place" label="{!! __('global.birth_place') !!}" type="text"
                                placeholder="{!! __('profiling.placeholder_birth_place') !!}" />
                        </div>
                    </div>
                </div>

                {{-- Akademik --}}
                <div x-show="step === 2" class="flex flex-col gap-[42px]" name="akademik">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">{!! __('profiling.fill_form') !!}</h2>
                        <p class="text-center text-[20px] text-gray-500">{!! __('profiling.subfill_form') !!}</p>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-select :required=true name="kampus" label="{!! __('global.campus') !!}"
                            placeholder="{!! __('profiling.placeholder_campus') !!}">
                            @foreach ($decoded as $university)
                                <option value="{{ $university['name'] }}">{{ $university['name'] }}</option>
                            @endforeach
                        </x-select>
                        <x-input :required=true name="jurusan" label="{!! __('global.major') !!}"
                            placeholder="{!! __('profiling.placeholder_major') !!}" />
                    </div>
                    <div>
                        <x-multi-select :required=true name="minat" label="{!! __('profiling.interests') !!}">
                            <div class="flex gap-[10px] flex-wrap">
                                @foreach ($listMinat as $minat)
                                    <x-minat-choose name="bidang[]" title="{{ $minat->name }}"
                                        value="{{ $minat->id_bidang }}" />
                                @endforeach
                            </div>
                        </x-multi-select>
                    </div>
                </div>

                {{-- Prestasi --}}
                <div x-show="step === 3" class="flex flex-col gap-[42px]" name="prestasi">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">{!! __('profiling.prestasi_form') !!}</h2>
                        <p class="text-center text-[20px] text-gray-500">{!! __('profiling.subPrestasi_form') !!}</p>
                    </div>

                    <div class="flex relative flex-col gap-[10px] w-full">
                        <label class="font-[700] font-cabinet sm:text-[15px] md:text-[18px] lg:text-[20px]">Preview Prestasi Saya</label>
                        <div class="bg-[#822BF2] p-[20px] rounded-[16px] w-[286px] h-auto flex flex-col gap-[23px]">
                            <div class="gap-[12px] w-full h-[84px] flex flex-col justify-between">
                                <div class="flex flex-col">
                                    <p class="font-[700] text-[20px] text-white">4C National Competition</p>
                                    <a class="text-[16px] text-white">Business Case</a>
                                </div>
                                <div>
                                    <a class="text-white text-[14px]">Juara 1 Nasional</a>
                                </div>
                            </div>
                            <div class="flex flex-row gap-3 h-full">
                                <button class="p-[10px] pt-3 bg-white rounded-xl text-[#822BF2] text-[14px] font-[700] h-auto">
                                    Hapus Prestasi
                                </button>
                                <button class="p-[10px] pt-3 bg-transparent border-1 border-white rounded-xl text-white text-[14px] font-[700] h-auto">
                                    Edit Prestasi
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-input name="nama_lomba " label="{!! __('global.competition') !!}"
                            placeholder="{!! __('profiling.placeholder_competition') !!}" />
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

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-select name="champion" label="{!! __('global.champion') !!}"
                            placeholder="{!! __('profiling.placeholder_champion') !!}">
                            <option value="1">Juara 1</option>
                            <option value="2">Juara 2</option>
                            <option value="3">Juara 3</option>
                        </x-select>
                        <x-select name="competitionLevel" label="{!! __('global.competitionLevel') !!}"
                        placeholder="{!! __('profiling.placeholder_competitionLevel') !!}">
                            <option value="1">Internasional</option>
                            <option value="2">Nasional</option>
                            <option value="3">Lokal</option>
                        </x-select>
                    </div>

                    <button class="w-[243px] text-[20 px] font-semibold border-[1px] border-[#822BF2] h-[68px] text-[#822BF2] rounded-[10px] transition duration-300">{!! __('profiling.addCompetition') !!}
                    </button>
                </div>

                {{-- Detail Akun --}}
                <div x-show="step >= 4" class="flex flex-col gap-[42px] h-full" name="detail_akun">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">{!! __('profiling.fill_form') !!}</h2>
                        <p class="text-center text-[20px] text-gray-500">{!! __('profiling.subfill_form') !!}</p>
                    </div>

                    <div class="flex gap-[30px] h-fit w-[1107px]">
                        <div class="flex flex-col gap-[20px] w-full border-r-[1px] border-r-[#C6C6C6]">
                            <x-detail type="input" name="full_name" label="{!! __('global.full_name') !!}"
                                text="Budi Setiawan" />
                            <x-detail type="select" name="gender" label="{!! __('global.gender') !!}" text="Male" />
                            <x-detail name="birth_date" label="{!! __('global.birth_date') !!}" text="01/01/2004" />
                            <x-detail name="birth_place" label="{!! __('global.birth_place') !!}" text="Bekasi" />
                            <x-detail name="email" label="Email" text="budi@gmail.com" />
                            <x-detail name="telp" label="{!! __('global.tel') !!}" text="081212961313" />
                        </div>
                        <div class="flex flex-col gap-[20px] w-full">
                            <x-detail type="select" name="kampus" label="{!! __('global.campus') !!}"
                                text="Telkom University" />
                            <x-detail name="jurusan" label="{!! __('global.major') !!}"
                                text="Ilmu Pengetahuan Alam (IPA)" />
                            <x-detail name="bidang" label="{!! __('global.interest') !!}"
                                text="Business Case, Business Plan, Hackathon UI/UIX" />
                            <x-detail name="referral_code" label="Referral Code (Opsional)" text="-" />
                        </div>
                    </div>
                </div>
                <div class="flex gap-[28px] justify-end">
                    <button x-show="step > 1" @click="step > 1 ? step-- : ''"
                        class="w-[144px] text-[20px] border-[1px] border-[#C6C6C6] h-[68px] text-black rounded-[10px] transition duration-300">{!! __('global.back') !!}
                    </button>
                    <button x-text="step >= stepMax ? '{!! __('global.confirm') !!}' : '{!! __('global.next') !!}'"
                        @click="if (step <= stepMax) { step++ } next(step, stepMax)"
                        class="w-[180px] text-[20px] font-manrope py-[22px] px-[39px] bg-gradient-to-b from-[#822bf2] to-[#b378ff] border-none h-[68px] text-white rounded-[10px] hover:bg-purple-700 transition duration-300">{!! __('global.next') !!}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.default>
