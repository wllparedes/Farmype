<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('home.partials._head')

<body class="">


    @include('home.partials._sidebar')


    <div class="main-content">
        <!-- Navbar -->
        @include('home.partials._navbar')
        <!-- End Navbar -->

        @yield('content')

        <!-- Footer -->
        @include('home.partials._footer')
    </div>
    <!--   Core   -->
    @include('home.partials._scripts')
    @yield('optional_scripts')
</body>

</html>
