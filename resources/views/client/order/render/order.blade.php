<div class="card-body container bg-list-productos">
    <div class="row">

        @if ($orderDetail->inventories->isEmpty())
            <div class="col-12">
                <div class="row">
                    <div class="col-12 d-flex flex-column">
                        <div class="container-empty">
                            <img class="image-empty" src="{{ asset('assets/img/theme/error.png') }}" alt="">
                            <div class="container-note">
                                <h3 class="col-12 text-start pl-0">Oops...</h3>
                                <p>Ha ocurrido un error, vuelva más tarde.</p>
                            </div>
                        </div>
                        <a class="btn btn-outline-warning btn-md button-empty" href="{{ route('client.order.index') }}">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="col-lg-8 col-md-12 col-sm-12">
                <p class="d-flex justify-content-between">
                    Productos de tu orden de compra: <span
                        class=" text-underline">#{{ $orderDetail->operation_number }}</span>
                </p>
                @php
                    $cuantityInventories = 0;
                @endphp

                @foreach ($orderDetail->inventories as $inventory)
                    @php
                        $cuantityInventories++;
                    @endphp
                    <div class="row">
                        <div class="col-12 mb-4 justify-content-around">
                            <div class="col-12 container-product-items">
                                <div class="container-list-img">
                                    <img src="{{ verifyImage($inventory->product->file) }}"
                                        alt="{{ $inventory->product->name }}">
                                </div>
                                <div class="container-description">
                                    <h4 class="card-title"> {{ $inventory->product->name }} </h4>
                                    <p class="card-text">
                                        {{ $inventory->product->detail ? $inventory->detail : 'Sin detalle.' }}
                                    </p>
                                </div>
                                <div class="container-price">
                                    <p class="card-text text-small">
                                        <strong>{{ $inventory->user->names_surnames }}</strong>
                                    </p>
                                    <p class=" card-text text-small">
                                        {{ $inventory->user->email }}
                                    </p>
                                    <p class=" card-text text-small">
                                        # - {{ $inventory->user->phone }}
                                    </p>
                                </div>

                                <div class="container-cuantity">
                                    <div class="row-cuantity d-flex justify-content-between p-2">
                                        @if ($inventory->on_sale)
                                            <span
                                                class="badge badge-pill badge-sm badge-warning text-decoration-line-through">S/.
                                                {{ $inventory->price }}</span>
                                            <span class="badge badge-pill badge-sm badge-light">S/.
                                                {{ $inventory->discounted_price }}</span>
                                        @else
                                            <span class="badge badge-pill badge-sm badge-primary">S/.
                                                {{ $inventory->price }}</span>
                                        @endif
                                    </div>
                                    <p>
                                        <span class="valueQuantity text-small ">Unidades:
                                            {{ $inventory->pivot->quantity }} </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <p class="">
                    Resumen de tu orden de compra
                </p>
                <div class="row">
                    <div class="col-12 mb-4 justify-content-around">
                        <div class="col-12 container-product-items">
                            <div class="resumen-detalle">
                                <h5>Productos: </h5>
                                <h5>Subtotal:</h5>
                            </div>
                            <div class="resumen-precio">
                                <h5>({{ $cuantityInventories }})</h5>
                                <h5>S/. {{ $orderDetail->subtotal }}</h5>
                            </div>
                            <div class="address">
                                <h5>Envío:</h5>
                                {{-- * Direccion exacta --}}
                                <p> {{ $orderDetail->user->address }}
                                    <br>
                                    {{-- * Direccion General --}}
                                    {{ Str::ucfirst($orderDetail->user->departament) . ', ' . Str::ucfirst($orderDetail->user->province) . ', ' . Str::ucfirst($orderDetail->user->district) . ', Perú.' }}
                                </p>
                            </div>
                            <div class="total">
                                <h5>TOTAL: </h5>
                                @if ($orderDetail->discountCoupion)
                                    <div class="container-discount">
                                        <span class="badge badge-primary badge-md">
                                            CUPÓN: {{ Str::upper($orderDetail->discountCoupion->code) }}
                                        </span>
                                        <span class="badge badge-warning">-%
                                            {{ $orderDetail->discountCoupion->discount }}
                                        </span>
                                        <span class="badge badge-success badge-lg">Precio final: S/.
                                            {{ $orderDetail->total }}
                                        </span>
                                    </div>
                                @else
                                    <h5>{{ $orderDetail->total }}</h5>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
