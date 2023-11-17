@extends('client.layouts.main')

@section('title', 'Lista de productos seleccionados')

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
                        <h1 class="text-white text-center">Lista de productos seleccionados</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow" id="productData" data-url="{{ route('client.selected-products.index') }}">
                    @include('client.products.render.list-selected-products')
                </div>
            </div>
        </div>
    </div>


@endsection



@section('optional_scripts')
    <script src="{{ asset('assets/js/global/csrfToken.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.js') }}"></script>
    <script src="{{ asset('assets/js/client/productsOnList/renderProductsOnList.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/client/productsOnList/addCuantityProduct.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/client/productsOnList/subtractCuantityProduct.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/client/productsOnList/deleteProductOnListMain.js') }}" type="module"></script>
    {{-- <script src="{{ asset('assets/js/client/products/validateQuantity.js') }}"></script> --}}

@endsection
