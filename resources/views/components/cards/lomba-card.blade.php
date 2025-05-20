@props(['title', 'university', 'startDate' => null, 'endDate' => null,'gambar' => null])

@php
use Carbon\Carbon;

$now = Carbon::now();
$start = $startDate ? Carbon::parse($startDate) : null;
$end = $endDate ? Carbon::parse($endDate) : null;

if ($start && $end) {
    if ($now->lt($start)) {
        $progres = "belum";
        $diffSeconds = $start->floatDiffInSeconds($now, false);
        $daysLeft = $diffSeconds / (60 * 60 * 24); //desimal
    } elseif ($now->between($start, $end)) {
        $progres = "berlangsung";
        $daysLeft = null;
    } else {
        $progres = "selesai";
        $daysLeft = null;
    }
} else {
    $progres = "unknown";
    $daysLeft = null;
}
@endphp

<div data-aos="fade" data-aos-duration="1000" class="w-[303px] relative min-w-[303px] h-[271px] rounded-lg border border-[#E7E7E7] overflow-hidden">
    <img src="{{ asset("documents/lomba/{$gambar}/poster_kompetisi.png") }}" alt="poster kompetisi" class="w-[303px] min-w-[303px] h-[154px] object-cover">
    
    @if($progres == "berlangsung")
        <p class="absolute top-2 left-2 bg-white px-2 py-1 font-bold rounded-lg text-[#822BF2] text-[12px]">Sedang berlangsung</p>
    @elseif($progres == "belum")
        <p class="absolute top-2 left-2 bg-white px-2 py-1 font-bold rounded-lg text-[#1548D1] text-[12px]">Belum dimulai</p>
    @elseif($progres == "selesai")
        <p class="absolute top-2 left-2 bg-white px-2 py-1 font-bold rounded-lg text-[#02886B] text-[12px]">Telah selesai</p>
    @else
        <p class="absolute top-2 left-2 bg-white px-2 py-1 font-bold rounded-lg text-gray-500 text-[12px]">Status tidak diketahui</p>
    @endif

    <div class="p-4">
        <h2 class="text-[16px] font-bold leading-tight">{{ $title }}</h2>
        <p class="text-gray-500 text-[12px]">{{ $university }}</p>
        <div class="flex gap-2 mt-3">
            @if($progres === "belum" && $daysLeft !== null)
                <span class="bg-[#F3F3F3] text-gray-700 px-3 py-1 text-xs rounded-full">
                    {{ number_format($daysLeft, 2) }} Hari lagi
                </span>
            @elseif ($progres === "berlangsung")
            <span class="bg-[#F3F3F3] text-gray-700 px-3 py-1 text-xs rounded-full whitespace-nowrap">
                berlangsung
            </span>
            @endif
            <span class="bg-[#F3F3F3] text-gray-700 px-3 py-1 text-xs rounded-full">Offline</span>
            <span class="bg-[#F3F3F3] text-gray-700 px-3 py-1 text-xs rounded-full">Mahasiswa</span>
        </div>
    </div>
</div>
