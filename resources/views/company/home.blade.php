@extends('company.layouts.main')

@section('content')
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">P. vendidos</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $countInventoriesSales }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Desde el mes pasado</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Cupones usandos</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $discountCoupions }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                    <span class="text-nowrap">Desde el mes pasado</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Ventas realizadas</h5>
                                        <span class="h2 font-weight-bold mb-0"> {{ $sales }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                    <span class="text-nowrap">Desde ayer</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Ventas</h5>
                                        <span class="h2 font-weight-bold mb-0">S/. {{ $salesMoney }} </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span class="text-nowrap">Desde el mes pasado</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Visión general</h6>
                                <h2 class="text-white mb-0">Valor de ventas</h2>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-sales" data-url="{{ route('company.home.getSalesMoney') }}"
                                class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Rendimiento</h6>
                                <h2 class="mb-0">Ventas por mes</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <canvas id="chart-orders" data-url="{{ route('company.home.getSalesCount') }}"
                                class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            {{-- * Productos más vendidos --}}
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Productos más vendidos</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre del Producto</th>
                                    <th scope="col">Veces comprados</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topSellingData as $productName => $quantity)
                                    <tr>
                                        <th scope="row">
                                            {{ $productName }}
                                        </th>
                                        <td>
                                            {{ $quantity }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('optional_scripts')
    <script src="{{ asset('assets/js/company/home/chart-salesForMonth.js') }}"></script>
    <script src="{{ asset('assets/js/company/home/chart-salesMoney.js') }}"></script>
@endsection


{{-- <div class="col-xl-8 mb-5 mb-xl-0">
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Vistas de la página</h3>
                </div>
                <div class="col text-right">
                    <a href="#!" class="btn btn-sm btn-primary">Ver todo</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre de página</th>
                        <th scope="col">Visitantes</th>
                        <th scope="col">Usuarios unicos</th>
                        <th scope="col">Tasa de rebote</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            /adp/
                        </th>
                        <td>
                            4,569
                        </td>
                        <td>
                            340
                        </td>
                        <td>
                            <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            /adp/index.html
                        </th>
                        <td>
                            3,985
                        </td>
                        <td>
                            319
                        </td>
                        <td>
                            <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            /adp/charts.html
                        </th>
                        <td>
                            3,513
                        </td>
                        <td>
                            294
                        </td>
                        <td>
                            <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            /adp/tables.html
                        </th>
                        <td>
                            2,050
                        </td>
                        <td>
                            147
                        </td>
                        <td>
                            <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            /adp/profile.html
                        </th>
                        <td>
                            1,795
                        </td>
                        <td>
                            190
                        </td>
                        <td>
                            <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
