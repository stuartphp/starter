<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title') @yield('title') | @endif
        {{ config('app.name') }}
    </title>

    <livewire:styles/>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="icon" href="{{ mix('images/icon-fav.png') }}">
    <link rel="apple-touch-icon" href="{{ mix('images/icon-touch.png') }}">
    <link rel="manifest" href="{{ mix('json/manifest.json') }}">
</head>
<body class="d-flex flex-column bg-light h-100">
    <livewire:layouts.nav/>

    <main class="flex-shrink-0">
        {{ $slot }}
    </main>

    <livewire:layouts.footer/>

    <livewire:loader/>
    <livewire:modals/>
    <livewire:scripts/>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 2500,
            timerProgressBar:true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        window.addEventListener('alert',({detail:{type,message}})=>{
            Toast.fire({
                icon:type,
                title:message
            })
        })
    </script>
</body>
</html>
