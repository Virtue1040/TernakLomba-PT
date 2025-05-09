<x-guest-layout>
    <x-slot name="left_side">
        <form action="{{ route("auth-register") }}" method="POST" class="flex flex-col gap-6 w-full lg:gap-8">
            <div class="flex flex-col gap-5 lg:gap-7">
                <div class="flex flex-col gap-1">
                    <h1 class="text-3xl sm:text-4xl xl:text-[48px] font-bold font-cabinet">Daftar</h1>
                    <p class="text-sm sm:text-base xl:text-[16px] text-[#695959]">Enter your email and password to find matches.</p>
                </div>
                <div class="flex flex-col gap-4 lg:gap-5">
                    <x-input name="username" label="Username" placeholder="Enter your name" type="text"/>
                    <x-input name="email" label="E-mail" placeholder="Enter your e-mail" type="email"/>
                    <x-input name="password" label="Password" placeholder="Enter your password" type="password" tip="Password must be at least 8 characters"/>
                    <x-input name="password_confirmation" label="Konfirmasi Password" placeholder="Enter your password" type="password" tip="Password must be at least 8 characters"/>
                </div>
            </div>
            <div class="flex flex-col gap-6 justify-between lg:gap-8">
                <div class="flex flex-col gap-2 lg:gap-3">
                    <button class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] rounded-full w-full px-4 sm:px-6 xl:px-[39px] py-4 xl:py-[24px] text-base sm:text-lg xl:text-xl text-[#FFF7E6] h-auto xl:h-[72px]">
                        Daftar Sekarang
                    </button>
                    <p class="text-[#695959] text-center text-xs sm:text-sm xl:text-[16px]">Dengan mendaftar, anda menyetujui <b>Syarat Penggunaan</b> dan <b>Kebijakan Privasi</b> kami.</p>
                </div>
                <p class="text-sm sm:text-base xl:text-[18px] text-center">Lupa password? <a href="{{  route("forgot-password") }}" class="font-bold  text-[#822BF2]">Klik disini</a></p>   
            </div>
        </form>
    </x-slot>
</x-guest-layout>