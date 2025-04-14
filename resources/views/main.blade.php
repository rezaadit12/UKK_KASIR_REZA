<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <title>@yield('title')</title>
    @include('layout.include-header')
</head>

<body class="sb-nav-fixed">
    @include('layout.top-nav')

    <div id="layoutSidenav">
        @include('layout.side-nav') {{-- Hanya isinya: layoutSidenav_nav --}}

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @if ($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong>Terjadi kesalahan!</strong> Silakan periksa kembali inputan kamu.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @yield('content')
                </div>
            </main>
            @include('layout.footer')
        </div>
    </div>
    @include('layout.include-footer')
    @include('include.modal')
    @stack('script')
</body>

</html>
