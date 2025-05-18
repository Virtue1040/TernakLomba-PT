<x-layouts.default footer=false>
    <div class="p-4 mx-auto bg-white max-w-screen md:p-7">
        <x-nav-2 title="Detail Kompetisi" ItemColor="text-black" />

        <div class="relative">
            <div class="w-full h-[200px] md:h-[320px] flex items-center justify-center">
                <img src="{{ asset('images/4cnational.png') }}" alt="4C National Competition Banner"
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
            <button @click="formOpen = true"
                class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white font-semibold px-4 sm:px-8 py-2 sm:py-3 rounded-full hover:from-[#822bf2] hover:to-[#822bf2] transition text-sm sm:text-base">
                Daftar & Buat Compspace
            </button>
            <button
                class="px-4 py-2 text-sm font-semibold text-gray-800 bg-white rounded-full border transition sm:px-8 sm:py-3 hover:bg-gray-100 sm:text-base">
                Cari Tim & Compspace
            </button>

            <button class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white font-semibold px-4 sm:px-8 py-2 sm:py-3 rounded-full hover:from-[#822bf2] hover:to-[#822bf2] transition text-sm sm:text-base">
                Setuju Kompetisi
            </button>
            <button
                class="px-4 py-2 text-sm font-semibold text-gray-800 bg-white rounded-full border transition sm:px-8 sm:py-3 hover:bg-gray-100 sm:text-base">
                Tolak Pengajuan
            </button>

            <div x-show="formOpen" x-cloak
                class="flex fixed inset-0 top-[-15px] z-50 justify-center items-center bg-black bg-opacity-50"
                @click.self="formOpen = false">
                <div class="bg-white rounded-[16px] w-full max-w-md mx-4 p-6 space-y-4">
                    <h2 class="text-xl font-semibold">Buat Compsace</h2>

                    <form action="" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="message">
                                Nama Tim
                            </label>
                            <input type="text" name="namaTim" id="namaTim"
                                class="px-3 py-2 w-full rounded-lg border focus:outline-none focus:ring-2"
                                placeholder="Masukan nama tim" required>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="rolePosition">
                                Jumlah Maks Anggota
                            </label>
                            <select name="role_position" id="rolePosition"
                                class="px-3 py-2 w-full rounded-lg border focus:outline-none focus:ring-2" required>
                                <option class="text-gray-400" value="">Masukkan Jumlah Aggota</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>

                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="rolePosition">
                                Cabang Komepetisi
                            </label>
                            <select name="role_position" id="rolePosition"
                                class="px-3 py-2 w-full rounded-lg border focus:outline-none focus:ring-2" required>
                                <option value="">Select the role need</option>
                                <option value="ui/ux">UI/UX Designer</option>

                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="rolePosition">
                                Opsi Aggota
                            </label>
                            <select name="role_position" id="rolePosition"
                                class="px-3 py-2 w-full rounded-lg border focus:outline-none focus:ring-2" required>
                                <option value="">Select the role need</option>
                                <option value="ui/ux">UI/UX Designer</option>

                            </select>
                        </div>

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
        <p class="text-sm text-gray-600">Universitas Brawijaya</p>
        <h2 class="mt-1 text-xl font-bold md:text-2xl">4C National Competition</h2>

        <div class="flex flex-col gap-6 mt-6 md:flex-row md:mt-8 md:gap-8">
            <div class="w-full md:w-1/2">
                <h3 class="mb-3 text-lg font-semibold md:mb-4">Deskripsi Kompetisi</h3>
                <p class="mb-2 text-gray-700">
                    4C National Competition adalah kompetisi tingkat nasional yang diselenggarakan oleh Fakultas
                    Ilmu
                    Komputer,
                    Universitas Brawijaya (FILKOM UB) dalam rangkaian peringatan kegiatan Dies Natalis ke-13.
                    Kompetisi ini diperuntukkan bagi para mahasiswa Perguruan Tinggi diseluruh Indonesia yang ingin
                    mengasah kemampuan berpikir kritis, kolaborasi, kreativitas dan komunikasi.
                </p>
                <p class="text-sm text-gray-500">Source: Wikipedia</p>
            </div>

            <div class="w-full md:w-1/2">
                <a href="" download
                    class="flex justify-between items-center py-3 border-b cursor-pointer hover:text-blue-600">
                    <span class="font-semibold">Download Guidebook Umum</span>
                    <i class="text-gray-500 fas fa-chevron-right"></i>
                </a>

                <a href="" download
                    class="flex justify-between items-center py-3 border-b cursor-pointer hover:text-blue-600">
                    <span class="font-semibold">Download Guidebook Business Case</span>
                    <i class="text-gray-500 fas fa-chevron-right"></i>
                </a>

                <a href="" download
                    class="flex justify-between items-center py-3 border-b cursor-pointer hover:text-blue-600">
                    <span class="font-semibold">Download Guidebook Web Design</span>
                    <i class="text-gray-500 fas fa-chevron-right"></i>
                </a>

                <a href="" download
                    class="flex justify-between items-center py-3 border-b cursor-pointer hover:text-blue-600">
                    <span class="font-semibold">Download Guidebook Mobile Dev</span>
                    <i class="text-gray-500 fas fa-chevron-right"></i>
                </a>
            </div>

        </div>

        <div class="grid grid-cols-3 gap-2 mt-6 sm:flex sm:flex-wrap md:gap-4 md:mt-8">
            <div class="border rounded-md p-3 md:p-4 w-[110px] md:w-36 overflow-hidden">
                <h4 class="text-lg font-bold md:text-xl">20 Juta</h4>
                <p class="text-xs text-gray-600 md:text-sm">Total Hadiah</p>
            </div>
            <div class="border rounded-md p-3 md:p-4 w-[110px] md:w-36">
                <h4 class="text-lg font-bold md:text-xl">5 Cabang</h4>
                <p class="text-xs text-gray-600 md:text-sm">Jenis Kompetisi</p>
            </div>
            <div class="border rounded-md p-3 md:p-4 w-[110px] md:w-36">
                <h4 class="text-lg font-bold md:text-xl">150 Tim</h4>
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
