@props(["href" => "#", "name" => '', "active" => false])

<?php 

    $class = "text-gray-500 hover:bg-gray-100";
    if ($active) {
        $class = "bg-gradient-to-b from-[#822BF2] to-[#B378FF] bg-[#B378FF12] !border-[#822BF2] text-transparent bg-clip-text";
    }

?>

<a href="{{ $href }}" class="w-full flex items-center px-2 py-3 gap-2 rounded-lg text-[20px] border border-transparent {{ $class }}">
    {{ $slot }}
    <span>{{ $name }}</span>
</a>
