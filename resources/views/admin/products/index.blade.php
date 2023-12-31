@extends('admin.layouts.main')

@section('title', 'Productos registrados - Admin')

@section('optional_links')

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.css') }}">

@endsection

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <h1 class="text-white text-center">Productos registrados</h1>
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
                    @include('admin.products.render.query-products')
                </div>
            </div>
        </div>
    </div>

    @include('admin.products.modal.modal-edit')

@endsection

@section('optional_scripts')
    {{--* Plugins --}}
    <script src="{{ asset('assets/js/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validator/jQueryValidator.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.js') }}"></script>
    <script src="{{ asset('assets/js/global/csrfToken.js') }}"></script>
    {{--* Necesarios --}}



    <script src="{{ asset('assets/js/global/validatorMessages.js') }}"></script>
    <script src="{{ asset('assets/js/admin/products/editProduct.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/admin/products/deleteProduct.js') }}" type="module"></script>

    <script src="{{ asset('assets/js/admin/products/editValidatorProduct.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/global/renderProductsNext.js') }}" type="module"></script>

{{--
    <script src="{{ asset('assets/js/global/chekedDiscount.js') }}"></script> --}}
@endsection
