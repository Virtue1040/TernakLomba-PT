@props([])

<div class="p-4 border-b border-gray-100">
    <div class="flex items-start">
        <div class="flex-shrink-0 p-2 mr-4 bg-purple-100 rounded-full">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
        </div>
        <div class="flex-1">
            <p class="text-base text-gray-700">
                <span class="font-semibold">Fathie</span> telah mengajukan diri untuk bergabung
                ke dalam Compspace <span class="font-semibold">Tim Hore</span>
            </p>
            <div class="flex mt-3 space-x-2">
                <button
                    class="px-6 py-2 text-white bg-black rounded-full transition-colors hover:bg-gray-800">
                    Terima
                </button>
                <button
                    class="px-6 py-2 text-black bg-white rounded-full border border-gray-300 transition-colors hover:bg-gray-50">
                    Tolak
                </button>
            </div>
            <p class="mt-2 text-sm text-gray-500">2m ago</p>
        </div>
    </div>
</div>