<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('auth.partials._head')

<body class="bg-default">
    <div class="main-content">

        <!-- Header -->
        <div class="header bg-gradient-primary py-6 py-lg-8">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1 class="text-white">Bienvenido!</h1>
                            <p class="text-lead text-light">Tu salud es nuestra prioridad, proporcionando medicamentos de calidad a precios asequibles, entregados directamente a tu puerta</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div> --}}
        </div>

        <!-- Page content -->
        @yield('content')

        @include('auth.partials._footer')

    </div>

    @include('auth.partials._scripts')
    @yield('optional_scripts')

</body>

</html>
