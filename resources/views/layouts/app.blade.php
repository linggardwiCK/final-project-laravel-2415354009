<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')
</head>

<body>

    <div class="dashboard">

        {{-- Sidebar --}}
        @include('components.sidebar')

        {{-- Main --}}
        <div class="main-content">

            {{-- Navbar --}}
            @include('components.navbar')

            {{-- Content --}}
            <div class="content-area">
                @yield('content')
            </div>

        </div>

    </div>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JS --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('toast_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('toast_success') }}',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('toast_error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ session('toast_error') }}',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

</body>

</html>
