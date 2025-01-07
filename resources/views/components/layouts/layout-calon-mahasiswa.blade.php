<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }} - PMB UNSRIT</title>
    <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/app.css') }}" />
    <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/app-dark.css') }}" />
    <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/iconly.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}">
    @vite('resources/js/app.js')
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <x-sidebars.sidebar-calon-mahasiswa />
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        {{ $slot }}
    </div>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/date-picker.js') }}"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>
</body>

</html>
