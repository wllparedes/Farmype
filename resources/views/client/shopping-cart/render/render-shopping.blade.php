<div class="card-body container bg-list-productos">
    <div class="row">

        @php
            $quantityProducts = 0;
            $priceSubtotal = 0;
        @endphp
        @foreach ($inventoriesOnShopping as $inventoriesShopping)
            @php
                $user = $inventoriesShopping->user;
            @endphp
            @if ($inventoriesShopping->inventories->isEmpty())
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 d-flex flex-column">
                            <div class="container-empty">
                                <img class="image-empty" src="{{ asset('assets/img/theme/carro-vacio.png') }}"
                                    alt="">
                                <div class="container-note">
                                    <h3 class="col-12 text-start pl-0">Tu carro está vacío</h3>
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
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <p class="">Productos en tu carrito</p>

                    @foreach ($inventoriesShopping->inventories as $inventory)
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
                                        <p class="card-text text-small">
                                            <strong>{{ $inventory->user->names_surnames }}</strong>
                                        </p>
                                    </div>
                                    <div class="container-price">
                                        @if ($inventory->on_sale)
                                            @php

                                                if ($inventory->stock != 0) {
                                                    $priceSubtotal = $priceSubtotal + $inventory->discounted_price * $inventory->pivot->quantity;
                                                }

                                            @endphp
                                            <span
                                                class="badge badge-pill badge-sm badge-warning text-decoration-line-through">S/.
                                                {{ $inventory->price }}</span>
                                            <span
                                                class="badge badge-pill badge-sm badge-danger discount-value-selected">-%
                                                {{ $inventory->discount }}</span>
                                            <span class="badge badge-pill badge-sm badge-light">S/.
                                                {{ $inventory->discounted_price }}</span>
                                            <span class="btn btn-danger btn-sm span-on_sale-selected">OFERTA</span>
                                        @else
                                            <span class="badge badge-pill badge-sm badge-primary">S/.
                                                {{ $inventory->price }}</span>
                                            @php

                                                if ($inventory->stock != 0) {
                                                    $priceSubtotal = $priceSubtotal + $inventory->price * $inventory->pivot->quantity;
                                                }

                                            @endphp
                                        @endif
                                    </div>

                                    @if ($inventory->stock != 0)
                                        @php
                                            $quantityProducts++;
                                        @endphp
                                        <div class="container-cuantity">
                                            <div class="row-cuantity d-flex justify-content-between p-2">
                                                <button type="button" class="addCuantity btn btn-sm btn-default"
                                                    {{ whatIsTop($inventory->pivot->quantity) }}
                                                    data-add="{{ route('client.shopping.addCuantity', $inventory->id) }}">+</button>
                                                <span class="valueQuantity"> {{ $inventory->pivot->quantity }} </span>
                                                <button type="button" class="subtractCuantity btn btn-sm btn-default"
                                                    {{ whatIsBottom($inventory->pivot->quantity) }}
                                                    data-subtract="{{ route('client.shopping.subtractCuantity', $inventory->id) }}">-</button>
                                            </div>
                                            <p class="card-text text-center text-sm-center text-sm">Máx 10 unidades</p>
                                            <p class="text-small text-sm-success text-success">Stock Disponible:
                                                {{ $inventory->stock }}</p>
                                        </div>
                                    @else
                                        <div class="container-cuantity">
                                            <p class="card-text text-danger text-center text-sm">Producto sin stock</p>
                                            <button class="deleteProductOnList w-100 btn btn-sm btn-danger"
                                                data-delete-list="{{ route('client.selected-inventory.delete', $inventory->id) }}">
                                                Eliminar
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                @if ($inventory->stock != 0)
                                    <div class="dropdown" id="dropdown-three">
                                        <button class="btn btn-sm btn-icon-only bg-transparent text-light"
                                            href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="deleteProductOnShopping dropdown-item"
                                                data-delete-shopping="{{ route('client.shopping.delete', $inventory->id) }}">Eliminar
                                                del carrito</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-12 mb-4 justify-content-around ">
                            <div class="col-12">
                                <div class="action-buy">
                                    <a href="{{ route('client.products.index') }}"
                                        class="btn btn-sm btn-outline-primary">Seguir
                                        comprando</a>
                                    &nbsp;&nbsp;
                                    <a class="text-white btn btn-sm btn-warning emptyShoppingCart"
                                        data-empty="{{ route('client.shopping.emptyShoppingCart') }}">Vaciar
                                        carrito</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <p class="">Resumen de tu carrito</p>
                    <div class="row">
                        <div class="col-12 mb-4 justify-content-around">
                            <div class="col-12 container-product-items">
                                <div class="resumen-detalle">
                                    <h5>Productos: </h5>
                                    <h5>Subtotal:</h5>
                                </div>
                                <div class="resumen-precio">
                                    <h5>({{ $quantityProducts }})</h5>
                                    <h5>S/. {{ $priceSubtotal }}</h5>
                                </div>
                                <div class="address">
                                    <h5>Envío:</h5>
                                    {{-- * Direccion exacta --}}
                                    <p>{{ $user->address }}
                                        <br>
                                        {{-- * Direccion General --}}
                                        {{ Str::ucfirst($user->departament) . ', ' . Str::ucfirst($user->province) . ', ' . Str::ucfirst($user->district) . ', Perú.' }}
                                    </p>
                                    <a class="text-small" href="#">
                                        Cambiar dirección
                                    </a>
                                </div>
                                <div class="total">
                                    <h5>TOTAL: </h5>
                                    <h5>S/. {{ $priceSubtotal }}</h5>
                                </div>
                                <div class="buy-now">
                                    <a href="#" class="btn btn-md btn-danger">Continuar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
