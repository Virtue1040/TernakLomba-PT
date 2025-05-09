<x-layouts.default footer=true>
    <x-slot name="script">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://unpkg.com/splitting/dist/splitting.min.js"></script>
        <link href="https://unpkg.com/splitting/dist/splitting.css" rel="stylesheet" />
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
        <script>
            window.addEventListener('load', () => {
                const screenHeight = window.innerHeight;
                document.getElementById('hero').style.minHeight = screenHeight + 'px';
            });
        </script>
    </x-slot>

    <style>
        .fade-text .char {
            display: inline-block;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.2s forwards;
        }

        /* Apply different delays using Splitting's --char-index variable */
        .fade-text .char {
            animation-delay: calc((var(--char-index) * 0.02s) + 500ms);
        }

        /* Optional: Vary animation duration or direction */
        .fade-text .char:nth-child(odd) {
            animation-name: fadeLeft;
        }

        .fade-text .char:nth-child(even) {
            animation-name: fadeRight;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Initial transform to set direction */
        .fade-text .char:nth-child(odd) {
            transform: translateX(-20px);
        }

        .fade-text .char:nth-child(even) {
            transform: translateX(20px);
        }
    </style>

    <section id="hero" class="text-center px-6 relative bg-gradient-to-b from-[#822bf2] to-[#b378ff] min-h-screen">
        <x-navbar />

        <div class="flex absolute right-0 bottom-0 left-0 justify-center">
            <img class="w-auto h-[600px]" src="images/lightning-lights.png" alt="">
        </div>


        <div class="absolute top-1/2 left-1/2 w-full text-center -translate-x-1/2 -translate-y-1/2">
            <h1 data-splitting data-aos="zoom-in" data-aos-delay="500"
                class="splitting fade-text font-bold leading-[110%] lg:leading-[110%] text-2xl sm:text-3xl md:text-4xl lg:text-[54px]  tracking-[-0.03em] text-center text-white">
                {!! __('landingPage.welcome') !!}</h1>
            <p
                class="mt-2 sm:mt-3 md:mt-4 text-sm sm:text-base md:text-lg max-w-[300px] sm:max-w-[400px] md:max-w-[577px] mx-auto text-white">
                {!! __('landingPage.subWelcome') !!}</p>
            <a href="#"
                class="mt-6 mr-1 inline-block bg-[#ed8f23] text-white w-[120px] sm:w-[131px] h-[40px] sm:h-[44px] text-center leading-[44px] rounded-full font-semibold">Ikuti
                Kami</a>
            <a href="#"
                class="mt-6 inline-block bg-white text-[#ed8f23] w-[160px] sm:w-[180px] h-[40px] sm:h-[44px] text-center leading-[44px] rounded-full font-semibold">Daftarkan
                Lomba</a>
        </div>

        <div data-aos="zoom-in" data-aos-delay="500" data-aos-anchor=".splitting" class="absolute inset-x-0 bottom-10 flex justify-center text-white">
            <div data-aos="slide-up" data-aos-delay="500" data-aos-anchor=".splitting"
                class="flex w-full max-w-[90%] sm:max-w-xl md:max-w-2xl lg:max-w-4xl px-6 justify-center gap-6 md:gap-12">

                <div class="text-left">
                    <p class="font-bold text-xl sm:text-2xl md:text-3xl lg:text-[45.62px]">82,8%</p>
                    <p class="text-xs sm:text-sm md:text-[13.31px]">Tingkat Kemenangan</p>
                </div>

                <div class="text-left">
                    <p class="font-bold text-xl sm:text-2xl md:text-3xl lg:text-[45.62px]">05+</p>
                    <p class="text-xs sm:text-sm md:text-[13.31px]">Kategori Kompetisi</p>
                </div>

                <div class="text-left">
                    <p class="font-bold text-xl sm:text-2xl md:text-3xl lg:text-[45.62px]">170+</p>
                    <p class="text-xs sm:text-sm md:text-[13.31px]">Trofi Regional dan Internasional</p>
                </div>

            </div>
        </div>

        <div class="hidden absolute bottom-0 left-0 md:block">
            <img class="h-auto max-h-[150px] sm:max-h-[470px] md:max-h-[550px] lg:max-h-[693px]"
                src="images/image-left.png" alt="">
        </div>
        <div class="hidden absolute right-0 bottom-0 md:block">
            <img class="h-auto max-h-[150px] sm:max-h-[470px] md:max-h-[550px] lg:max-h-[693px]"
                src="images/image-right.png" alt="">
        </div>
    </section>

    <section id="tentang-kami" class="flex flex-col px-6 py-10 min-h-screen lg:px-10 lg:py-16">
        <h2 class="pb-10 font-semibold lg:pb-20">
            <span class="text-[#ED8F23] text-[30px] lg:text-[45px]">|</span>
            <span class="text-[#7C32DE] text-[36px] lg:text-[54px]">Tentang</span>
            <span class="text-black text-[36px] lg:text-[54px]">Kami</span>
        </h2>

        <div class="flex flex-col gap-8 justify-center items-center lg:flex-row lg:items-stretch">
            <div data-aos="fade" data-aos-duration="1000" class="w-full max-w-[650px] mb-0 lg:w-1/2 relative h-fit">
                <div
                    class="bg-[#ED8F23] rounded-[16px] h-[230px] sm:h-[280px] lg:h-[330px] w-full relative mt-16 sm:mt-32 lg:mt-24">
                    <img src="images/tentang-kami.png" alt="Tentang Kami"
                        class="absolute bottom-0 left-0 right-0 mx-auto w-full h-auto object-contain max-h-none max-w-[100%]">
                </div>
            </div>

            <div data-aos="fade" data-aos-duration="1000" class="w-full max-w-[650px] lg:w-1/2">
                <div
                    class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white p-6 sm:p-8 lg:p-10 rounded-[24px] h-full flex flex-col justify-center">
                    <h2 class="text-[28px] sm:text-[36px] md:text-[40px] lg:text-[44px] font-bold">Latar Belakang dan
                        Tujuan</h2>
                    <p class="mt-4 text-[16px] sm:text-[20px] lg:text-[24px]">
                        Ternak Lomba adalah startup di bidang pendidikan yang membantu para mahasiswa menyediakan ladang
                        lomba untuk berkompetisi dan ruang untuk penyelenggara lomba untuk mendaftarkan lombanya pada
                        database kami.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <x-sections.bidangLomba-section />

    <section id="testimoni" class="py-10">
        <h1 class="text-[36px] lg:text-[54px] font-bold text-center py-10"><span>Testimoni </span> <span
                class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-transparent bg-clip-text">Mahasiswa</span></h1>

        <div class="overflow-hidden w-full">
            <div data-aos="fade" data-aos-duration="1000" class="w-full swiper">
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
        <h2 class="text-[36px] lg:text-[54px] font-semibold">Cari Lomba</h2>

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
            <x-cards.lomba-card title="4C National Competition" university="Stanford University" />
            <x-cards.lomba-card title="4C National Competition" university="Stanford University" />
        </div>

        <div class="flex justify-center py-10">
            <button class="text-[16px] border border-[#E7E7E7] px-4 py-2 rounded-full">Explore Lebih banyak</button>
        </div>
    </section>
    <script>
        Splitting()
    </script>
</x-layouts.default>
