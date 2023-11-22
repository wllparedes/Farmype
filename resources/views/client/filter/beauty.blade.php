@extends('client.layouts.main')

@section('title', 'Productos - Belleza')

@section('optional_links')

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.css') }}">

@endsection

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <h1 class="text-white text-center">Belleza</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- * -->

    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow" id="productData">


                    {{-- ! --}}

                    <div class="card-body">
                        <div class="row container-products">
                            @if ($productBeauties->isEmpty())
                                <h3 class="col-12 text-center">No hay productos en esta categoria</h3>
                            @else
                                @foreach ($productBeauties as $productBeauty)
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="container-image">
                                                    <img class="card-img-top" src="{{ verifyImage($productBeauty->file) }}"
                                                        alt="{{ $productBeauty->name }}">
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">{{ $productBeauty->name }}</h4>
                                                <p class="card-text product-description">
                                                    {{ $productBeauty->detail ? $productBeauty->detail : 'Sin detalle.' }}
                                                </p>
                                                <a class="btn btn-primary"
                                                    href="{{ route('client.product.view', $productBeauty->id) }}">Ver
                                                    más</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        {{ $productBeauties->links() }}
                    </div>

                    <div class="row col-12">
                        <div class="col-12 p-4">
                            <a class="btn btn-default" href="{{ route('clients.home') }}">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>


                    {{-- ! --}}



                </div>
            </div>
        </div>
    </div>

@endsection

@section('optional_scripts')
    {{-- * Plugins --}}
    <script src="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/global/csrfToken.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.js') }}"></script>
    {{-- * Necesarios --}}
    <script src="{{ asset('assets/js/global/renderProductsNext.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/client/products/addProductOnList.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/client/products/deleteProductOnList.js') }}" type="module"></script>

@endsection
