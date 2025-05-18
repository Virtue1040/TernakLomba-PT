@props(["judul", "bidang", "juaraKe"])
<div class="bg-[#822BF2] p-[20px] rounded-[16px] w-[286px] max-w-[286px] min-w-[286px] max-h-[222px] h-auto flex-col justify-between gap-[23px] flex hidden" id="prestasi-card_sample">
    <div class="gap-[12px] w-full h-auto min-h-[84px] flex flex-col justify-between">
        <div class="flex flex-col">
            <p class="font-[700] text-[20px] text-white" name="judul">{{ $judul }}</p>
            <a class="text-[16px] text-white" name="bidang">{{ $bidang }}</a>
        </div>
        <div>
            <a class="text-white text-[14px]" name="juaraKe">{{ $juaraKe }}</a>
        </div>
    </div>
    <div class="flex flex-row gap-3 h-auto" name="button_action">
        <button name="hapus_prestasi" class="p-[10px] pt-3 bg-white rounded-xl text-[#822BF2] text-[14px] font-[700] h-auto max-h-[46px]">
            Hapus Prestasi
        </button>
        <button name="edit_prestasi" class="p-[10px] pt-3 bg-transparent border-[1px] border-white rounded-xl text-white text-[14px] font-[700] h-auto max-h-[46px]">
            Edit Prestasi
        </button>
    </div>
</div>