<x-layouts.default footer=false>
    <x-setup-topbar/>
    <div class="flex justify-center items-center w-[70%] mx-auto">
        <div x-data="{ step: 1, stepMax: 7 }" class="flex flex-col gap-[58px] p-8 w-full max-w-[1107px] mt-8 items-center">
            <x-cards.step>
                <x-cards.step-bullet title="Informasi Pribadi" order=1 :active=false/>
                <x-cards.step-bullet title="Akademik" order=2 :active=false/>
                <x-cards.step-bullet title="Keamanan Akun" order=3 :active=false/>  
                <x-cards.step-bullet title="Linga" order=4 :active=false/>  
                <x-cards.step-bullet title="Guli" order=5 :active=false/>  
                <x-cards.step-bullet title="Guli" order=6 :active=false/>  
                <x-cards.step-bullet title="Waca" order=7 :active=false/>  
            </x-cards.step>
            <div class="flex flex-col gap-[6px]">
                <h2 class="text-[40px] font-bold text-center">Tolong Lengkapi Data Formulir ini</h2>
                <p class="text-center text-[20px] text-gray-500">Please take a few minutes to fill in your profile so we can customize
                    the
                    opportunities for you.</p>
            </div>
            <form @submit.prevent="step === stepMax + 1 && $el.submit()" class="flex flex-col gap-[42px] w-full">
                <div x-show="step === 1" class="flex flex-col gap-[42px]" name="about_you">
                    <h2 class="my-4 text-[24px] font-[700]">About You</h2>
                    <div class="flex gap-[44px]">
                        <div class="flex flex-col gap-[36px] w-full">
                            <x-input :required=true name="full_name" label="Full Name" type="text" placeholder="Enter your full name"/>
                            <x-input :required=true name="birth_date" label="Born Date" type="date" placeholder="MM/DD/YYYY"/>
                            <x-select :required=true name="kampus" label="Kampus" placeholder="Enter your Campuss">
                                <option selected>Telkom University</option>
                            </x-select>
                        </div>
                        <div class="flex flex-col gap-[36px] w-full">
                            <x-select :required=true name="kelas" label="Kelas" placeholder="Enter your full name">
                                <option>2025</option>
                            </x-select>
                            <x-input :required=true name="birth_place" label="Tempat Lahir" type="date" placeholder="Enter state"/>
                            <x-input :required=true name="instagram" label="Instagram" type="text" placeholder="Enter your instagram username"/>
                        </div>
                    </div>
                </div>
                <div x-show="step === 2" class="flex flex-col gap-[42px]" name="akademik">
                    <div class="flex gap-[44px]">
                        <x-select :required=true name="jurusan" label="Jurusan" placeholder="Choose your jurusan">
                            <option selected>Rekayasa Perangkat Lunak Aplikasi</option>
                        </x-select>
                    </div>
                </div>
                <div x-show="step >= 3 " class="flex flex-col gap-[42px] h-full" name="keamanan_akun">
                    <div class="flex gap-[30px] h-fit w-[1107px]">
                        <div class="flex flex-col gap-[20px] w-full border-r-[1px] border-r-[#C6C6C6]">
                           <x-detail label="Nama" text="Budi Setiawan"/>
                           <x-detail label="Kelas" text="Kelas 10"/>
                           <x-detail label="Kampus" text="Telkom University"/>
                           <x-detail label="No Telepon" text="081212961313"/>
                           <x-detail label="Email" text="budi@gmail.com"/>
                        </div>  
                        <div class="flex flex-col gap-[20px] w-full">
                            <x-detail label="Jurusan" text="Ilmu Pengetahuan Alam (IPA)"/>
                            <x-detail label="Bidang yang Diminati" text="Business Case, Business Plan, Hackathon UI/UIX"/>
                            <x-detail label="Referral Code (Opsional)" text="-"/>
                        </div>  
                    </div>
                </div>
                <div class="flex gap-[28px] justify-end">
                    <button x-show="step > 1" @click="step > 1 ? step-- : ''" class="w-[144px] text-[20px] border-[1px] border-[#C6C6C6] h-[68px] text-black rounded-[10px] transition duration-300">Kembali
                    </button>
                    <button x-text="step >= stepMax ? 'Konfirmasi' : 'Selanjutnya'" @click="step < stepMax + 1 ? step++ : ''" class="w-[180px] text-[20px] font-manrope py-[22px] px-[39px] bg-gradient-to-b from-[#822bf2] to-[#b378ff] border-none h-[68px] text-white rounded-[10px] hover:bg-purple-700 transition duration-300">Selanjutnya
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.default>