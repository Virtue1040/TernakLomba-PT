<nav class="flex relative z-50 justify-between items-center p-6 px-12 mx-auto text-white">
    <div class="flex gap-2 items-center text-2xl font-bold">
        <img class="w-[27px] h-[24px]" src="images/logo.png" alt="">
    </div>

    <div x-data="{ open: false }" class="lg:hidden">
        <button @click="open = !open" class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <div x-show="open" x-transition
            class="fixed top-16 left-0 w-full h-fit bg-[#822bf2] text-white px-8 py-3 z-[9999] space-y-6"
            @click.away="open = false">
            <ul class="flex flex-col space-y-6 text-lg">
                <li><a  @click="open = !open" href="#" class="hover:underline">Home</a></li>
                <li><a  @click="open = !open" href="#tentang-kami" class="hover:underline">Tentang Kami</a></li>
                <li><a  @click="open = !open" href="#bidang-lomba" class="hover:underline">Bidang Lomba</a></li>
                <li><a  @click="open = !open" href="#testimoni" class="hover:underline">Testimoni</a></li>
            </ul>
            @guest
                <a href="{{ route('login') }}"
                    class="bg-white px-4 py-2 rounded-full text-[#822bf2] font-semibold inline-block">Masuk Sekarang</a>
            @else
                <a href="{{ route('login') }}" class="inline-block font-semibold">Dashboard</a>
            @endguest
        </div>
    </div>

    <ul class="hidden space-x-6 lg:flex">
        <li><a href="#" class="">Home</a></li>
        <li><a href="#tentang-kami" class="">Tentang Kami</a></li>
        <li><a href="#bidang-lomba" class="">Bidang Lomba</a></li>
        <li><a href="#testimoni" class="">Testimoni</a></li>
    </ul>

    <div class="hidden lg:block">
        @guest
            <a href="{{ route('login') }}" class="px-4 py-2 font-semibold text-[#822bf2] bg-white rounded-full">Masuk Sekarang</a>
        @else
            <a><img src="images/avatar.png" class="w-[27px] h-[27px] rounded-full" alt=""></a>
        @endguest
    </div>
</nav>
