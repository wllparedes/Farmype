@extends('admin.layouts.main')

@section('title', 'Registro - Admin')

@section('optional_links')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/select2.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/js/plugins/Choices/choices.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/virtual-select/virtual-select.min.css') }}">
@endsection

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="d-flex justify-content-between ">
                    <div class="col-sm-12 col-lg-6 col-md-12">
                        <h1 class="text-white text-start">Registro de Productos y categorias</h1>
                    </div>
                    <div class="col-sm-12 col-lg-6 col-md-12 text-end">
                        <button type="button" class="btn btn-default" data-toggle="modal"
                            data-target="#createCategoryModal">
                            Crear Categoria
                        </button>
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
                    <div class="card-body row">
                        {{-- * Formulario productos --}}
                        <form id="registerProductForm" class="col-12 form-inputs"
                            action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Información del producto</h6>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">Nombre del producto
                                            *</label>
                                        <input type="text" id="input-name" name="name"
                                            class="form-control form-control-alternative input-reset"
                                            placeholder="Ingresa el nombre del producto" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="select-parent-category">Categoria Principal
                                            *</label>
                                        <div class="input-group-alternative mb-3" id="group-parent-category"
                                            data-url-child="{{ route('admin.products.getChildCategories') }}"
                                            data-url-parent="{{ route('admin.products.getParentCategories') }}">
                                            {{-- <select  id="select-parent-category" class="form-control input-form-class"
                                                name="parentCategoryId">
                                            </select> --}}
                                            <div class="form-control input-form-class" id="select-parent-category"
                                                name="parentCategoryId">
                                                {{-- * SELECT CATEGORY PARENT --}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="select-child-category" class="form-control-label">Sub categoria
                                            *</label>
                                        <div class="input-group-alternative mb-3 render-childCategory"
                                            id="group-child-category">
                                            <div id="select-child-category"
                                                class="form-control js-example-basic-single input-form-class" name="child_category_id">
                                                {{-- * SELECT CATEGORY CHILDS --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Imagen * </label>
                                        <div class="square-img-input-container">
                                            <div id="image-preview" class="image-preview">
                                                <label class="form-control-label" for="image-upload" id="image-label">Subir
                                                    Imagen</label>
                                                <input type="file" name="image" id="input-product-image-store"
                                                    data-value="" class="">
                                                <div id="img-holder" class="img-holder img-cover">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-detail">Detalle (opcional)</label>
                                        <textarea type="text" id="input-detail" name="detail" class="form-control form-control-alternative input-reset"
                                            placeholder="Ingresa el detalle" rows="11"></textarea>
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

    @include('admin.products.modal.create-category')

@endsection

@section('optional_scripts')
    <script src="{{ asset('assets/js/plugins/jquery-validator/jQueryValidator.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/plugins/select2/select2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/plugins/Choices/choices.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugins/virtual-select/virtual-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/global/validatorMessages.js') }}"></script>


    <script src="{{ asset('assets/js/admin/products/validatorProduct.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/admin/products/validatorCategory.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/admin/products/createCategory.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/admin/products/handleParentSelect.js') }}" type="module"></script>
@endsection
