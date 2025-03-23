@props(['title','prize','benefit','wajibTim'])

<div class="border rounded-lg p-3 md:p-4 w-full sm:w-[220px] md:w-64">
    <div class="flex items-center space-x-1 text-xs md:text-sm mb-2 text-[#57BFC7]">
        <div class="flex items-center space-x-1 px-2 py-1 bg-[#57BFC71A] rounded-lg">
            <i class="fas fa-trophy"></i>
            <span class="">{{ $benefit }}</span>
        </div>
        <span class="space-x-1 px-2 py-1 bg-[#57BFC71A] rounded-lg">{{ $wajibTim }}</span>
    </div>
    <h4 class="text-base font-semibold md:text-lg">{{ $title }}</h4>
    <p class="mt-2 text-purple-600">Rp. {{ $prize }}</p>
</div>