<div class="card-body container bg-list-productos">
    <div class="row">

        @if ($orderDetail->isEmpty())
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
                Historial de compras:
            </p>
            {{-- <div class="row col-md-12 col-sm-12"> --}}
            @foreach ($orderDetail as $order)
                {{-- <div class="row"> --}}
                <div class="col-sm-12 col-lg-6 col-md-12 mb-4 justify-content-around">
                    <div class="col-12 p-3 container-product-items">
                        <span class="badge badge-pill badge-success status-order">
                            {{ $order->status }}
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
                                <span class="text-small-light">S/. {{ $order->total }}</span>
                            </p>
                            @if ($order->discountCoupion)
                                <p>
                                    <span class="text-small-light badge badge-pill badge-info">Cupón:
                                        {{ $order->discountCoupion->code }}</span>
                                    <span class="text-small-light badge badge-pill badge-danger">-%
                                        {{ $order->discountCoupion->discount }}</span>
                                </p>
                            @endif
                            @php
                                $total = $order->discountCoupion ? $order->total - ($order->total * $order->discountCoupion->discount) / 100 : $order->total;
                            @endphp
                            <p class="mb-0">
                                <span class="text-small">Total:</span>
                                <span class="text-small-light">S/. {{ $total }}</span>
                            </p>
                        </div>
                        <div class="container-products-order">
                            <span class="text-small mb-2">Productos:</span>
                            <ul class="mb-0">
                                @foreach ($order->inventories as $inventory)
                                    <li>
                                        <p class="text-small-light">
                                            <span> {{ $inventory->product->name }} </span>
                                            <span> ({{ $inventory->pivot->quantity }}) - </span>
                                            <span> {{ $inventory->user->names_surnames }} </span>
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- <div class="container-date-order">
                            <span class="text-small">{{ dateFormal($order->created_at) }}</span>
                        </div> --}}
                        <span
                            class="badge badge-pill badge-warning date-diff-humans">{{ dateDiffHumans($order->created_at) }}</span>
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

<div class="card-footer">
    {{ $orderDetail->links() }}
</div>
