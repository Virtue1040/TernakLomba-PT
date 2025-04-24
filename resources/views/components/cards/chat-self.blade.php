<div class="flex justify-end w-full">
    <div class="flex flex-col gap-2 w-auto max-w-[45%]">
        <div class="h-[18px] w-full flex justify-between">
            <div class="flex gap-[6px]">
                <x-svg.read width=16 height=16 :active=false />
                <a class="text-[10px] text-[#8D8D8D]">13:00 PM</a>
            </div>
            <div class="flex gap-[6px]">
                <a class="text-black text-[11px]">Rafi Hidayat</a>
                <div class="flex justify-center items-center rounded-full w-[16px] h-[16px] bg-white overflow-hidden">
                    <img class="" id="username_image"
                        onerror="let getFirst = $(this).attr('name'); $(this).parent().find('p').text(getFirst.charAt(0)); $(this).css('display', 'none')"
                        alt="Profile Image" name="Tim Kocak Abis"
                        src="https://lh3.googleusercontent.com/a/ACg8ocIQCtG3ch_RzIDd1_vy6LdLNrt8_7TNtjtOBKqMvUIzNFhDm9g=s96-c"
                        style="display: block;">
                        <p class="text-black"></p>
                </div>
            </div>
        </div>
        <div class="bg-[#F6F5F5] w-full h-auto rounded-[8.35px] rounded-tr-none py-2 px-[10px]">
            <a class="text-[12px]">Hi everyone! I hope you're all doing well. I wanted to discuss our upcoming marketing campaign. Any thoughts on how we can make it more effective?</a>
        </div>
    </div>
</div>
