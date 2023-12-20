<div class="card-body container bg-list-productos">
    <div class="row">
        @if ($ordersNotDelivered->isEmpty())
            <div class="col-12">
                <div class="row">
                    <div class="col-12 d-flex flex-column">
                        <div class="container-empty">
                            <img class="image-empty" src="{{ asset('assets/img/theme/history.png') }}" alt="">
                            <div class="container-note">
                                <h3 class="col-12 text-start pl-0">Historial de compras vacío</h3>
                                <p>¡Aprovecha! Tenemos miles de productos en oferta y oportunidades únicas.</p>
                            </div>
                        </div>
                        <a class="btn btn-outline-warning btn-md button-empty"
                            href="{{ route('client.getProductsOnSale') }}">
                            Ver ofertas
                        </a>
                    </div>
                </div>
            </div>
        @else
            <p class="col-12 d-flex justify-content-between">
                Compras que aun no han sido entregadas:
            </p>
            {{-- <div class="row col-md-12 col-sm-12"> --}}
            @foreach ($ordersNotDelivered as $order)
                {{-- <div class="row"> --}}
                <div class="col-sm-12 col-lg-6 col-md-12 mb-4 justify-content-around">
                    <div class="col-12 p-3 container-product-items">
                        <span class="badge badge-pill badge-success status-order">
                            <span class="text-lighter-success">Estado del pago: </span> <span
                                class="text-underline text-italic">{{ $order->status_payment == 'approved' ? 'Aprovado' : 'Pendiente' }}</span>
                        </span>
                        <div class="container-operation-number">
                            <span class="text-small">Número de operación</span>
                            <span class="text-underline text-small-light">
                                #{{ $order->operation_number }}
                            </span>
                        </div>
                        <div class="container-prices-order">
                            <p>
                                <span class="text-small">Subtotal</span>
                                <span class="text-small-light">S/. {{ $order->subtotal }}</span>
                            </p>
                            @if ($order->discountCoupion)
                                <p>
                                    <span class="text-small-light badge badge-pill badge-info">Cupón:
                                        {{ $order->discountCoupion->code }}</span>
                                    <span class="text-small-light badge badge-pill badge-danger">-%
                                        {{ $order->discountCoupion->discount }}</span>
                                </p>
                            @endif
                            <p class="mb-0">
                                <span class="text-small">Total:</span>
                                <span class="text-small-light">S/. {{ $order->total }}</span>
                            </p>
                            <p class="mb-0">
                                <span class="badge badge-warning">
                                    <span class="text-lighter-warning">Entrega: </span> <span class="text-underline text-italic"> {{ $order->status_delivery }} </span>
                                </span>
                            </p>
                        </div>
                        <span
                            class="badge badge-pill badge-default text-white badge- date-diff-humans">{{ dateDiffHumans($order->created_at) }}</span>
                        <p>
                            <a class="btn btn-sm btn-primary" href="{{ route('client.order.view', $order) }}">
                                Ver order de compra
                            </a>
                        </p>
                    </div>
                </div>
                {{-- </div> --}}
            @endforeach
            {{-- </div> --}}
        @endif

    </div>
</div>
