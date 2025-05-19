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

                $("select[name='lombaCategory_id']").selectize({
                    plugins: {
                        dropdown_header: {
                            title: 'Kategori Lomba'
                        }
                    },
                })

            })

            let title, start_date, competitionLevel, penyelenggara_name, end_date, decide_date = ""
            let description, lombaCategory_id, poster, guide, preview = ""
            let minat2 = []
            let cost_PerTeam, total_hadiah, max_member,min_member, total_juara = ""
            let pic_name, pic_tel, pic_email = ""
            
            function updateVariable() {
                title = $("input[name='title']").val()
                start_date = $("input[name='start_date']").val()
                competitionLevel = $("select[name='competitionLevel']").val()
                penyelenggara_name = $("input[name='penyelenggara_name']").val()
                end_date = $("input[name='end_date']").val()
                decide_date = $("input[name='decide_date']").val()
                description = $("textarea[name='description']").val()
                minat2 = $("input[name='minat2[]']:checked").map(function() {
                    return $(this).closest('label').find('div').text().trim()
                }).get();
                cost_PerTeam = $("input[name='cost_PerTeam']").val()
                total_hadiah = $("input[name='total_hadiah']").val()
                max_member = $("input[name='max_member']").val()
                min_member = $("input[name='min_member']").val()
                total_juara = $("input[name='total_juara']").val()
                pic_name = $("input[name='pic_name']").val()
                pic_tel = $("input[name='pic_tel']").val()
                pic_email = $("input[name='pic_email']").val()
                lombaCategory_id = $("select[name='lombaCategory_id']").val()
                poster = $('input[name="poster_kompetisi"]')[0].files[0]
                guide = $('input[name="guide_book"]')[0].files[0]
                preview = $('input[name="preview_foto_kompetisi"]')[0].files[0]
            }

            function uploadCheck(file,nama, mimeTypes, maxSize = 100) {
                let pass = false
                if (file) {
                    if (mimeTypes.includes(file.type) && file.size <= maxSize * 1024 * 1024) {
                        pass = true
                    } else if (file.size > maxSize * 1024 * 1024) {
                        alert(nama + " size must be less than " + maxSize + "MB.")
                    } else {
                        alert(nama + " type must be " + mimeTypes + ".")
                    }   
                } else {
                    pass = true //if not required
                }
                return pass
            }

            function stepChecker(currentStep) {
                updateVariable()
                let pass = true
                switch (currentStep) {
                    case 1:
                        if (title === "" || start_date === "" || competitionLevel === "" || penyelenggara_name === "" || end_date === "" || decide_date === "") {
                            pass = false
                        }
                        break
                    case 2:
                        if (description === "" || minat2.length <= 0 || lombaCategory_id === "" || !uploadCheck(poster,"Poster", ["image/jpeg", "image/png", "image/jpg"], 5) || !uploadCheck(guide,"Guidebook", ["application/pdf"], 2) || !uploadCheck(preview,"Preview Foto", ["image/jpeg", "image/png", "image/jpg"], 5)) {
                            pass = false
                        }
                        break
                    case 3:
                        if (cost_PerTeam === "" || total_hadiah === "" || max_member === "" || min_member === "" || total_juara === "") {
                            pass = false
                        }
                        break    
                    case 4:
                        if (pic_name === "" || pic_tel === "" || pic_email === "") {
                            pass = false
                        }
                        break
                    default:
                        break
                }

                return pass
            }

            let step = 0
            let stepMax = 0

            function next(currentStep, currentStepMax) {
                step = currentStep
                stepMax = currentStepMax
            }

            function onSubmit() {
                event.preventDefault()

                if (step <= stepMax) {
                    return
                }

                let formData = new FormData();

                formData.append('title', title);
                formData.append('start_date', start_date);
                formData.append('competitionLevel', competitionLevel);
                formData.append('penyelenggara_name', penyelenggara_name);
                formData.append('end_date', end_date);
                formData.append('decide_date', decide_date);
                formData.append('description', description);
                formData.append('lombaCategory_id', lombaCategory_id);
                formData.append('minat', minat2);
                formData.append('cost_PerTeam', cost_PerTeam);
                formData.append('total_juara', total_juara);
                formData.append('total_hadiah', total_hadiah);
                formData.append('max_member', max_member);
                formData.append("min_member", min_member)
                formData.append('pic_name', pic_name);
                formData.append('pic_tel', pic_tel);
                formData.append('pic_email', pic_email);

                if (poster) {
                    formData.append('poster_kompetisi', poster);
                }

                if (guide) {
                    formData.append('guide_book', guide);
                }

                if (preview) {
                    formData.append('preview_foto_kompetisi', preview);
                }

                $("#confirm_button").addClass("hidden")

                $.ajax({
                    url: "{{ route('lomba-store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,  
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            
                            window.location.href = "{{ route('landing') }}"
                        } else {
                            $("#confirm_button").removeClass("hidden")
                        }
                    },
                    error: function(xhr, status, error) {
                        $("#confirm_button").removeClass("hidden")
                        console.error(xhr.responseText)
                        alert("An error occurred while submitting the form.")
                    }
                })
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
            <form method="POST" onsubmit="onSubmit()" action="{{ route('lomba-store') }}" class="flex flex-col gap-[42px] w-full"
                novalidate>

                {{-- Informasi Dasar Kompetisi --}}
                <div x-show="step === 1" class="flex flex-col gap-[42px]" name="informasi_kompetisi">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">Informasi Dasar Kompetisi</h2>
                        <br>
                    </div>

                    <div class="flex lg:flex-row flex-col gap-[44px]">
                        <div class="flex flex-col gap-[36px] w-full">
                            <x-input :required=true name="title" label="Nama Kompetisi" type="text"
                                placeholder="Masukan nama kompetisi disini" />
                            <x-input :required=true name="start_date" label="Tanggal Pendaftaran Buka" type="date"
                                placeholder="MM/DD/YYYY" min="{{ date('Y-m-d') }}" />
                                <x-select name="competitionLevel" label="{!! __('global.competitionLevel') !!}"
                                placeholder="{!! __('profiling.placeholder_competitionLevel') !!}">
                                    <option value="Internasional">Internasional</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Regional">Regional</option>
                                </x-select>
                        </div>
                        <div class="flex flex-col gap-[36px] w-full">
                            <x-input :required=true name="penyelenggara_name" label="Nama Penyelenggara" type="text"
                                placeholder="Masukan nama penyelenggara di sini" />
                            <x-input :required=true name="end_date" label="Tanggal Pendaftaran Ditutup" type="date"
                                placeholder="MM/DD/YYYY" min="{{ date('Y-m-d') }}" />
                            <x-input :required=true name="decide_date" label="Tanggal Kompetisi Berakhir" type="date"
                                placeholder="MM/DD/YYYY" min="{{ date('Y-m-d') }}" />
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
                        <x-textarea name="description" label="Deskripsi Kompetisi"
                            placeholder="Masukan deskripsi kompetisi disini" :required=true/>
                    </div>

                    <x-select name="lombaCategory_id" label="Kategori Kompetisi"
                    placeholder="Kategori Lomba" :required=true>
                        @foreach ($listCategory as $category)
                            <option value="{{ $category->id_lombaCategory }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>

                    <div>
                        <x-multi-select name="minat2" label="{!! __('profiling.interests') !!}" :required=true>
                            <div class="flex gap-[10px] flex-wrap">
                                @foreach ($listMinat as $minat)
                                    <x-minat-choose name="minat2[]" title="{{ $minat->name }}"
                                        value="{{ $minat->id_bidang }}" />
                                @endforeach
                            </div>
                        </x-multi-select>
                    </div>

                    <div class="flex relative flex-col gap-[10px] w-full">
                        <x-label name="Upload File" label="Upload File"/>
                        <div class="flex flex-row gap-2">
                            <x-upload name="poster_kompetisi" label="Upload Poster Kompetisi (.png/.jpg MAX 5MB)" accept="image/jpeg, image/png, image/jpg"/>
                            <x-upload name="guide_book" label="Upload Guidebook (.pdf MAX 2MB)" accept="application/pdf"/>
                            <x-upload name="preview_foto_kompetisi" label="Upload Preview Foto Kompetisi (.png/.jpg MAX 5MB)" accept="image/jpeg, image/png, image/jpg"/>
                        </div>
                    </div>
                </div>

                {{-- Pendaftaran & Hadiah --}}
                <div x-show="step === 3" class="flex flex-col gap-[42px]" name="detail_hadiah">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">Detail Pendaftaran & Hadiah</h2>
                        <p class="text-center text-[20px] text-gray-500">Tambahkan data riwayat prestasi agar lebih mudah ditemukan orang untuk ikut kompetisi</p>
                    </div>

                    <x-input :required=true name="cost_perTeam" label="Biaya Pendaftaran Per Tim"
                    placeholder="Masukan jumlah biaya pendaftaran (Rp)" type="number" min="1"/>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                            <x-input :required=true name="max_member" label="Maksimal Jumlah Anggota Tim"
                            placeholder="Masukan jumlah maksimal anggota per tim (contoh : 3)" type="number" min="1"/>
                            <x-input :required=true name="min_member" label="Minimal Jumlah Anggota Tim"
                            placeholder="Masukan jumlah Minimal anggota per tim (contoh : 1)" type="number" min="1"/>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-input :required=true name="total_hadiah" label="Total Hadiah"
                            placeholder="Masukan jumlah total hadiah kompetisi (Rp)" type="number" min="0"/>
                            <x-input :required=true name="total_juara" label="Total Juara"
                            placeholder="Berapa Total Juara dalam kompetisi ini " type="number" min="1"/>
                    </div>
                </div>

                {{-- Kontak Penyelenggara --}}
                <div x-show="step >= 4" class="flex flex-col gap-[42px] h-full" name="detail_akun">
                    <div class="flex flex-col gap-[6px]">
                        <h2 class="text-[40px] font-bold text-center">Kontak Penyelenggara</h2>
                        <p class="text-center text-[20px] text-gray-500">Tambahkan data riwayat prestrasi agar lebih mudah ditemukan orang untuk ikut kompetisi</p>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-input :required=true name="pic_name" label="Nama PIC"
                            placeholder="Masukan nama penanggung jawab" type="text"/>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-[44px]">
                        <x-input :required=true name="pic_tel" label="No Whatsapp PIC"
                            placeholder="Masukan Nomor Whatsapp Aktif" type=" "/>
                            <x-input :required=true name="pic_email" label="Email PIC"
                            placeholder="Masukan email resmi untuk komunikasi" type="email"/>
                    </div>
                </div>
                <div class="flex gap-[28px] justify-end">
                    <button x-show="step > 1" @click="step > 1 ? step-- : ''"
                        class="w-[144px] text-[20px] border-[1px] border-[#C6C6C6] h-[68px] text-black rounded-[10px] transition duration-300">{!! __('global.back') !!}
                    </button>
                    <button  id="confirm_button" x-text="step >= stepMax ? '{!! __('global.confirm') !!}' : '{!! __('global.next') !!}'"
                        @click="if (step <= stepMax) { if (stepChecker(step)) { step++ } next(step, stepMax) }"
                        class="w-auto text-[20px] font-manrope py-[22px] px-[39px] bg-gradient-to-b from-[#822bf2] to-[#b378ff] border-none h-[68px] text-white rounded-[10px] hover:bg-purple-700 transition duration-300">{!! __('global.next') !!}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.default>
