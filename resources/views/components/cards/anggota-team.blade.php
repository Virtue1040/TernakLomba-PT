@props(['nama','jobdesk','image'=>"images/4cnational.png"])

<div class="flex items-center gap-3">
    <img src="{{ $image }}" alt="" class="w-10 h-10 rounded-full flex-shrink-0 object-cover" />
    <div>
        <h3 class="font-medium text-gray-900">{{ $nama }}</h3>
        <p class="text-sm text-gray-500">{{ $jobdesk }}</p>
    </div>
</div>
