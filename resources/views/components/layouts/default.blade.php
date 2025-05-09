@props(["footer"])

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <title>{{ env("APP_NAME") }}</title>
        @isset($script)
            {{ $script }}
        @endisset

        @vite(['resources/css/app.css'])
        <style>
            html {
                scroll-behavior: smooth;
            }
        </style>
    </head>

    <body>
        @isset($slot)
            {{ $slot }}
        @endisset
        
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
          AOS.init();
        </script>
    </body>
    
    @if ($footer == "true")
        <x-footer/>
    @endisset
</html>