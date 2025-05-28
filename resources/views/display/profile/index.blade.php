<?php
$isLocal = $user->id_user === $profile->id_user;
?>
<x-layouts.default footer=false>
    <x-slot name="script">
        <script>
            function openEdit(editName) {
                let div = $("#" + editName)
                div.find("p").addClass("hidden")
                div.find("div[name='editor']").removeClass("hidden")

                let getEditor = div.find(`[name='${editName}']`)
                getEditor.focus()
                getEditor.val(div.find("p").html().trim())
            }

            function closeEdit(editName) {
                let div = $("#" + editName)
                div.find("p").removeClass("hidden")
                div.find("div[name='editor']").addClass("hidden")
            }

            function saveBio() {
                let div = $("#bio")
                let getEditor = div.find(`[name='bio']`)

                div.find("p").html(getEditor.val())

                $.ajax({
                    url: "{{ route('profile.update') }}",
                    method: "POST",
                    data: {
                        _method: 'PUT',
                        bio: getEditor.val(),
                    },
                    success: function(response) {

                    },
                    error: function(exception) {
                        console.log(exception)
                    }
                })

                closeEdit("bio")
            }
        </script>
    </x-slot>
    <div class="px-4 mx-auto w-full lg:max-w-[1200px]">
        <div class="p-4">
            <a href="{{ route('dashboard-index') }}" class="flex gap-2 items-center text-gray-800">
                <svg width="17" height="17" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.4376 14.6665H26.6663V17.3332H10.4376L17.5895 24.4851L15.7039 26.3707L5.33301 15.9999L15.7039 5.62891L17.5895 7.51452L10.4376 14.6665Z"
                        fill="black" />
                </svg>
                <span class="font-medium">Profil Saya</span>
            </a>
        </div>

        <div class="pb-7 rounded-b-lg shadow-lg">
            <div class="relative">
                <div class="w-full h-56 bg-[#822bf2] rounded-t-lg overflow-hidden"><x-svg.bg-profile /></div>

                <div class="absolute left-8 -bottom-16">
                    <div class="overflow-hidden w-32 h-32 bg-white rounded-full border-4 border-white">
                        <img src="{{ asset("documents/profile/$profile->id_user/profile.png") }}"
                            onerror="this.src='{{ asset('images/4cnational.png') }}'"
                            class="object-cover w-full h-full">
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-4 mr-4" x-data="{ isOpen: false }">
                @if ($isLocal)
                    <button @click="isOpen = true"
                        class="flex items-center bg-white rounded-lg py-2 px-4 text-[#822BF2] font-medium text-sm border border-[#822BF2] gap-1">
                        <x-svg.edit-icon height="20" width="20" class="mr-2" />
                        Edit Profile
                    </button>
                @else
                    <button
                        class="flex items-center bg-white rounded-lg py-2 px-4 text-[#822BF2] font-medium text-sm border border-[#822BF2] gap-1">
                        Undang ke Compspace
                    </button>
                @endif


                <div x-show="isOpen" @keydown.escape.window="isOpen = false" x-transition
                    class="overflow-y-auto fixed inset-0 z-50" style="display: none;">
                    <div class="flex justify-center items-center p-4 min-h-screen">

                        <div @click="isOpen = false" class="fixed inset-0 bg-black opacity-50"></div>

                        <div class="relative z-10 mx-auto w-full max-w-md bg-white rounded-lg shadow-lg">

                            <div class="flex justify-between items-center p-4 border-b">
                                <h3 class="text-lg font-semibold text-gray-900">Edit Profile</h3>
                                <button @click="isOpen = false" class="text-gray-400 hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>

                            <div class="p-4">
                                <form action="{{ route('profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="flex flex-col items-center mb-6">
                                        <div class="overflow-hidden relative mb-2 w-24 h-24 bg-gray-200 rounded-full">
                                            <img src="" class="object-cover w-full h-full" alt="Profile Photo">
                                        </div>
                                        <label for="photo_profile"
                                            class="px-3 py-1 text-sm text-gray-700 bg-gray-100 rounded-md cursor-pointer hover:bg-gray-200">
                                            Upload Foto
                                            <input type="file" id="photo_profile" name="photo_profile"
                                                accept="image/*" class="hidden">
                                        </label>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="first_name"
                                                class="block mb-1 text-sm font-medium text-gray-700">Nama Depan</label>
                                            <input type="text" id="first_name" name="first_name"
                                                value="{{ $profile->user_detail->first_name }}"
                                                class="px-3 py-2 w-full rounded-md border border-gray-300 focus:ring-purple-500">
                                        </div>
                                        <div>
                                            <label for="last_name"
                                                class="block mb-1 text-sm font-medium text-gray-700">Nama
                                                Belakang</label>
                                            <input type="text" id="last_name" name="last_name"
                                                value="{{ $profile->user_detail->last_name }}"
                                                class="px-3 py-2 w-full rounded-md border border-gray-300 focus:ring-purple-500">
                                        </div>
                                    </div>

                                    <div class="mb-6">
                                        <label for="kampus"
                                            class="block mb-1 text-sm font-medium text-gray-700">Kampus</label>
                                        <input type="text" id="kampus" name="kampus"
                                            value="{{ $profile->get_associated->kampus ?? '' }}"
                                            class="px-3 py-2 w-full rounded-md border border-gray-300 focus:ring-purple-500">
                                    </div>

                                    <div class="mb-6">
                                        <label for="jurusan"
                                            class="block mb-1 text-sm font-medium text-gray-700">Jurusan</label>
                                        <input type="text" id="jurusan" name="jurusan"
                                            value="{{ $profile->get_associated->jurusan ?? '' }}"
                                            class="px-3 py-2 w-full rounded-md border border-gray-300 focus:ring-purple-500">
                                    </div>

                                    <div class="flex justify-end space-x-3">
                                        <button type="button" @click="isOpen = false"
                                            class="px-4 py-2 text-gray-700 bg-white rounded-md border border-gray-300 hover:bg-gray-100">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#822BF2] rounded-md text-white hover:bg-[#6B24C7]">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="px-8 mt-8">
                <h1 class="text-2xl font-bold text-gray-800">{{ $profile->user_detail->first_name }}
                    {{ $profile->user_detail->last_name }}</h1>
                <p class="text-gray-600">
                    {{ $profile->get_associated !== null ? $profile->get_associated->kampus : '' }}</p>
            </div>

            <div class="grid grid-cols-1 gap-4 px-8 mt-6 lg:grid-cols-3">
                <div
                    class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white p-4 sm:p-6 rounded-xl h-[111px] relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-[17px] sm:text-[26.35px] font-semibold">
                            {{ $profile->get_total_joined_lomba() }} Lomba</h3>
                        <p class="text-[9.88px]">Lomba yang telah diikuti</p>
                    </div>
                    <div class="absolute right-0 -bottom-16">
                        <svg width="122" height="147" viewBox="0 0 122 147" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_354_1520)"></g>
                            <g clip-path="url(#clip1_354_1520)">
                                <path
                                    d="M163.891 28.3608L87.2995 2.99225C85.9893 2.55825 84.5728 2.55825 83.2625 2.99225L6.67112 28.3608C5.40022 28.7817 4.29485 29.5894 3.51159 30.6693C2.72834 31.7492 2.30691 33.0467 2.30701 34.3778V97.7991C2.30701 99.4811 2.97946 101.094 4.17643 102.284C5.3734 103.473 6.99685 104.141 8.68962 104.141C10.3824 104.141 12.0058 103.473 13.2028 102.284C14.3998 101.094 15.0722 99.4811 15.0722 97.7991V43.1775L41.8713 52.0486C34.7511 63.4787 32.4869 77.2494 35.5759 90.3368C38.6648 103.424 46.8544 114.759 58.3464 121.852C43.9855 127.449 31.5713 137.572 22.492 151.414C22.0198 152.111 21.6919 152.895 21.5271 153.719C21.3624 154.544 21.3643 155.392 21.5326 156.216C21.7009 157.04 22.0323 157.822 22.5075 158.517C22.9827 159.213 23.5922 159.807 24.3007 160.266C25.0092 160.725 25.8025 161.04 26.6344 161.192C27.4664 161.344 28.3204 161.33 29.1468 161.151C29.9733 160.972 30.7557 160.631 31.4486 160.149C32.1415 159.667 32.731 159.053 33.1829 158.343C45.2062 140.014 64.1945 129.51 85.281 129.51C106.368 129.51 125.356 140.014 137.379 158.343C138.315 159.725 139.761 160.686 141.405 161.018C143.048 161.349 144.757 161.025 146.162 160.114C147.566 159.204 148.554 157.781 148.911 156.153C149.268 154.525 148.966 152.822 148.07 151.414C138.991 137.572 126.529 127.449 112.216 121.852C123.697 114.759 131.878 103.432 134.967 90.3541C138.055 77.2762 135.798 63.515 128.691 52.0882L163.891 40.4346C165.162 40.0138 166.268 39.2063 167.051 38.1263C167.835 37.0464 168.256 35.7488 168.256 34.4175C168.256 33.0862 167.835 31.7886 167.051 30.7086C166.268 29.6287 165.162 28.8211 163.891 28.4004V28.3608ZM123.577 78.7727C123.578 84.7887 122.145 90.7193 119.393 96.078C116.641 101.437 112.65 106.071 107.747 109.6C102.844 113.129 97.1689 115.453 91.187 116.381C85.2051 117.309 79.087 116.814 73.3348 114.937C67.5825 113.061 62.36 109.856 58.0958 105.585C53.8316 101.314 50.6471 96.1001 48.8037 90.3698C46.9602 84.6395 46.5104 78.5565 47.491 72.62C48.4716 66.6835 50.8548 61.0626 54.445 56.2185L83.2625 65.7317C84.5728 66.1657 85.9893 66.1657 87.2995 65.7317L116.117 56.2185C120.966 62.7509 123.581 70.6556 123.577 78.7727ZM85.281 53.0633L28.8747 34.3778L85.281 15.6924L141.687 34.3778L85.281 53.0633Z"
                                    fill="white" fill-opacity="0.15" />
                            </g>
                            <defs>
                                <clipPath id="clip0_354_1520">
                                    <rect x="0.175781" y="0.411621" width="121.058" height="145.764" rx="6.58822"
                                        fill="white" />
                                </clipPath>
                                <clipPath id="clip1_354_1520">
                                    <rect x="0.175781" y="0.411621" width="168.823" height="162.235" rx="4.06206"
                                        fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white p-4 sm:p-6 rounded-xl h-[111px] relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-[17px] sm:text-[26.35px] font-semibold">{{ $profile->get_winrate() }}%</h3>
                        <p class="text-[9.88px]">Tingkat Kemenangan</p>
                    </div>
                    <div class="absolute right-0 -bottom-16">
                        <svg width="118" height="136" viewBox="0 0 118 136" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_354_1539)">
                                <g clip-path="url(#clip1_354_1539)">
                                    <path
                                        d="M5.94666 0.0917969H121.335C123.212 0.7866 124.848 2.47699 124.8 4.58546C124.842 26.9274 124.818 49.2724 124.878 71.6114C134.602 74.944 142.979 81.9762 147.999 90.9425C153.143 99.999 154.713 110.99 152.367 121.132C149.052 136.264 136.762 148.957 121.735 152.729C119.335 153.409 116.844 153.622 114.405 154.091H39.3393C37.5256 153.508 36.3014 152.001 35.002 150.705C24.6221 140.334 14.2482 129.951 3.86827 119.577C2.88472 118.623 2.39144 117.264 2.44257 115.904C2.44859 78.797 2.43054 41.6867 2.4516 4.58245C2.39445 2.46195 4.03972 0.753514 5.94666 0.0917969ZM11.472 9.12122C11.463 43.335 11.463 77.5518 11.472 111.766C21.1 111.811 30.734 111.757 40.362 111.793C42.681 111.799 44.7293 113.853 44.7413 116.169C44.7834 125.8 44.7263 135.431 44.7714 145.062C58.1561 145.062 71.5439 145.089 84.9286 145.05C80.3688 141.323 76.4436 136.775 73.7005 131.548C68.5571 121.974 67.3781 110.382 70.4099 99.9539C73.144 90.365 79.4183 81.8559 87.7349 76.3637C95.9101 70.8775 106.04 68.4532 115.819 69.5691C115.837 49.4228 115.81 29.2765 115.792 9.13025C81.0184 9.10017 46.2452 9.11822 11.472 9.12122ZM108.423 78.4361C95.5221 79.3143 83.7435 88.5032 79.6258 100.739C77.0361 108.126 77.1835 116.425 80.0168 123.722C83.3615 132.462 90.5682 139.624 99.333 142.908C107.992 146.238 118.054 145.682 126.283 141.386C134.245 137.317 140.426 129.918 142.979 121.345C145.217 114.024 144.811 105.933 141.845 98.8741C136.609 85.8172 122.46 77.0735 108.423 78.4361ZM18.017 120.819C23.7799 126.835 29.7053 132.754 35.7149 138.523C35.751 132.619 35.7299 126.711 35.7269 120.807C29.8226 120.81 23.9183 120.789 18.017 120.819Z"
                                        fill="#E8E8E8" fill-opacity="0.25" />
                                    <path
                                        d="M24.1835 18.2463C34.1724 18.0207 44.1824 18.2162 54.1804 18.147C56.4964 17.9696 58.7733 19.7231 59.062 22.0511C59.4831 24.5747 57.3566 27.1313 54.7939 27.1614C44.8622 27.1855 34.9274 27.1704 24.9956 27.1704C22.8029 27.2216 20.7997 25.4409 20.529 23.2783C20.1591 20.9743 21.8976 18.6313 24.1835 18.2463Z"
                                        fill="#E8E8E8" fill-opacity="0.25" />
                                    <path
                                        d="M71.728 18.2691C81.7049 17.9924 91.7118 18.2361 101.701 18.1488C103.824 17.9834 106.017 19.3159 106.57 21.4213C107.479 24.1344 105.169 27.2535 102.308 27.1692C92.4818 27.1843 82.6523 27.1692 72.8228 27.1783C70.6843 27.2926 68.645 25.6834 68.251 23.5809C67.6885 21.2499 69.3849 18.7173 71.728 18.2691Z"
                                        fill="#E8E8E8" fill-opacity="0.25" />
                                    <path
                                        d="M24.208 36.3162C50.1323 36.1448 76.0776 36.2982 102.011 36.241C104.778 36.0245 107.253 38.7676 106.691 41.4987C106.348 43.7124 104.219 45.3908 101.99 45.2614C76.628 45.2795 51.2662 45.2554 25.9014 45.2735C24.2832 45.3848 22.5266 44.9035 21.501 43.5711C19.2993 41.1077 20.9505 36.7584 24.208 36.3162Z"
                                        fill="#E8E8E8" fill-opacity="0.25" />
                                    <path
                                        d="M24.2191 54.3861C30.5897 54.2116 36.9752 54.365 43.3518 54.3109C44.7654 54.347 46.2784 54.1124 47.5837 54.7951C49.5178 55.7125 50.5705 58.1338 49.8697 60.1671C49.3132 62.059 47.4093 63.3975 45.4452 63.3313C38.6325 63.3373 31.8198 63.3463 25.0102 63.3253C22.8897 63.3523 20.9316 61.7161 20.5646 59.6317C20.0623 57.2645 21.8399 54.756 24.2191 54.3861Z"
                                        fill="#E8E8E8" fill-opacity="0.25" />
                                    <path
                                        d="M24.2274 72.4548C30.5949 72.2803 36.9745 72.4307 43.348 72.3796C44.7587 72.4157 46.2686 72.1841 47.574 72.8608C49.5772 73.7993 50.6239 76.3589 49.8028 78.4253C49.1892 80.23 47.3454 81.4662 45.4475 81.403C38.6348 81.4 31.8221 81.415 25.0094 81.394C23.0333 81.418 21.1805 80.0074 20.6632 78.1065C19.8811 75.6521 21.6918 72.8278 24.2274 72.4548Z"
                                        fill="#E8E8E8" fill-opacity="0.25" />
                                    <path
                                        d="M106.395 89.3136C108.065 85.4215 114.294 85.4787 115.888 89.4039C120.234 100.728 124.454 112.104 128.752 123.449C129.718 125.663 128.581 128.496 126.322 129.375C124.195 130.322 121.467 129.266 120.532 127.137C119.705 125.221 119.094 123.218 118.27 121.299C113.461 121.308 108.651 121.263 103.842 121.323C103.045 123.263 102.401 125.269 101.559 127.191C100.539 129.45 97.5042 130.415 95.3657 129.17C93.3986 128.132 92.4812 125.558 93.3474 123.506C97.7087 112.113 101.974 100.68 106.395 89.3136ZM107.304 112.254C109.83 112.284 112.36 112.281 114.889 112.257C113.647 108.943 112.393 105.634 111.154 102.322C109.716 105.568 108.57 108.94 107.304 112.254Z"
                                        fill="#E8E8E8" fill-opacity="0.25" />
                                </g>
                            </g>
                            <defs>
                                <clipPath id="clip0_354_1539">
                                    <rect width="116.117" height="135.882" fill="white"
                                        transform="translate(0.939941 0.0917969)" />
                                </clipPath>
                                <clipPath id="clip1_354_1539">
                                    <rect width="154" height="154" fill="white"
                                        transform="translate(0.939941 0.0917969)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white p-4 sm:p-6 rounded-xl h-[111px] relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-[17px] sm:text-[26.35px] font-semibold">{{ $profile->get_total_win_lomba() }}
                            Kemenangan</h3>
                        <p class="text-[9.88px]">Jumlah Kemenangan Kompetisi</p>
                    </div>
                    <div class="absolute right-0 -bottom-16">
                        <svg width="113" height="148" viewBox="0 0 113 148" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_354_1561)">
                                <path
                                    d="M95.9943 20.651C102.579 13.827 109.155 7.00025 115.742 0.17627C115.745 6.53164 115.742 12.8842 115.742 19.2396C117.677 21.1972 119.64 23.1299 121.57 25.0959C121.808 25.3066 122.03 25.631 122.395 25.5922C128.636 25.6061 134.88 25.5894 141.124 25.5978C134.304 32.4301 127.49 39.2679 120.656 46.0863C115.26 46.5439 109.866 47.0291 104.47 47.4894C97.6473 54.3106 90.8331 61.1401 84.019 67.9697C85.0158 70.0715 84.7721 72.5171 84.3236 74.7327C83.36 78.7366 80.5662 82.2831 76.867 84.0993C73.6468 85.8351 69.7068 86.0653 66.2512 84.9312C62.8345 83.7555 59.8303 81.296 58.1717 78.0601C56.5325 75.1874 56.1421 71.6797 56.8371 68.4688C57.9696 63.3446 62.1589 59.0661 67.2425 57.8072C69.4936 57.2193 71.8332 57.4273 74.1314 57.3885C80.9483 50.5645 87.7542 43.735 94.5739 36.9138C95.0556 31.4928 95.5097 26.0719 95.9943 20.651Z"
                                    fill="white" fill-opacity="0.15" />
                                <path
                                    d="M41.2464 7.34549C59.6538 -1.2448 81.7936 -1.24757 100.24 7.23181C96.8894 10.5842 93.5501 13.9504 90.186 17.2889C89.8205 17.5995 89.682 18.0653 89.5464 18.5062C85.346 17.142 81.0571 16.0079 76.6684 15.4478C64.1947 13.834 51.2752 17.0033 40.6927 23.7275C27.6569 31.8575 18.2372 45.5276 15.2607 60.6147C13.3779 70.303 13.9787 80.5376 17.3124 89.8461C22.2078 104.184 33.142 116.332 46.8866 122.679C57.8956 127.962 70.6738 129.326 82.5882 126.719C94.3005 124.113 105.135 117.697 113.007 108.621C122.535 97.7764 127.826 83.1524 126.907 68.6865C126.691 63.1851 125.525 57.7753 124.215 52.4431C127.737 49.1407 131.273 45.8548 134.795 42.5524C140.468 54.093 142.083 67.3611 140.61 80.0579C139.231 91.5098 134.945 102.593 128.291 112.009C122.23 120.647 114.222 127.903 105.035 133.078C94.8598 138.862 83.214 141.97 71.5183 142.142H69.5275C59.8199 141.956 50.1511 139.799 41.335 135.715C25.0708 128.272 11.8578 114.427 5.19593 97.8042C1.11463 87.7332 -0.554988 76.7 0.322739 65.8665C1.30845 53.3027 5.78292 41.0356 13.101 30.7844C20.228 20.6912 30.0409 12.5252 41.2464 7.34549Z"
                                    fill="white" fill-opacity="0.15" />
                                <path
                                    d="M59.5089 30.6732C66.802 28.6268 74.6462 28.7072 81.9449 30.6898C84.0991 31.1751 86.1619 31.9709 88.2524 32.6752C88.2524 32.8443 88.2524 33.1881 88.2551 33.3573C84.7332 36.9038 81.1918 40.4281 77.6698 43.969C75.5738 43.8969 73.5276 43.3811 71.4316 43.2952C66.1791 43.1288 60.8905 44.4931 56.369 47.1772C50.7731 50.4658 46.3513 55.7342 44.1445 61.8511C41.8657 67.9735 41.8491 74.9084 44.0947 81.0448C46.2571 87.1228 50.5987 92.3802 56.1226 95.6937C61.5634 99.0295 68.1754 100.366 74.4884 99.4704C79.9513 98.7328 85.154 96.2927 89.2713 92.6297C94.9198 87.6691 98.4667 80.3571 98.7657 72.8288C98.8294 70.031 98.8986 67.1694 98.1234 64.452C101.258 61.0775 104.409 57.7195 107.535 54.3367C107.809 53.9623 108.221 53.8043 108.678 53.8015C109.445 55.6621 110.406 57.4534 110.957 59.3999C114.756 70.8296 112.84 83.8647 106.405 93.9829C100.626 103.236 91.1597 110.138 80.5439 112.661C68.552 115.653 55.2836 112.966 45.4431 105.462C35.6469 98.2642 29.2065 86.6431 28.4451 74.4814C27.9965 68.3285 28.9213 62.0757 31.1641 56.3276C35.8656 43.9413 46.714 34.0865 59.5089 30.6732Z"
                                    fill="white" fill-opacity="0.15" />
                            </g>
                            <defs>
                                <clipPath id="clip0_354_1561">
                                    <rect x="0.0952148" y="0.17627" width="112.823" height="147.411" rx="6.58822"
                                        fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mt-4 mb-8 md:grid-cols-5">
            <div class="space-y-6 md:col-span-3">
                <div class="p-6 bg-white rounded-lg shadow-lg" id="bio">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold text-gray-800">Tentang</h2>
                        @if ($isLocal)
                            <button onclick="openEdit('bio')" class="text-purple-600">
                                <x-svg.edit-icon height="20" width="20" />
                            </button>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600">
                        {{ $profile->user_detail->bio }}
                        {{-- UI/UX Designer with strong experience in designing user interfaces for 3 years. Proficient in
                        Figma and Framer, with expertize in SaaS & Company Profile. Successfully handled 50+ abroad
                        projects, including numerous landing pages, dashboards, full-app websites and mobile. --}}
                    </p>
                    <div name="editor" class="flex hidden flex-col gap-3 w-full">
                        <x-textarea name="bio" label="" class="!text-[15px]" placeholder="Tentang Saya" />
                        <div class="flex gap-2 justify-end">
                            <button onclick="closeEdit('bio')"
                                class="bg-[#DB1F2D] text-white text-[10px] md:text-[15px] rounded-lg py-1 px-2">
                                <span>Batal</span>
                            </button>
                            <button onclick="saveBio()"
                                class="bg-[#822BF2] text-white text-[10px] md:text-[15px] rounded-lg py-1 px-2">
                                <span>Simpan</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-lg" id="minat">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold text-gray-800">Minat Kompetisi</h2>
                        @if ($isLocal)
                            <button class="text-purple-600">
                                <x-svg.edit-icon height="20" width="20" />
                            </button>
                        @endif
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($profile->get_minat as $minat)
                            <span
                                class="px-4 py-2 rounded-full text-sm border border-[#822bf2] text-purple-600">{{ $minat->bidang->name }}</span>
                        @endforeach
                    </div>
                </div>

                <div x-data="{ menu: 'lombaDiikuti' }" class="p-6 bg-white rounded-lg shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold text-gray-800">Aktifitas dan Kegiatan</h2>
                    </div>

                    <div class="flex gap-2 mb-6">
                        <button @click="menu = 'lombaDiikuti'"
                            class="text-black text-[13px] sm:text-[15px] border border-[#E7E7E7] px-3 py-1 sm:py-2 rounded-full font-medium"
                            x-bind:class="menu === 'lombaDiikuti' ? 'bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white' :
                                'bg-white'">
                            Lomba yang sedang diikuti
                        </button>
                        <button @click="menu = 'lombaSelesai'"
                            class="text-black text-[13px] sm:text-[15px] border border-[#E7E7E7] px-3 py-1 sm:py-2 rounded-full font-medium"
                            x-bind:class="menu === 'lombaSelesai' ? 'bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white' :
                                'bg-white'">
                            Lomba yang telah selesai
                        </button>
                    </div>

                    <div x-show="menu === 'lombaDiikuti'" class="flex overflow-x-auto flex-row gap-4">
                        @foreach ($user->get_joined_compspace as $compspace)
                            @if (now()->between($compspace->team->lomba->start_date, $compspace->team->lomba->decide_date))
                                <x-cards.lomba-card title="{{ $compspace->team->lomba->lombaDetail->title }}"
                                    university="{{ $compspace->team->lomba->lombaDetail->penyelenggara_name }}"
                                    gambar="{{ $compspace->team->lomba->id_lomba }}"
                                    startDate="{{ $compspace->team->lomba->start_date }}"
                                    endDate="{{ $compspace->team->lomba->end_date }}" />
                            @endif
                        @endforeach
                    </div>

                    <div x-show="menu === 'lombaSelesai'" class="flex overflow-x-auto flex-row gap-4">
                        @foreach ($user->get_joined_compspace as $compspace)
                            @if (now()->gt($compspace->team->lomba->decide_date))
                                <x-cards.lomba-card title="{{ $compspace->team->lomba->lombaDetail->title }}"
                                    university="{{ $compspace->team->lomba->lombaDetail->penyelenggara_name }}"
                                    gambar="{{ $compspace->team->lomba->id_lomba }}"
                                    startDate="{{ $compspace->team->lomba->start_date }}"
                                    endDate="{{ $compspace->team->lomba->end_date }}" />
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="p-6 bg-white rounded-lg shadow-lg h-fit">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold text-gray-800">Prestasi</h2>
                        @if ($isLocal)
                            <button class="text-purple-600">
                                <x-svg.edit-icon height="20" width="20" />
                            </button>
                        @endif
                    </div>

                    <div x-data="{ form1Open: false, form2Open: false }" class="space-y-4">
                        @foreach ($profile->get_prestasi as $prestasi)
                            <x-cards.prestasi-card title="{{ $prestasi->title }}"
                                case="{{ $prestasi->get_minat_text() }}" juara="{{ $prestasi->juara }}"
                                tingkat="{{ $prestasi->tingkatan }}" />
                        @endforeach

                        <div class="grid grid-cols-2 gap-2">
                            <button @click="form1Open = !form1Open" class="bg-[#822BF2] text-white text-[15px] md:text-[20px] rounded-lg py-3">
                                <span>+ Tambah Prestasi</span>
                            </button>
                            @if ($isLocal)
                                <button @click="form2Open = !form2Open"
                                    class="text-[#822BF2] border border-[#822BF2] text-[15px] md:text-[17px] rounded-lg py-3 flex justify-center items-center">
                                    <x-svg.edit-icon height="20" width="20" />
                                    <span class="ml-1">Edit Prestasi</span>
                                </button>
                            @endif

                        </div>

                        <div x-show="form1Open" x-cloak
                            class="flex fixed inset-0 top-[-15px] z-50 justify-center items-center bg-black bg-opacity-50"
                            @click.self="formOpen = false">
                            <div class="bg-white rounded-[16px] w-full max-w-md mx-4 p-6 space-y-4">
                                <h2 class="text-xl font-semibold">Join Compsace</h2>

                                <form action="" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-bold text-gray-700" for="namaLomba">
                                            Nama Lomba
                                        </label>
                                        <input name="namaLomba" placeholder="Masukkan nama lomba" type="text" class="px-3 py-2 w-full rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#822BF2]" required>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-bold text-gray-700" for="bidangLomba">
                                            Bidang Lomba
                                        </label>
                                        <select name="bidangLomba" id="bidangLomba"
                                            class="px-3 py-2 w-full rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#822BF2]"
                                            required>
                                            <option value="" disabled selected>Pilih bidang lomba</option>
                                            <option value="Business Case">Business Case</option>
                                            <option value="Business Plan">Business Plan</option>
                                            <option value="Hackathon">Hackathon</option>
                                            <option value="Debat Bahasa">Debat Bahasa</option>
                                            <option value="Web Development">Web Development</option>
                                            <option value="UI/UX">UI/UX</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-bold text-gray-700" for="juara">
                                            Juara
                                        </label>
                                        <select name="juara" id="juara"
                                            class="px-3 py-2 w-full rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#822BF2]"
                                            required>
                                            <option value="" disabled selected>Pilih juara yang kamu raih</option>
                                            <option value="Juara 1">Juara 1</option>
                                            <option value="Juara 2">Juara 2</option>
                                            <option value="Juara 3">Juara 3</option>
                                            <option value="Favorit">Favorite</option>
                                            <option value="Finalist">Finalist</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-bold text-gray-700" for="tingkatLomba">
                                            Tingkat Lomba
                                        </label>
                                        <select name="tingkatLomba" id="tingkatLomba"
                                            class="px-3 py-2 w-full rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#822BF2]"
                                            required>
                                            <option value="" disabled selected>Pilih tingkatan lomba</option>
                                            <option value="Internasional">Internasional</option>
                                            <option value="Nasional">Nasional</option>
                                            <option value="Regional">Regional<option>
                                        </select>
                                    </div>

                                    <div class="flex justify-end space-x-4">
                                        <button type="button" @click="form1Open = false"
                                            class="px-5 py-2 text-black rounded-md border border-gray-500">
                                            Batal
                                        </button>
                                        <button type="" @click="form1Open = false; form2Open = true"
                                            class="px-4 py-2 text-white bg-gradient-to-b from-[#822bf2] to-[#b378ff] rounded-md">
                                            Selanjutnya
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{--  --}}
                        <div x-show="form2Open" x-cloak
                            class="flex fixed inset-0 top-[-17px] z-50 justify-center items-center bg-black bg-opacity-50"
                            @click.self="formOpen = false">
                            <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 space-y-4">
                                <h2 class="text-[25px] font-bold">Prestasi</h2>
                                <div class="flex flex-row items-center justify-between bg-[#F7F7F7] rounded-lg p-4">
                                    <div class="flex flex-col">
                                        <h2 class="text-[20x] font-bold">4C National Competition</h2>
                                        <p class=text-[18px]>Business case</p>
                                        <div class="flex flex-row ">
                                            <p class="text-[16px]">Juara 1</p><span> • </span>
                                            <p class="text-[16px]">Nasional</p> 
                                        </div>
                                    </div>
                                    <button @click="form1Open = true; form2Open = false">
                                        <x-svg.edit-icon height="25" width="25" />
                                    </button>
                                </div>
                                <div class="flex w-full justify-center space-x-4">
                                    <button type="button" @click="form2Open = false"
                                        class="px-5 py-2 w-full text-black rounded-md border border-gray-500">
                                        Batal
                                    </button>
                                    <button type="submit" @click="form2Open = false"
                                        class="px-4 py-2 w-full text-white bg-gradient-to-b from-[#822bf2] to-[#b378ff] rounded-md">
                                        Konfirmasi
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{--  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.default>
