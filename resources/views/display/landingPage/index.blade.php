<x-layouts.default footer=true>
    <x-slot name="script">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script>
            $(document).ready(function() {
                var swiper = new Swiper(".swiper", {
                    slidesPerView: "auto",
                    centeredSlides: true,
                    spaceBetween: 150,
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    effect: "coverflow",
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 0,
                        depth: 100,
                        modifier: 3,
                        slideShadows: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: "auto",
                            spaceBetween: 100,
                        },
                        1024: {
                            slidesPerView: "auto",
                            spaceBetween: 150,
                        }
                    },
                    on: {
                        init: function() {
                            updateSlideColors();
                        },
                        slideChangeTransitionEnd: function() {
                            updateSlideColors();
                        }
                    }
                });

                function updateSlideColors() {
                    document.querySelectorAll(".swiper-slide").forEach(slide => {
                        let descBox = slide.querySelector(".desc");
                        if (!descBox) return;

                        if (slide.classList.contains("swiper-slide-active")) {
                            descBox.classList.remove("bg-gray-400");
                            descBox.style.background = "linear-gradient(to bottom, #822bf2, #b378ff)";
                        } else {
                            descBox.style.background = "";
                            descBox.classList.add("bg-gray-400");
                        }
                    });
                }
            });
        </script>
    </x-slot>

    <section class="text-center px-6 relative bg-gradient-to-b from-[#822bf2] to-[#b378ff] h-screen">
        <x-navbar></x-navbar>

        <div class="flex absolute right-0 bottom-0 left-0 justify-center">
            <img class="w-auto h-[600px]" src="images/lightning-lights.png" alt="">
        </div>

        <div class="absolute top-1/2 left-1/2 w-full text-center -translate-x-1/2 -translate-y-1/2">
            <h1 class="font-bold text-[54px] leading-[110%] tracking-[-0.03em] text-center text-white">Temukan & Ikuti
                Lomba Terbaik Untuk <br> Menjadi Mahasiswa Berprestasi <br> Bersama Ternak Lomba</h1>
            <p class="mt-4 text-lg max-w-[577px] mx-auto text-white">Platform pendidikan online terdepan yang membantu
                siswa meraih kemenangan dalam berbagai kompetisi.</p>
            <a href="#"
                class="mt-6 inline-block bg-[#ed8f23] text-white w-[131px] h-[44px] text-center leading-[44px] rounded-full font-semibold">Ikuti
                Kami!</a>
        </div>

        <div class="flex absolute right-0 left-0 bottom-10 justify-center mt-10 space-x-12 text-white">
            <div class="text-left">
                <p class="font-bold text-[45.62px]">82,8%</p>
                <p class="text-[13.31px]">Tingkat Kemenangan</p>
            </div>
            <div class="text-left">
                <p class="font-bold text-[45.62px]">05+</p>
                <p class="text-[13.31px]">Kategori Kompetisi</p>
            </div>
            <div class="text-left">
                <p class="font-bold text-[45.62px]">170+</p>
                <p class="text-[13.31px]">Trofi Regional dan Internasional</p>
            </div>
        </div>

        <div class="absolute bottom-0 left-0">
            <img class="h-[693px]" src="images/image-left.png" alt="">
        </div>
        <div class="absolute right-0 bottom-0">
            <img class="h-[693px]" src="images/image-right.png" alt="">
        </div>
    </section>

    <section class="flex flex-col px-6 py-10 min-h-screen lg:px-10 lg:py-16">
        <h2 class="pb-10 font-semibold lg:pb-20">
            <span class="text-[#ED8F23] text-[30px] lg:text-[45px]">|</span>
            <span class="text-[#7C32DE] text-[36px] lg:text-[54px]">Tentang</span>
            <span class="text-black text-[36px] lg:text-[54px]">Kami</span>
        </h2>

        <div class="flex flex-col gap-3 justify-center items-end lg:flex-row lg:gap-8">
            <div
                class="rounded-[16px] bg-[#ED8F23] h-[200px] lg:h-[300px] w-[100%] lg:w-[900px] relative p-3">
                <img src="images/tentang-kami.png" alt="Tentang Kami"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-[80%] lg:w-[587px] h-auto">
            </div>

            <div
                    class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white p-6 rounded-[24px] w-fit lg:w-[695px] h-[300px] lg:h-[421px] flex flex-col justify-between">
                    <h2 class="text-[28px] lg:text-[44px] font-bold">Latar Belakang dan Tujuan</h2>
                    <p class="mt-4 text-[16px] lg:text-[24px]">
                        Ternak Lomba adalah startup di bidang pendidikan yang membantu para mahasiswa menyediakan ladang
                        lomba untuk berkompetisi dan ruang untuk penyelenggara lomba untuk mendaftarkan lombanya pada
                        database kami.
                    </p>
                </div>
        </div>
    </section>


    <section class="flex flex-col h-screen">
        <div class="py-4 text-center">
            <h2 class="text-[54px] font-bold">
                <span class="text-black">Bidang</span>
                <span class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-transparent bg-clip-text">Lomba</span>
            </h2>
            <p class="max-w-[609px] mx-auto text-[#777E90] text-[20px] pt-4">
                Semua lomba dari mulai lomba akademik sampai non-akademik bisa kamu pelajari disini
            </p>
        </div>

        <div class="grid flex-grow grid-cols-4 grid-rows-2 gap-4 p-10 px-20">
            <div
                class="rounded-[17.35px] bg-[#02B2C5] flex flex-col justify-start items-start h-full relative p-3 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-[24px] font-bold leading-none">Business Plan <br> Competition</h3>
                </div>

                <img src="images/business.png"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-[165px]">
            </div>

            <div
                class="rounded-[17.35px] bg-[#D8FCC1] col-start-1 row-start-2 flex flex-col justify-between h-full relative overflow-hidden p-4">
                <div class="z-10 text-black">
                    <h3 class="text-[24px] font-bold leading-none">Stock Market <br> Competition</h3>
                </div>
                <img src="images/stock-market.png"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-[165px]">
            </div>

            <div
                class="rounded-[17.35px] bg-[#FF694B] col-start-2 row-start-1 flex flex-col justify-between h-full relative overflow-hidden p-4">
                <div class="z-10 text-white">
                    <h3 class="text-[24px] font-bold leading-none">Business Case <br> Competition</h3>
                </div>
                <img src="images/business-case.png"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-[165px]">
            </div>

            <div
                class="rounded-[17.35px] bg-[#FFF1BF] col-start-2 row-start-2 flex flex-col justify-between h-full relative overflow-hidden p-4">
                <div class="z-10 text-black">
                    <h3 class="text-[24px] font-bold leading-none">Debate <br> Competition</h3>
                </div>
                <img src="images/debate.png"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-[165px]">
            </div>

            <div
                class="rounded-[17.35px] bg-[#8D51FF] col-start-3 row-start-1 flex flex-col justify-between h-full relative overflow-hidden p-4">
                <div class="z-10 text-white">
                    <h3 class="text-[24px] font-bold leading-none">Hackathon <br> Competition</h3>
                </div>
                <img src="images/hackathon.png"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-[165px]">
            </div>

            <div
                class="rounded-[17.35px] bg-gradient-to-b from-[#1548D1] to-[#1E9AFA] col-start-3 row-start-2 flex flex-col justify-between h-full relative overflow-hidden p-4">
                <div class="z-10 text-white">
                    <h3 class="text-[24px] font-bold leading-none">UI/UX Design <br> Competition </h3>
                </div>
                <img src="images/UIUX.png"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-[165px]">
            </div>

            <div
                class="rounded-[17.35px] bg-gradient-to-t from-[#3ACC00] to-[#498432] row-span-2 col-start-4 row-start-1 flex flex-col justify-between h-full relative overflow-hidden p-6">
                <div class="z-10 space-y-2 text-white">
                    <p
                        class="bg-white bg-opacity-15 backdrop-blur-md w-[111px] h-[38px] rounded-full flex items-center justify-center text-white text-[16px]">
                        Stay tuned</p>
                    <h3 class="text-[30px] font-bold leading-tight">Masih ada 10 <br> Kompetisi yang akan <br> datang!
                    </h3>
                </div>
                <img src="images/juara2.png"
                    class="absolute bottom-0 left-1/2 w-full h-auto transform -translate-x-1/2">
            </div>

        </div>
    </section>

    <section class="py-10 h-screen">
        <h1 class="text-[54px] font-bold text-center py-10"><span>Testimoni </span> <span
                class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-transparent bg-clip-text">Mahasiswa</span></h1>

        <div class="overflow-hidden w-full">
            <div class="w-full swiper">
                <div class="swiper-wrapper">
                    <x-cards.testimoni-card
                        description="Mulai belajar di komunitas yang suportif tapi juga kompetitif..."
                        name="Zuhdi Adibi" title="1st Place at FLES National Business"
                        imagePath="images/testimoni.png" />
                    <x-cards.testimoni-card
                        description="Mulai belajar di komunitas yang suportif tapi juga kompetitif..."
                        name="Zuhdi Adibi" title="1st Place at FLES National Business"
                        imagePath="images/testimoni.png" />
                    <x-cards.testimoni-card
                        description="Mulai belajar di komunitas yang suportif tapi juga kompetitif..."
                        name="Zuhdi Adibi" title="1st Place at FLES National Business"
                        imagePath="images/testimoni.png" />
                    <x-cards.testimoni-card
                        description="Mulai belajar di komunitas yang suportif tapi juga kompetitif..."
                        name="Zuhdi Adibi" title="1st Place at FLES National Business"
                        imagePath="images/testimoni.png" />
                    <x-cards.testimoni-card
                        description="Mulai belajar di komunitas yang suportif tapi juga kompetitif..."
                        name="Zuhdi Adibi" title="1st Place at FLES National Business"
                        imagePath="images/testimoni.png" />
                </div>

                <div class="mt-4 swiper-pagination"></div>
                <div class="swiper-button-next text-black bg-#F6F6F6 p-6 rounded-full"></div>
                <div class="swiper-button-prev text-black bg-#F6F6F6 p-6 rounded-full"></div>
            </div>
        </div>

    </section>

    <section class="p-10">
        <h2 class="text-[54px] font-semibold">Cari Lomba</h2>

        <div class="flex overflow-x-auto items-center py-10 space-x-3">
            <button class="flex items-center gap-2 bg-[#F0F0F0] px-4 py-2 rounded-full text-[15.75px]">
                <i class="fas fa-sliders"></i>
                Filters
            </button>
            <span class="text-[#F0F0F0]">|</span>
            <button class="px-4 py-2 border-[#F0F0F0] border rounded-full text-[15.75px]">All</button>
            <button class="px-4 py-2 border-[#F0F0F0] border rounded-full text-[15.75px]">Nasional</button>
            <button class="px-4 py-2 border-[#F0F0F0] border rounded-full text-[15.75px]">Internasional</button>
            <button class="px-4 py-2 border-[#F0F0F0] border rounded-full text-[15.75px]">Pemerintahan</button>
        </div>

        <div class="flex overflow-x-auto flex-row gap-4">
            <x-cards.lomba-card title="4C National Competition" university="Stanford University"/>
            <x-cards.lomba-card title="4C National Competition" university="Stanford University"/>
        </div>

        <div class="flex justify-center py-10">
            <button class="text-[16px] border border-[#E7E7E7] px-4 py-2 rounded-full">Explore Lebih banyak</button>
        </div>
    </section>
</x-layouts.default>
