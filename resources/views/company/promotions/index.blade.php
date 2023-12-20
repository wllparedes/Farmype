@extends('company.layouts.main')

@section('title', 'Promociones')

@section('optional_links')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/virtual-select/virtual-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datepicker-master/css/datepicker.minimal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datepicker-master/css/datepicker.material.css') }}">
@endsection

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="d-flex justify-content-between">
                    <div class="text-start">
                        <h1 class="text-white text-center">Promociones creadas</h1>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-default" data-toggle="modal" data-target="#createPromotionModal">
                            Agregar promoción
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                    </div>
                    <div class="table-responsive">

                        <table id="sales-table" class="table align-items-center table-flush"
                            data-url="{{ route('company.sales.index') }}">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Número de promoción</th>
                                    <th>Precio</th>
                                    <th>Fecha de incio</th>
                                    <th>Fecha de finalización</th>
                                    <th>Productos</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('company.promotions.modals.create-promotion')

@endsection

@section('optional_scripts')

    <script src="{{ asset('assets/js/plugins/jquery-validator/jQueryValidator.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/virtual-select/virtual-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datepicker-master/datepicker.js') }}"></script>


    <script src="{{ asset('assets/js/global/validatorMessages.js') }}"></script>
    <script src="{{ asset('assets/js/company/promotion/selectProducts.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/company/promotion/validatorPromotion.js') }}" type="module"></script>

@endsection
