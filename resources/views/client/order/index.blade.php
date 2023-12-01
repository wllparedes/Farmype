@extends('client.layouts.main')

@section('title', 'Ordenes de compras')

@section('optional_links')

@endsection

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-4 col-lg-6">
                        <h1 class="text-white text-center">Historial de compras</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow" id="productData" data-url="{{ route('client.order.index') }}">
                    @include('client.order.render.orders')
                </div>
            </div>
        </div>

    </div>



@endsection

@section('optional_scripts')
    <script src="{{ asset('assets/js/client/order/renderOrdersMain.js') }}"></script>
@endsection
