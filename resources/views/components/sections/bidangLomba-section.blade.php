<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bidang Lomba</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section id="bidang-lomba" class="flex flex-col min-h-screen w-full">
        <div class="py-4 sm:py-6 md:py-8 text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold">
                <span class="text-black">Bidang</span>
                <span class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-transparent bg-clip-text">Lomba</span>
            </h2>
            <p class="max-w-[609px] mx-auto text-[#777E90] text-base sm:text-lg md:text-xl px-4 pt-2 sm:pt-4">
                Semua lomba dari mulai lomba akademik sampai non-akademik bisa kamu pelajari disini
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 p-4 md:hidden">
            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#02B2C5] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-xl sm:text-2xl font-bold leading-none">Business Plan <br> Competition</h3>
                </div>
                <img src="images/business.png" alt="Business" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#D8FCC1] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-black">
                    <h3 class="text-xl sm:text-2xl font-bold leading-none">Stock Market <br> Competition</h3>
                </div>
                <img src="images/stock-market.png" alt="Stock Market" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#FF694B] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-xl sm:text-2xl font-bold leading-none">Business Case <br> Competition</h3>
                </div>
                <img src="images/business-case.png" alt="Business Case" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#FFF1BF] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-black">
                    <h3 class="text-xl sm:text-2xl font-bold leading-none">Debate <br> Competition</h3>
                </div>
                <img src="images/debate.png" alt="Debate" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#8D51FF] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-xl sm:text-2xl font-bold leading-none">Hackathon <br> Competition</h3>
                </div>
                <img src="images/Hackathon.png" alt="Hackathon" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-gradient-to-b from-[#1548D1] to-[#1E9AFA] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-xl sm:text-2xl font-bold leading-none">UI/UX Design <br> Competition</h3>
                </div>
                <img src="images/UIUX.png" alt="UI/UX" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-gradient-to-t from-[#3ACC00] to-[#498432] flex flex-col justify-between h-48 relative p-4 overflow-hidden">
                <div class="z-10 space-y-2 text-white">
                    <p
                        class="bg-white bg-opacity-15 backdrop-blur-md w-24 h-8 rounded-full flex items-center justify-center text-white text-sm">
                        Stay tuned</p>
                    <h3 class="text-xl sm:text-2xl font-bold leading-tight">Masih ada 10 <br> Kompetisi yang akan <br>
                        datang!</h3>
                </div>
                <img src="images/juara2.png" alt="Coming Soon" class="absolute bottom-0 right-0 w-auto h-32">
            </div>
        </div>

        {{-- tablet --}}
        <div class="hidden md:grid lg:hidden grid-cols-2 gap-4 p-4 sm:p-6">
            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#02B2C5] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-2xl font-bold leading-none">Business Plan <br> Competition</h3>
                </div>
                <img src="images/business.png" alt="Business" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#FF694B] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-2xl font-bold leading-none">Business Case <br> Competition</h3>
                </div>
                <img src="images/business-case.png" alt="Business Case" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#D8FCC1] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-black">
                    <h3 class="text-2xl font-bold leading-none">Stock Market <br> Competition</h3>
                </div>
                <img src="images/stock-market.png" alt="Stock Market" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#FFF1BF] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-black">
                    <h3 class="text-2xl font-bold leading-none">Debate <br> Competition</h3>
                </div>
                <img src="images/debate.png" alt="Debate" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#8D51FF] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-2xl font-bold leading-none">Hackathon <br> Competition</h3>
                </div>
                <img src="images/Hackathon.png" alt="Hackathon" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-gradient-to-b from-[#1548D1] to-[#1E9AFA] flex flex-col justify-start items-start h-48 relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-2xl font-bold leading-none">UI/UX Design <br> Competition</h3>
                </div>
                <img src="images/UIUX.png" alt="UI/UX" class="absolute bottom-0 right-0 w-auto h-32">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-gradient-to-t from-[#3ACC00] to-[#498432] col-span-2 flex flex-col justify-between h-48 relative p-4 overflow-hidden">
                <div class="z-10 space-y-2 text-white">
                    <p
                        class="bg-white bg-opacity-15 backdrop-blur-md w-28 h-8 rounded-full flex items-center justify-center text-white text-sm">
                        Stay tuned</p>
                    <h3 class="text-2xl font-bold leading-tight">Masih ada 10 <br> Kompetisi yang akan datang!</h3>
                </div>
                <img src="images/juara2.png" alt="Coming Soon" class="absolute bottom-0 right-0 w-auto h-32">
            </div>
        </div>

        {{-- mobile --}}
        <div class="hidden lg:grid grid-cols-4 grid-rows-2 gap-4 p-6 lg:p-10 flex-grow">
            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#02B2C5] flex flex-col justify-start items-start h-full relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-xl xl:text-2xl font-bold leading-none">Business Plan <br> Competition</h3>
                </div>
                <img src="images/business.png" alt="Business"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-40">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#D8FCC1] col-start-1 row-start-2 flex flex-col justify-start items-start h-full relative p-4 overflow-hidden">
                <div class="z-10 text-black">
                    <h3 class="text-xl xl:text-2xl font-bold leading-none">Stock Market <br> Competition</h3>
                </div>
                <img src="images/stock-market.png" alt="Stock Market"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-40">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#FF694B] col-start-2 row-start-1 flex flex-col justify-start items-start h-full relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-xl xl:text-2xl font-bold leading-none">Business Case <br> Competition</h3>
                </div>
                <img src="images/business-case.png" alt="Business Case"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-40">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#FFF1BF] col-start-2 row-start-2 flex flex-col justify-start items-start h-full relative p-4 overflow-hidden">
                <div class="z-10 text-black">
                    <h3 class="text-xl xl:text-2xl font-bold leading-none">Debate <br> Competition</h3>
                </div>
                <img src="images/debate.png" alt="Debate"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-40">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-[#8D51FF] col-start-3 row-start-1 flex flex-col justify-start items-start h-full relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-xl xl:text-2xl font-bold leading-none">Hackathon <br> Competition</h3>
                </div>
                <img src="images/Hackathon.png" alt="Hackathon"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-40">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-gradient-to-b from-[#1548D1] to-[#1E9AFA] col-start-3 row-start-2 flex flex-col justify-start items-start h-full relative p-4 overflow-hidden">
                <div class="z-10 text-white">
                    <h3 class="text-xl xl:text-2xl font-bold leading-none">UI/UX Design <br> Competition</h3>
                </div>
                <img src="images/UIUX.png" alt="UI/UX"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-auto h-40">
            </div>

            <div data-aos="fade" data-aos-duration="1000"
                class="rounded-[17px] bg-gradient-to-t from-[#3ACC00] to-[#498432] row-span-2 col-start-4 row-start-1 flex flex-col justify-between h-full relative p-6 overflow-hidden">
                <div class="z-10 space-y-2 text-white">
                    <p
                        class="bg-white bg-opacity-15 backdrop-blur-md w-28 h-8 rounded-full flex items-center justify-center text-white text-sm">
                        Stay tuned</p>
                    <h3 class="text-2xl xl:text-3xl font-bold leading-tight">Masih ada 10 <br> Kompetisi yang akan <br>
                        datang!</h3>
                </div>
                <img src="images/juara2.png" alt="Coming Soon"
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-full">
            </div>
        </div>
    </section>
