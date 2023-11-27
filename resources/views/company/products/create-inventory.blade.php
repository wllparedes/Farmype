@extends('company.layouts.main')

@section('title', 'Registro de Inventario')

@section('optional_links')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/select2.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/Choices/choices.min.css') }}">
@endsection

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <h1 class="text-white text-center">Registro de Inventario</h1>
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
                <div class="card shadow">
                    <div class="card-body">
                        <form id="registerProductForm" class="form-inputs" action="{{ route('company.inventory.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Información del inventario</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Producto *</label>
                                            <div class="input-group-alternative mb-3" id="select-product-c" data-get="{{ route('admin.inventory.getProductsForSelect') }}">
                                                <select name="product_id" id="select-product"
                                                    class="form-control js-example-basic-single input-form-class">
                                                    <option selected disabled value="">Seleccionar producto </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-stock">Stock *</label>
                                            <input type="number" id="input-stock" name="stock"
                                                class="form-control form-control-alternative input-reset"
                                                placeholder="Ingresa el stock" autocomplete="off" min="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-price">Precio *</label>
                                            <input type="number" id="input-price" name="price"
                                                class="form-control form-control-alternative input-reset"
                                                placeholder="Ingresa el precio" min="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Poner en oferta (opcional) </label>
                                            <div class="input-group input-group-alternative mb-3">
                                                <label class="custom-toggle" id="toggle">
                                                    <input type="checkbox" name="on_sale">
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                        data-label-on="Yes"></span>
                                                </label>
                                            </div>
                                            <div class="div discount-value" id="discount-value">
                                                <label class="form-control-label" for="input-discount">% de descuento
                                                    *</label>
                                                <input type="number" id="input-discount" name="discount"
                                                    class="form-control form-control-alternative input-reset"
                                                    placeholder="Ingrese el % de descuento" autocomplete="off"
                                                    min="1" max="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4 btn-save">Guardar inventario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('optional_scripts')
    <script src="{{ asset('assets/js/plugins/jquery-validator/jQueryValidator.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/js/plugins/select2/select2.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugins/Choices/choices.min.js') }}"></script>

    <script src="{{ asset('assets/js/global/validatorMessages.js') }}"></script>
    <script src="{{ asset('assets/js/company/products/validatorProduct.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/global/chekedDiscount.js') }}"></script>

@endsection
