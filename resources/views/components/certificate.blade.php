@props(['Title','name','jobTitle'])

<div class="bg-white shadow rounded-[10px] p-4 flex items-center justify-between relative">
    <div class="flex items-center">
        <div class="w-2 h-full bg-gradient-to-b from-[#1548D1] to-[#1E9AFA] absolute left-0 rounded-l-[10px]"></div>
        <div class="ml-4">
            <h3 class="font-semibold text-gray-800">
                {{ $title }}
            </h3>
            <p class="text-gray-600 text-sm">{{ $name }},{{ $jobTitle }}</p>
        </div>
    </div>
    <a href="" download
        class="bg-gradient-to-b from-[#822bf2] to-[#b378ff] text-white px-4 ml-4 py-2 rounded-full">
        Download
    </a>
</div>