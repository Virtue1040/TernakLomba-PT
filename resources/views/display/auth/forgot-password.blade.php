{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex justify-end items-center mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<x-layouts.default footer=false>
    <div class="flex justify-center items-center w-screen h-screen">
        <div class="w-[847px] pr-[42px] pt-[42px] pb-[47px] pl-[42px] flex justify-center items-center">

            <form class="w-[606px] h-[505px] flex gap-2 flex-col">
                <h1 class="text-3xl sm:text-4xl xl:text-[48px] font-bold font-cabinet">Lupa Password</h1>
                <p class="text-sm sm:text-base xl:text-[16px] text-[#695959] text-wrap">Tenang, kami akan bantu. Masukan
                    email Anda dan kami akan kirimkan tautan untuk mengatur ulang kata sandi Anda.</p>
                <div class="flex flex-col gap-4 lg:gap-5 mt-[20px]">
                    <x-input name="username" label="E-mail" placeholder="Enter your e-mail" type="email" />
                </div>
                <button id="submit"
                    class="mt-[32px] bg-gradient-to-b from-[#822bf2] to-[#b378ff] rounded-full w-full px-4 sm:px-6 xl:px-[39px] py-4 xl:py-[24px] text-base sm:text-lg xl:text-xl text-[#FFF7E6] h-auto xl:h-[72px]">
                    Kirim Tautan Reset 
                </button>
            </form>

        </div>
    </div>
</x-layouts.default>
 