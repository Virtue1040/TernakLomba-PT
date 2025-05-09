
<x-guest-layout>
    <x-slot name="script">
        <script>
            $(document).ready(function() {
                var submit = $("#submit")
                submit.on("click", function() {
                    username = $("input[name=username]").val()
                    password = $("input[name=password]").val()
                    // $.ajax({
                    //     url: "{{ route('auth-login') }}",
                    //     method: "POST",
                    //     data: {
                    //         username: username,
                    //         password: password
                    //     },
                    //     dataType: "json",
                    //     headers: {
                    //         'Accept': 'application/json'
                    //     },
                    //     success: function(data) {
                            
                    //     },
                    //     error: function(xr) {

                    //     }
                    // })
                })
            })
        </script>
    </x-slot>
    <x-slot name="left_side">
        <div class="flex justify-center items-center w-full h-full">
            <form action="{{ route("auth-login") }}" method="POST" class="flex flex-col gap-6 w-full lg:gap-8">
                <div class="flex flex-col gap-9">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-[48px] font-bold font-cabinet leading-tight xl:leading-[120%]">Jadilah yang terbaik bersama JagoLomba</h1>
                        <p class="text-sm sm:text-base xl:text-[16px] text-[#695959]">Enter your email and password to find matches.</p>
                    </div>
                    <div class="flex flex-col gap-4 lg:gap-5">
                        <x-input name="username" label="Username / E-mail" placeholder="Enter your username or email" type="text"/>
                        <x-input name="password" label="Password" placeholder="Enter your password" type="password"/>
                        <div class="flex justify-end">
                            <a href="{{  route("forgot-password") }}"  class="cursor-pointer text-[#822BF2]">Lupa Password</a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-6 justify-between lg:gap-8">
                    <div class="flex flex-col gap-3">
                        <button id="submit" class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] rounded-full w-full px-4 sm:px-6 xl:px-[39px] py-4 xl:py-[24px] text-base sm:text-lg xl:text-xl text-[#FFF7E6] h-auto xl:h-[72px]">
                            Masuk
                        </button>
                        <p class="text-[#695959] text-center text-xs sm:text-sm xl:text-[16px]">Dengan mendaftar, anda menyetujui <b>Syarat Penggunaan</b> dan <b>Kebijakan Privasi</b> kami.</p>
                    </div>
                    <p class="text-sm sm:text-base xl:text-[18px] text-center">Belum punya akun? <a href="{{ route("register") }}" class="cursor-pointer font-bold text-[#822BF2]">Daftar Disini</a></p>   
                </div>
            </form>
        </div>
    </x-slot>
</x-guest-layout>