@props(['name', 'kampus', 'prestasi' => []])

<div class="flex-shrink-0 w-[303px] bg-white border border-gray-200 rounded-lg ">
    <div class="px-1 pt-1">
        <img class="w-full max-h-[160px] rounded-lg object-cover mx-auto " src="{{ asset('images/4cnational.png') }}" alt="Profile Image">
    </div>
    
    <div class="p-5">
        <h2 class="text-lg font-semibold text-black">{{ $name }}</h2>
        <p class="text-sm text-gray-500">{{ $kampus }}</p>

        <div class="mt-4 space-y-2">
            @forelse ($prestasi as $item)
                <div class="flex gap-2 items-center text-sm text-gray-600">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7925 10.5757V15.3424C11.7925 15.5339 11.6371 15.6893 11.4456 15.6893C11.3828 15.6893 11.3211 15.6722 11.2672 15.6399L8.32398 13.8739L5.3808 15.6399C5.21654 15.7384 5.00349 15.6851 4.90493 15.5209C4.87259 15.4669 4.8555 15.4053 4.8555 15.3424V10.5757C3.58678 9.55867 2.77441 7.99584 2.77441 6.24329C2.77441 3.17835 5.25904 0.693726 8.32398 0.693726C11.3889 0.693726 13.8735 3.17835 13.8735 6.24329C13.8735 7.99584 13.0612 9.55867 11.7925 10.5757ZM6.24289 11.3895V13.5046L8.32398 12.256L10.4051 13.5046V11.3895C9.76242 11.6496 9.05992 11.7928 8.32398 11.7928C7.58803 11.7928 6.88555 11.6496 6.24289 11.3895ZM8.32398 10.4055C10.6227 10.4055 12.4861 8.54199 12.4861 6.24329C12.4861 3.94458 10.6227 2.08112 8.32398 2.08112C6.02527 2.08112 4.1618 3.94458 4.1618 6.24329C4.1618 8.54199 6.02527 10.4055 8.32398 10.4055Z" fill="black"/>
                    </svg>
                    <p class="break-words">{{ $item }}</p>
                </div>
            @empty
                <p class="text-sm text-gray-400 italic">Belum ada prestasi.</p>
            @endforelse
        </div>
    </div>
</div>
