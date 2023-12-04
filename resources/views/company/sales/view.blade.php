@extends('company.layouts.main')

@section('title', 'Detalle de orden de venta')

@section('optional_links')

@endsection

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="d-flex justify-content-between">
                    <div class="text-start">
                        <h1 class="text-white text-center">Detalle de la venta</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow" id="productData">

                    <div class="card-body">
                        <p>* INFORMACIÓN DE LA VENTA</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-stock">ID Venta</label>
                                    <input type="text" class="form-control form-control-alternative input-reset" disabled
                                        value="{{ $sale->id }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="operation_number">Número de operación</label>
                                    <input type="text" id="operation_number" name="operation_number"
                                        class="form-control form-control-alternative input-reset" disabled
                                        value="{{ $sale->operation_number_sale }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="ganancia">Ganancia</label>
                                    <input type="text" id="ganancia" name="ganancia"
                                        class="form-control form-control-alternative input-reset" disabled
                                        value="S/. {{ $sale->total }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="time">Hora</label>
                                    <input type="text" id="time" name="time"
                                        class="form-control form-control-alternative input-reset" disabled
                                        value="{{ timeFormal($sale->created_at) }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="date">Fecha</label>
                                    <input type="text" id="date" name="date"
                                        class="form-control form-control-alternative input-reset" disabled
                                        value="{{ dateFormal($sale->created_at) }}">
                                </div>
                            </div>
                        </div>
                        <p>* INFORMACIÓN DEL CLIENTE</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="id-user">ID Usuario</label>
                                    <input id="id-user" type="text"
                                        class="form-control form-control-alternative input-reset" disabled
                                        value="{{ $sale->client->id }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="client-namesSurnames">Nombres y apellidos</label>
                                    <input type="text" id="client-namesSurnames" name="client-namesSurnames"
                                        class="form-control form-control-alternative input-reset" disabled
                                        value="{{ $sale->client->names_surnames }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="client-phone">Telefono</label>
                                    <input type="text" id="client-phone" name="client-phone"
                                        class="form-control form-control-alternative input-reset" disabled
                                        value="{{ $sale->client->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="client-email">Email</label>
                                    <input id="client-email" name="client-email" type="text"
                                        class="form-control form-control-alternative input-reset" disabled
                                        value="{{ $sale->client->email }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="client-address">Dirección</label>
                                    <input type="text" id="client-address" name="client-address"
                                        class="form-control form-control-alternative input-reset" disabled
                                        value="{{ $sale->client->address }}">
                                </div>
                            </div>
                        </div>

                        <p>* INFORMACIÓN DE LOS PRODUCTOS</p>
                        {{-- * tabla productos --}}
                        <div class="row">
                            <div class="col">
                                <div class="card shadow">
                                    <div class="table-responsive">

                                        <table id="" class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Detalle</th>
                                                    <th>Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sale->inventories as $inventory)
                                                    <tr>
                                                        <td>{{ $inventory->id }}</td>
                                                        <td>{{ $inventory->product->name }}</td>
                                                        <td>{{ $inventory->product->detail ? $inventory->product->detail : 'Sin detalle.' }}
                                                        </td>
                                                        <td>{{ $inventory->pivot->quantity }} ud.</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('optional_scripts')

@endsection
