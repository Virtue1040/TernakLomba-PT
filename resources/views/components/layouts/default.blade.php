@props(['footer'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>{{ env('APP_NAME') }}</title>
    <script>
        (function($) {
            $.fn.onEnter = function(func) {
                this.bind('keypress', function(e) {
                    if (e.keyCode == 13) func.apply(this, [e]);
                });
                return this;
            };
            $.fn.onPause = function(func, delay = 2000) {
                let timer;
                this.on('input', function() {
                    clearTimeout(timer);
                    timer = setTimeout(() => {
                        func.apply(this);
                    }, delay);
                });
                return this;
            };
        })(jQuery);

        let debounceAjax = false

        function spawnNotification(title, message, icon, timer = 1500, isConfirmed = () => {}, isDenied = () => {},
            isDismissed = () => {}) {
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
                showCancelButton: false,
                showConfirmButton: false,
                timer: timer
            }).then((result) => {
                if (result.isConfirmed && typeof isConfirmed === "function") {
                    isConfirmed();
                } else if (result.isDenied && typeof isDenied === "function") {
                    isDenied();
                } else if (result.isDismissed && typeof isDismissed === "function") {
                    isDismissed();
                }
            });
        }

        function spawnConfirmationDelete(isConfirmed = () => {}, isDenied = () => {},
            isDismissed = () => {}) {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this item!",
                icon: "warning",
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed && typeof isConfirmed === "function") {
                    isConfirmed();
                } else if (result.isDenied && typeof isDenied === "function") {
                    isDenied();
                } else if (result.isDismissed && typeof isDismissed === "function") {
                    isDismissed();
                }
            });
        }
    </script>
    @isset($script)
        {{ $script }}
    @endisset

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

@if ($footer == 'true')
    <x-footer />
@endisset

</html>
