@extends('client.layouts.main')

@section('title', 'Orden de compra')

@section('optional_scripts')

@endsection

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <h1 class="text-white text-center">Detalle de tu orden de compra</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    @include('client.order.render.order')
                </div>
            </div>
        </div>

    </div>

@endsection


@section('optional_links')

@endsection
