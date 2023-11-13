<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials._head')

<body class="">


    @include('client.partials._sidebar')


    <div class="main-content">
        <!-- Navbar -->
        @include('client.partials._navbar')
        <!-- End Navbar -->

        @yield('content')

        <!-- Footer -->
        @include('partials._footer')
    </div>
    <!--   Core   -->
    @include('partials._scripts')
    @yield('optional_scripts')
</body>

</html>
