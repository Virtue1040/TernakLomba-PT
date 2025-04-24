@props(["description", "name", "title", "imagePath"])

<div class="swiper-slide w-[730.2296752929688px] flex items-center justify-center gap-x-6 h-[498px] overflow-hidden">
    <img class="absolute bottom-0  right-[-70px] w-[238px] h-auto" src="images/petik.png" alt="">
    <div class="w-1/3 h-[498px]">
        <img class="rounded-[12px] w-full h-[498px] object-cover" src="{{ $imagePath }}" alt="Testimonial">
    </div>
    <div class="desc bg-gray text-white rounded-[16px] w-2/3 h-[498px] shadow-lg flex flex-col justify-center p-6">
        <p class="flex flex-col justify-between h-full">
            {{ $description }}
        </p>
        <h3 class="mt-4 text-xl font-bold">{{ $name }}</h3>
        <p class="text-sm opacity-80">{{ $title }}</p>
    </div>
</div>
