@props(['title','university','participants'])

<div class="w-[367px] h-[194px] rounded-[24px] border flex flex-col justify-between p-4">
    <div class="flex justify-start items-start">
        <div class="flex space-x-2">
            <span class="px-3 py-1 bg-[#B378FF1A] text-[#822BF2] rounded-full text-[12px]">
                UI/UX Design
            </span>
            <span class="px-3 py-1 bg-[#1548D10D] text-[#1548D1] rounded-full text-[12px]">
                Sudah Daftar
            </span>
        </div>

    </div>
    <div>
        <h2 class="text-[20px] font-bold">{{ $title }}</h2>
        <p class="text-[12px] text-gray-600">{{ $university }}</p>
    </div>
    <div class="flex justify-between items-center">
        <div class="flex gap-2">
            <button class="bg-black text-white text-[14px] px-4 py-3 rounded-full">
                Lihat Detail
            </button>
        </div>
        <div class="flex items-center gap-1 px-2 py-1 bg-[#6B6CF70D] rounded-full">
            <div>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.00005 0.833252C6.25115 0.833252 4.83338 2.25102 4.83338 3.99992C4.83338 5.74882 6.25115 7.16659 8.00005 7.16659C9.74895 7.16659 11.1667 5.74882 11.1667 3.99992C11.1667 2.25102 9.74895 0.833252 8.00005 0.833252ZM5.83338 3.99992C5.83338 2.8033 6.80343 1.83325 8.00005 1.83325C9.19666 1.83325 10.1667 2.8033 10.1667 3.99992C10.1667 5.19654 9.19666 6.16659 8.00005 6.16659C6.80343 6.16659 5.83338 5.19654 5.83338 3.99992Z"
                        fill="#6B6CF7" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.00005 8.16659C6.45768 8.16659 5.03667 8.51717 3.98368 9.10948C2.94637 9.69296 2.16672 10.5773 2.16672 11.6666L2.16667 11.7346C2.16592 12.5091 2.16497 13.4812 3.01766 14.1756C3.4373 14.5173 4.02437 14.7603 4.81752 14.9209C5.61289 15.0819 6.64953 15.1666 8.00005 15.1666C9.35056 15.1666 10.3872 15.0819 11.1826 14.9209C11.9757 14.7603 12.5628 14.5173 12.9824 14.1756C13.8351 13.4812 13.8342 12.5091 13.8334 11.7346L13.8334 11.6666C13.8334 10.5773 13.0537 9.69296 12.0164 9.10948C10.9634 8.51717 9.54242 8.16659 8.00005 8.16659ZM3.16672 11.6666C3.16672 11.099 3.58097 10.4834 4.47394 9.98105C5.35125 9.48757 6.5969 9.16659 8.00005 9.16659C9.4032 9.16659 10.6489 9.48757 11.5262 9.98105C12.4191 10.4834 12.8334 11.099 12.8334 11.6666C12.8334 12.5385 12.8065 13.0293 12.351 13.4002C12.104 13.6014 11.691 13.7977 10.9842 13.9408C10.2796 14.0834 9.3162 14.1666 8.00005 14.1666C6.6839 14.1666 5.72054 14.0834 5.01591 13.9408C4.30906 13.7977 3.89613 13.6014 3.64911 13.4002C3.19359 13.0293 3.16672 12.5385 3.16672 11.6666Z"
                        fill="#6B6CF7" />
                </svg>
            </div>
            <p class="text-[#6B6CF7]">{{ $participants }}</p>
        </div>
    </div>
</div>