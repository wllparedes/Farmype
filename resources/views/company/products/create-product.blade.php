@extends('company.layouts.main')

@section('title', 'Registro de productos')

@section('optional_links')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/select2.min.css') }}">
@endsection

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <h1 class="text-white text-center">Registro de Productos</h1>
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
                        <form id="registerProductForm" class="form-inputs" action="{{ route('company.product.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Información del producto</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-name">Nombre del producto
                                                *</label>
                                            <input type="text" id="input-name" name="name"
                                                class="form-control form-control-alternative input-reset"
                                                placeholder="Ingresa el nombre del producto" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="select-product-type">Tipo de producto *</label>
                                            <div class="input-group input-group-alternative mb-3">
                                                <select id="select-product-type"
                                                    class="form-control js-example-basic-single input-form-class"
                                                    name="product_type">
                                                    <option></option>
                                                    @foreach ($productTypes as $key => $type)
                                                        <option value="{{ $key }}"> {{ $type }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-stock">Stock *</label>
                                            <input type="number" id="input-stock" name="stock"
                                                class="form-control form-control-alternative input-reset"
                                                placeholder="Ingresa el stock" autocomplete="off" min="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-price">Precio *</label>
                                            <input type="number" id="input-price" name="price"
                                                class="form-control form-control-alternative input-reset"
                                                placeholder="Ingresa el precio" min="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-detail">Detalle (opcional)</label>
                                            <input type="text" id="input-detail" name="detail"
                                                class="form-control form-control-alternative input-reset"
                                                placeholder="Ingresa el detalle">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Imagen * </label>
                                            <div class="square-img-input-container">
                                                <div id="image-preview" class="image-preview">
                                                    <label class="form-control-label" for="image-upload" id="image-label">Subir Imagen</label>
                                                    <input type="file" name="image" id="input-product-image-store"
                                                        data-value="" class="">
                                                    <div id="img-holder" class="img-holder img-cover">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4 btn-save">Guardar producto</button>
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
    <script src="{{ asset('assets/js/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/global/validatorMessages.js') }}"></script>
    <script src="{{ asset('assets/js/company/products/validatorProduct.js') }}" type="module"></script>
@endsection
