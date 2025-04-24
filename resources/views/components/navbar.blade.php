<nav class="flex justify-between items-center p-6 px-12 mx-auto text-white relative z-50">
    <div class="text-2xl font-bold">
        <img class="w-[27px] h-[24px]" src="images/logo.png" alt="">
    </div>
    <ul class="flex space-x-6">
        <li><a href="#" class="">Home</a></li>
        <li><a href="#tentang-kami" class="">Tentang Kami</a></li>
        <li><a href="#bidang-lomba" class="">Bidang Lomba</a></li>
        <li><a href="#testimoni" class="">Testimoni</a></li>
    </ul>
    @guest
        <a href="{{ route("login") }}" class="bg-white px-4 py-2 rounded-full text-[#1543CE] font-semibold">Masuk Sekarang</a>
    @else
        <a><img src="images/avatar.png" class="w-[27px] h-[27px] rounded-full" alt=""></a>
    @endguest
</nav>