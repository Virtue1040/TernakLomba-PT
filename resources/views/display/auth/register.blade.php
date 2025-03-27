<x-guest-layout>
    <x-slot name="left_side">
        <form action="{{ route("auth-register") }}" method="POST" class="flex flex-col gap-8 w-[606px]">
            <div class="flex flex-col gap-7">
                <div class="flex flex-col gap-1">
                    <a class="text-[48px] font-bold font-cabinet">Daftar</a>
                    <a class="text-[16px] text-[#695959]">Enter your email and password to find matches.</a>
                </div>
                <div class="flex flex-col gap-5">
                    <x-input name="username" label="Username" placeholder="Enter your name" type="text"/>
                    <x-input name="email" label="E-mail" placeholder="Enter your e-mail" type="email"/>
                    <x-input name="password" label="Password" placeholder="Enter your password" type="password" tip="Password must be at least 8 characters"/>
                    <x-input name="password_confirmation" label="Konfirmasi Password" placeholder="Enter your password" type="password" tip="Password must be at least 8 characters"/>
                </div>
            </div>
            <div class="flex flex-col gap-8 justify-between h-[197px]">
                <div class="flex flex-col gap-3">
                    <button class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] rounded-full w-full px-[39px] py-[24px] text-xl text-[#FFF7E6] h-[72px]">
                        Daftar Sekarang
                    </button>
                    <a class="text-[#695959] text-center text-[16px]">Dengan mendaftar, anda menyetujui <b>Syarat Penggunaan</b> dan <b>Kebijakan Privasi</b> kami.</a>
                </div>
                <a class="text-[18px] text-center">Lupa password? <span class="text-[#1543CE]">Klik disini</span></a>   
            </div>
        </form>
    </x-slot>
</x-guest-layout>