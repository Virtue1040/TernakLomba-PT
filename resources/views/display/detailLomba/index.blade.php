<x-layouts.default footer=false>
    <x-slot name="script">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            function approve(id_lomba) {
                $.ajax({
                    url: "/api/v1/lomba" + '/' + id_lomba,
                    method: "POST",
                    data: {
                    },
                    success: function(data) {
                        alert("Lomba approved")
                        window.location.reload()
                    }
                })
            }

            function reject(id_lomba) {
                $.ajax({
                    url: "/api/v1/lomba" + '/' + id_lomba,
                    method: "POST",
                    data: {
                        _method: 'DELETE',
                    },
                    success: function(data) {
                        alert("Lomba rejected")
                        window.location.reload()
                    }
                })
            }
        </script>
    </x-slot>
    <div class="mx-auto w-full lg:max-w-[1200px]">
        <div class="mx-auto bg-white md:p-7">
            <x-nav-2 title="Detail Kompetisi" ItemColor="text-black" />

            <div class="relative">
                <div class="w-full h-[200px] md:h-[320px] flex items-center justify-center">
                    <img src="{{ asset('documents/lomba/' . $lomba->id_lomba . "/preview_foto_kompetisi.png") }}" alt="4C National Competition Banner"
                        class="w-full h-full rounded-t-[16px] object-cover object-center">
                </div>
                <div class="absolute left-4 -bottom-10 md:-bottom-12 md:left-8">
                    <div
                        class="flex justify-center items-center w-20 h-20 bg-blue-800 rounded-full border border-white md:w-24 md:h-24">
                        <img src="{{ asset('images/4cnational.png') }}" alt="4C Logo"
                            class="object-contain w-full h-full rounded-full">
                    </div>
                </div>

            </div>

            <div x-data="{ formOpen: false }"
                class="flex flex-col gap-2 justify-end mt-12 mb-2 w-full sm:flex-row sm:gap-4 sm:mt-4 sm:w-auto">
                @guest                    
                    <button @click="formOpen = true"
                        class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white font-semibold px-4 sm:px-8 py-2 sm:py-3 rounded-full hover:from-[#822bf2] hover:to-[#822bf2] transition text-sm sm:text-base">
                        Daftar & Buat Compspace
                    </button>
                @endguest

                @auth       
                    @if ($user->hasRole('Admin') && !$lomba->isApproved)
                        <button onclick="approve({{ $lomba->id_lomba }})"
                            class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white font-semibold px-4 sm:px-8 py-2 sm:py-3 rounded-full hover:from-[#822bf2] hover:to-[#822bf2] transition text-sm sm:text-base">
                            Setuju Kompetisi
                        </button>
                        <button onclick="reject({{ $lomba->id_lomba }})"
                            class="px-4 py-2 text-sm font-semibold text-gray-800 bg-white rounded-full border transition sm:px-8 sm:py-3 hover:bg-gray-100 sm:text-base">
                            Tolak Pengajuan
                        </button>
                    @else
                        <button onclick="window.location.href='{{ route('lomba-compspace', $lomba->id_lomba) }}'"
                            class="px-4 py-2 text-sm font-semibold text-gray-800 bg-white rounded-full border transition sm:px-8 sm:py-3 hover:bg-gray-100 sm:text-base">
                            Cari Tim & Compspace
                        </button>
                        <button @click="formOpen = true"
                            class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white font-semibold px-4 sm:px-8 py-2 sm:py-3 rounded-full hover:from-[#822bf2] hover:to-[#822bf2] transition text-sm sm:text-base">
                            Daftar & Buat Compspace
                        </button>
                    @endif
                @endauth


                <div x-show="formOpen" x-cloak
                    class="flex fixed inset-0 top-[-15px] z-50 justify-center items-center bg-black bg-opacity-50"
                    @click.self="formOpen = false">
                    <div class="bg-white rounded-[16px] w-full max-w-md mx-4 p-6 space-y-4">
                        <h2 class="text-xl font-semibold">Buat Compsace</h2>

                        <form action="{{ route("lombaTeam-store") }}" method="POST">
                            @csrf
                            <input name="lomba_id" value="{{ $lomba->id_lomba }}" hidden readonly/>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="team_name">
                                    Nama Tim <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="team_name" id="team_name"
                                    class="px-3 py-2 w-full rounded-lg border border-[#C6C6C6] focus:outline-none focus:ring-2"
                                    placeholder="Masukan nama tim" required>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="max_member">
                                    Jumlah Maks Anggota <span class="text-red-400">*</span>
                                </label>
                                <select name="max_member" id="max_member"
                                    class="px-3 py-2 w-full rounded-lg border border-[#C6C6C6] focus:outline-none focus:ring-2" required>
                                    <option class="text-gray-400" value="">Masukkan Jumlah Aggota</option>
                                    @for ($i = 1; $i <= $lomba->max_member; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            {{-- <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="rolePosition">
                                    Cabang Komepetisi <span class="text-red-400">*</span>
                                </label>
                                <select name="role_position" id="rolePosition"
                                    class="px-3 py-2 w-full rounded-lg border border-[#C6C6C6] focus:outline-none focus:ring-2" required>
                                    <option value="">Select the role need</option>
                                    <option value="ui/ux">UI/UX Designer</option>
                                </select>
                            </div> --}}

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="isPrivate">
                                    Apakah private? <span class="text-red-400">*</span>
                                </label>
                                <select name="isPrivate" id="isPrivate"
                                    class="px-3 py-2 w-full rounded-lg border border-[#C6C6C6] focus:outline-none focus:ring-2" required>
                                    <option value="1">Ya</option>
                                    <option selected value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="rolePosition">
                                    Opsi Aggota
                                </label>
                                <select name="role_position" id="rolePosition"
                                    class="px-3 py-2 w-full rounded-lg border border-[#C6C6C6] focus:outline-none focus:ring-2" required>
                                    <option value="">Select the role need</option>
                                    <option value="ui/ux">UI/UX Designer</option>

                                </select>
                            </div> --}}

                            <div class="flex justify-end space-x-4">
                                <button type="button" @click="formOpen = false"
                                    class="px-5 py-2 text-black rounded-md border border-gray-500">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-white bg-gradient-to-b from-[#822bf2] to-[#b378ff] rounded-md">
                                    Selanjutnya
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="px-4 md:px-8">
            <p class="text-sm text-gray-600">{{ $lomba->lombaDetail->penyelenggara_name }}</p>
            <h2 class="mt-1 text-xl font-bold md:text-2xl">{{ $lomba->lombaDetail->title }}</h2>

            <div class="flex flex-col gap-6 mt-6 md:flex-row md:mt-8 md:gap-8">
                <div class="w-full md:w-1/2">
                    <h3 class="mb-3 text-lg font-semibold md:mb-4">Deskripsi Kompetisi</h3>
                    <p class="mb-2 text-gray-700">
                        {{ $lomba->lombaDetail->description }}
                        {{-- 4C National Competition adalah kompetisi tingkat nasional yang diselenggarakan oleh Fakultas
                        Ilmu
                        Komputer,
                        Universitas Brawijaya (FILKOM UB) dalam rangkaian peringatan kegiatan Dies Natalis ke-13.
                        Kompetisi ini diperuntukkan bagi para mahasiswa Perguruan Tinggi diseluruh Indonesia yang ingin
                        mengasah kemampuan berpikir kritis, kolaborasi, kreativitas dan komunikasi. --}}
                    </p>
                    {{-- <p class="text-sm text-gray-500">Source: Wikipedia</p> --}}
                </div>

                <div class="w-full md:w-1/2">
                    <a href="{{ asset("documents/lomba/" . $lomba->id_lomba . "/guide_book.pdf") }}" download
                        class="flex justify-between items-center py-3 border-b cursor-pointer hover:text-blue-600">
                        <span class="font-semibold">Download Guidebook</span>
                        <i class="text-gray-500 fas fa-chevron-right"></i>
                    </a>
                    <a href="{{ asset("documents/lomba/" . $lomba->id_lomba . "/poster_kompetisi.png") }}" download
                        class="flex justify-between items-center py-3 border-b cursor-pointer hover:text-blue-600">
                        <span class="font-semibold">Download Poster</span>
                        <i class="text-gray-500 fas fa-chevron-right"></i>
                    </a>
                </div>

            </div>

            <div class="grid grid-cols-3 gap-2 mt-6 sm:flex sm:flex-wrap md:gap-4 md:mt-8">
                <div class="border rounded-md p-3 md:p-4 w-[110px] md:w-36 overflow-hidden">
                    <h4 class="text-lg font-bold md:text-xl">Rp. {{ $lomba->getTotalMoneyHadiah() }}</h4>
                    <p class="text-xs text-gray-600 md:text-sm">Total Hadiah</p>
                </div>
                <div class="border rounded-md p-3 md:p-4 w-[110px] md:w-36">
                    <h4 class="text-lg font-bold md:text-xl">5 Cabang</h4>
                    <p class="text-xs text-gray-600 md:text-sm">Jenis Kompetisi</p>
                </div>
                <div class="border rounded-md p-3 md:p-4 w-[110px] md:w-36">
                    <h4 class="text-lg font-bold md:text-xl">{{ $lomba->getTeams->count() }} Tim</h4>
                    <p class="text-xs text-gray-600 md:text-sm">Tim Terdaftar</p>
                </div>
            </div>

            <div class="mt-6 mb-8 md:mt-8 md:mb-12">
                <h3 class="mb-3 text-lg font-semibold md:mb-4">Cabang Kompetisi</h3>

                <div class="flex flex-wrap gap-3 md:gap-4">
                    <x-cards.cabangKompetisi-card title="Web Development" prize="40.000" benefit="5 Juta"
                        wajibTim="Wajib" />
                    <x-cards.cabangKompetisi-card title="Web Development" prize="40.000" benefit="5 Juta"
                        wajibTim="Wajib" />
                    <x-cards.cabangKompetisi-card title="Web Development" prize="40.000" benefit="5 Juta"
                        wajibTim="Wajib" />
                </div>

            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-layouts.default>
