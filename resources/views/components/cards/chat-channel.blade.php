<div @click="selectedChannel=$el.id" x-bind:class="selectedChannel == $el.id ? '!bg-gray-100 !bg-opacity-50' : ''" class="hover:bg-gray-100 hover:bg-opacity-50 flex gap-2 p-[10px] py-[12px] rounded-lg w-full animate-pulse bg-[#ebebeb] hidden cursor-pointer" id="chat-channel-sample">
    <div class="rounded-full min-w-[38px] h-[38px] bg-[#331D2C26] bg-opacity-15 flex justify-center items-center">
        <x-svg.chat2 width=25 height=25/>
    </div>
    <div class="flex gap-[1px] flex-col max-w-[170px] 2xl:max-w-[275px] justify-between w-full">
        <div class="flex justify-between items-center w-full">
            <a class="text-[14px] font-semibold" name="team_name"></a>
            <a class="text-[10px] text-[#8D8D8D]" name="last_update"></a>
        </div>
        <div class="flex justify-between items-center">
            <a class="text-[#707070] text-[12px] w-fit truncate" name="last_message"></a>
            <div class="w-[15px] h-[15px] relative hidden" name="channel_unread">
                <span class="inline-flex absolute top-0 right-0 w-[20px] h-full bg-sky-400 rounded-full opacity-100 animate-ping hidden"></span>
                    <span class="flex inline-flex absolute right-0 justify-center items-center p-2 w-[20px] h-[20px] bg-[#822BF2] rounded-full"><a class="text-sm text-white" name="unread_messages"></a></span>
            </div>
        </div>
    </div>

</div>