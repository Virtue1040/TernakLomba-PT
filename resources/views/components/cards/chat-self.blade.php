<div class="flex hidden justify-end" id="chat-card_sample">
    <div class="flex flex-col gap-4 max-w-[550px] h-auto items-end">
        <div class="h-[18px] w-full flex justify-between gap-2">
            <div class="flex gap-[6px] items-center">
                <div name="signal" class="fill-[#8D8D8D] hidden">
                    <x-svg.read width=20 height=20 :active=false />
                </div>
                <div name="sent-signal">
                    <x-svg.sent width=20 height=20 />
                </div>
                <a class="text-[13px] text-[#8D8D8D]" name="time">13:00 PM</a>
            </div>
        </div>
        <div class="bg-[#F6F5F5] w-fit max-w-[inherit] h-auto rounded-[8.35px] rounded-tr-none py-2 px-[10px]">
            <a class="text-[15px] break-words w-full" name="message">Hi everyone! I hope you're all doing well. I wanted to discuss our upcoming marketing campaign. Any thoughts on how we can make it more effective?</a>
        </div>
    </div>
</div>
