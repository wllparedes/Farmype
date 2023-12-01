@extends('client.layouts.main')

@section('title', 'Carrito de compras')


@section('optional_links')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.css') }}">
    <link rel="stylesheet" src="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}">
@endsection
@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-2 col-lg-6">
                        <h1 class="text-white text-center">Carrito</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow" id="productData" data-url="{{ route('client.shopping.index') }}">
                    @include('client.shopping-cart.render.render-shopping')
                </div>
            </div>
        </div>
    </div>


    @include('client.shopping-cart.modal.discount')

@endsection



@section('optional_scripts')
    <script src="{{ asset('assets/js/global/csrfToken.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/js/all.min.js') }}"></script>

    <script src="{{ asset('assets/js/client/shopping/emptyShoppingCart.js') }}" type="module"></script>

    <script src="{{ asset('assets/js/client/shopping/addCuantityProduct.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/client/shopping/subtractCuantityProduct.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/client/shopping/deleteProductOnShopping.js') }}" type="module"></script>
    {{-- carrito --}}
    <script src="{{ asset('assets/js/client/shopping/verifyCupon.js') }}" type="module"></script>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
            locale: 'es-AR'
        });
        mp.checkout({
            preference: {
                id: "{{ $preference->id }}"
            },
            render: {
                container: '.mercadopago-button',
                label: 'Pagar',
            }
        });
    </script>
    <script src="{{ asset('assets/js/client/shopping/deleteDiscountCoupion.js') }}" type="module"></script>
@endsection
