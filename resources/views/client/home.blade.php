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
                <div class="row">
                    <div class="swiper swiper-client">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                            </div>
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                            </div>
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                            </div>
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                            </div>
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                            </div>
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
                            </div>
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
                            </div>
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
                            </div>
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-pagination"></div>
                    </div>
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
                <div class="div-image-category">
                    <img src="{{ asset('assets/img/gifs/food.gif') }}" alt="">
                </div>
                <h4 class="text-center">Nutrición</h4>
            </div>
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <div class="div-image-category">
                    <img src="{{ asset('assets/img/gifs/belleza.gif') }}" alt="">
                </div>
                <h4 class="text-center">Belleza</h4>
            </div>
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <div class="div-image-category">
                    <img src="{{ asset('assets/img/gifs/cuidado-personal.gif') }}" alt="">
                </div>
                <h4 class="text-center">Cuidado personal</h4>
            </div>
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <div class="div-image-category">
                    <img src="{{ asset('assets/img/gifs/dispo-medico.gif') }}" alt="">
                </div>
                <h4 class="text-center">Dispositivos Medicos</h4>
            </div>
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <div class="div-image-category">
                    <img src="{{ asset('assets/img/gifs/mom-feeding-baby.gif') }}" alt="">
                </div>
                <h4 class="text-center">Mamá y bebe</h4>
            </div>
            <div class="col-md-3 col-sm-4 col-lg-2 div-container-category">
                <div class="div-image-category">
                    <img src="{{ asset('assets/img/gifs/old-person.gif') }}" alt="">
                </div>
                <h4 class="text-center">Adulto mayor</h4>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 pb-3 mb-3">
                <h1 class="text-center">Novedades</h1>
            </div>
        </div>
        <div class="row container-items-category justify-content-center">
            <div class="col-md-4 col-sm-6 col-lg-2 div-container-category">
                <div class="div-image-category">
                    <img src="{{ asset('assets/img/gifs/on-sale.gif') }}" alt="">
                </div>
                <h4 class="text-center">Ofertas</h4>
            </div>
            <div class="col-md-4 col-sm-6 col-lg-2 div-container-category">
                <div class="div-image-category">
                    <img src="{{ asset('assets/img/gifs/list.gif') }}" alt="">
                </div>
                <h4 class="text-center">Todos</h4>
            </div>
        </div>
    </div>
@endsection

@section('optional_scripts')

    <script src="{{ asset('assets/js/plugins/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/client/inicio/swiper-client.js') }}"></script>

@endsection
