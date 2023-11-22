@extends('client.layouts.main')

@section('title', 'Inicio')

@section('optional_links')

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/swiper/swiper-bundle.min.css') }}">

@endsection

@section('content')
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="col-12">
                    {{-- <img alt="" src="{{ asset('assets/img/gifs/farma.png') }}" width="100" > --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            {{-- !!! --}}
            <div class="col-12 p-3 m-3">
                <h1 class="text-white text-center">Categorias</h1>
            </div>
        </div>
        <div class="row container-items-category justify-content-center">
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <a href="{{ route('client.getProductsNutrition') }}">
                    <div class="div-image-category">
                        <img src="{{ asset('assets/img/gifs/food.gif') }}" alt="">
                    </div>
                    <h4 class="text-center">Nutrición</h4>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <a href="{{ route('client.getProductsBeauty') }}">
                    <div class="div-image-category">
                        <img src="{{ asset('assets/img/gifs/belleza.gif') }}" alt="">
                    </div>
                    <h4 class="text-center">Belleza</h4>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <a href="{{ route('client.getProductsPersonalCare') }}">
                    <div class="div-image-category">
                        <img src="{{ asset('assets/img/gifs/cuidado-personal.gif') }}" alt="">
                    </div>
                    <h4 class="text-center">Cuidado personal</h4>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <a href="{{ route('client.getProductsMedicalDevices') }}">
                    <div class="div-image-category">
                        <img src="{{ asset('assets/img/gifs/dispo-medico.gif') }}" alt="">
                    </div>
                    <h4 class="text-center">Dispositivos Medicos</h4>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <a href="{{ route('client.getProductsMomBaby') }}">
                    <div class="div-image-category">
                        <img src="{{ asset('assets/img/gifs/mom-feeding-baby.gif') }}" alt="">
                    </div>
                    <h4 class="text-center">Mamá y bebe</h4>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <a href="{{ route('client.getProductsOlderAdult') }}">
                    <div class="div-image-category">
                        <img src="{{ asset('assets/img/gifs/old-person.gif') }}" alt="">
                    </div>
                    <h4 class="text-center">Adulto mayor</h4>
                </a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 pb-3 mb-3">
                <h1 class="text-center">Novedades</h1>
            </div>
        </div>
        <div class="row container-items-category justify-content-center">
            <div class="col-md-4 col-sm-6 col-lg-2 div-container-category">
                <a href="">
                    <div class="div-image-category">
                        <img src="{{ asset('assets/img/gifs/on-sale.gif') }}" alt="">
                    </div>
                    <h4 class="text-center">Ofertas</h4>
                </a>
            </div>
            <div class="col-md-4 col-sm-6 col-lg-2 div-container-category">
                <a href="{{ route('client.products.index') }}">
                    <div class="div-image-category">
                        <img src="{{ asset('assets/img/gifs/list.gif') }}" alt="">
                    </div>
                    <h4 class="text-center">Todos</h4>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('optional_scripts')

    <script src="{{ asset('assets/js/plugins/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/client/inicio/swiper-client.js') }}"></script>

@endsection
