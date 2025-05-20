@props(['title', 'university','status' => "selesai", "gambar" => null])

<div data-aos="fade" data-aos-duration="1000" class="w-[303px] min-w-[303px] h-fit rounded-lg border border-[#E7E7E7] overflow-hidden">
    <img src="{{ asset("documents/lomba/$gambar/preview_foto_kompetisi.png") }}" alt="Preview foto kompetisi"
        class="w-[303px] min-w-[303px] h-[154px] object-cover">
    
    <div class="p-4">
        <h2 class="text-[16px] font-bold leading-tight">{{ $title }}</h2>
        <p class="text-gray-500 text-[12px]">{{ $university }}</p>
        <div class="flex gap-2 mt-3">
            <span class="bg-[#F3F3F3] text-gray-700 px-3 py-1 text-xs rounded-full">10 Days Left</span>
            <span class="bg-[#F3F3F3] text-gray-700 px-3 py-1 text-xs rounded-full">Offline</span>
            <span class="bg-[#F3F3F3] text-gray-700 px-3 py-1 text-xs rounded-full">Mahasiswa</span>
        </div>
        <div class="flex gap-2 mt-3">
            @if($status == "belum")
                <button
                onclick="window.location.href = '{{ route('lomba-detail', $gambar) }}'"
                class="px-5 py-2 bg-black text-white text-[12px] rounded-full">Lihat Detail</button>
                <button onclick="approve({{ $gambar }})" class="p-2 bg-[#1CED9A] rounded-full">
                    <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.00072 10.172L16.1927 0.979004L17.6077 2.393L7.00072 13L0.636719 6.636L2.05072 5.222L7.00072 10.172Z" fill="white"/>
                    </svg>
                </button>
                <button onclick="reject({{ $gambar }})" class="p-2 bg-transparent border border-[#FF1326] rounded-full">
                    <svg width="15" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.00078 8.40005L2.10078 13.3C1.91745 13.4834 1.68411 13.575 1.40078 13.575C1.11745 13.575 0.884114 13.4834 0.700781 13.3C0.517448 13.1167 0.425781 12.8834 0.425781 12.6C0.425781 12.3167 0.517448 12.0834 0.700781 11.9L5.60078 7.00005L0.700781 2.10005C0.517448 1.91672 0.425781 1.68338 0.425781 1.40005C0.425781 1.11672 0.517448 0.883382 0.700781 0.700048C0.884114 0.516715 1.11745 0.425049 1.40078 0.425049C1.68411 0.425049 1.91745 0.516715 2.10078 0.700048L7.00078 5.60005L11.9008 0.700048C12.0841 0.516715 12.3174 0.425049 12.6008 0.425049C12.8841 0.425049 13.1174 0.516715 13.3008 0.700048C13.4841 0.883382 13.5758 1.11672 13.5758 1.40005C13.5758 1.68338 13.4841 1.91672 13.3008 2.10005L8.40078 7.00005L13.3008 11.9C13.4841 12.0834 13.5758 12.3167 13.5758 12.6C13.5758 12.8834 13.4841 13.1167 13.3008 13.3C13.1174 13.4834 12.8841 13.575 12.6008 13.575C12.3174 13.575 12.0841 13.4834 11.9008 13.3L7.00078 8.40005Z" fill="#FF1326"/>
                    </svg>                    
                </button>
            @elseif($status == "berlangsung")
                <button class="px-5 py-2 bg-black text-white text-[12px] rounded-full">Lihat Compspace Terdaftar</button>
            @elseif($status == "selesai")
                <button class="px-5 py-2 bg-black text-white text-[12px] rounded-full">Tandai Selesai</button>
            @endif
        </div>
    </div>
</div>