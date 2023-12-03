@extends('company.layouts.main')

@section('optional_links')

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    {{-- * reponsive --}}
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/Responsive-2.2.1/css/responsive.bootstrap4.min.css') }}">

@endsection

@section('title', 'Ordenes de ventas')

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="d-flex justify-content-between">
                    <div class="text-start">
                        <h1 class="text-white text-center">Ordenes de ventas realizadas</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- *** --}}

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
                                    <th>Número de operación</th>
                                    <th>Cliente</th>
                                    <th>Descuento</th>
                                    <th>Ganancia</th>
                                    <th>Hora</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('optional_scripts')
    <script src="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/company/sales/sales-datatable.js') }}" type="module"></script>

    {{-- * responsive --}}

    <script src="{{ asset('assets/js/plugins/datatables/Responsive-2.2.1/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/Responsive-2.2.1/js/responsive.bootstrap4.min.js') }}"></script>

@endsection
