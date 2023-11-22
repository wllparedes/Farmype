<div class="card-body row bg-list-productos">
    <div class="row col-lg-8 col-md-12 col-sm-12 d-flex justify-content-around">
        {{-- <div class="container-products row col-lg-8 col-md-12 col-sm-12"> --}}
        <p class="col-12">Productos</p>

        @php
            $quantityProducts = 0;
            $priceSubtotal = 0;
        @endphp

        @foreach ($productsOnList as $productList)
            @if ($productList->inventories->isEmpty())
                <h3 class="col-12 text-center">No hay productos registrados</h3>
            @else
                @foreach ($productList->inventories as $inventory)
                    <div class="col-12 mb-4 justify-content-around column-product-list">
                        <div class="col-12 container-product-items">
                            <div class="container-list-img">
                                <img src="{{ verifyImage($inventory->product->file) }}" alt="{{ $inventory->product->name }}">
                            </div>
                            <div class="container-description">
                                <h4 class="card-title"> {{ $inventory->product->name }} </h4>
                                <p class="card-text"> {{ $inventory->product->detail ? $inventory->detail : 'Sin detalle.' }}
                                </p>
                            </div>
                            <div class="container-price">
                                @if ($inventory->on_sale)
                                    @php

                                        if ($inventory->stock != 0) {
                                            $priceSubtotal = $priceSubtotal + ($inventory->discounted_price * $inventory->pivot->quantity);
                                        }

                                    @endphp
                                    <span
                                        class="badge badge-pill badge-sm badge-success text-decoration-line-through">S/.
                                        {{ $inventory->price }}</span>
                                    <span class="badge badge-pill badge-sm badge-danger discount-value-selected">-%
                                        {{ $inventory->discount }}</span>
                                    <span class="badge badge-pill badge-sm badge-light">S/.
                                        {{ $inventory->discounted_price }}</span>
                                    <span class="btn btn-danger btn-sm span-on_sale-selected">OFERTA</span>
                                @else
                                    <span class="badge badge-pill badge-sm badge-primary">S/.
                                        {{ $inventory->price }}</span>
                                    @php

                                        if ($inventory->stock != 0) {
                                            $priceSubtotal = $priceSubtotal + ($inventory->price * $inventory->pivot->quantity);
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
                                            data-add="{{ route('client.selected-products.addCuantity', $inventory->id) }}">+</button>
                                        <span class="valueQuantity"> {{ $inventory->pivot->quantity }} </span>
                                        <button type="button" class="subtractCuantity btn btn-sm btn-default"
                                            {{ whatIsBottom($inventory->pivot->quantity) }}
                                            data-subtract="{{ route('client.selected-products.subtractCuantity', $inventory->id) }}">-</button>
                                    </div>
                                    <p class="card-text text-center text-sm-center text-sm">Máx 10 unidades</p>
                                </div>
                            @else
                                <div class="container-cuantity">
                                    <p class="card-text text-danger text-center text-sm-center text-sm">Producto sin
                                        stock.</p>
                                    <button class="deleteProductOnList btn btn-sm btn-danger"
                                        data-delete-list="{{ route('client.selected-inventory.delete', $inventory->id) }}">
                                        Eliminar de la lista
                                    </button>
                                </div>
                            @endif
                        </div>

                        @if ($inventory->stock != 0)
                            <div class="dropdown" id="dropdown-three">
                                <button class="btn btn-sm btn-icon-only bg-transparent text-light" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item"
                                        data-add-cart-shopping="{{ route('client.selected-products.addShoppingCart', $inventory->id) }}">Añadir
                                        al carrito</a>
                                    <a class="deleteProductOnList dropdown-item"
                                        data-delete-list="{{ route('client.selected-inventory.delete', $inventory->id) }}">Eliminar
                                        de la lista</a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        @endforeach

        {{-- </div> --}}
    </div>
    <div class="row col-lg-4 col-md-12 col-sm-12">
        <div class="col-12">
            <p class="col-12">Resumen de la lista</p>
            <div class="row p-4 container-resumen">
                <div class="col-8">
                    <h5>Productos ({{ $quantityProducts }})</h5>
                    <h5>Subtotal:</h5>
                </div>
                <div class="col-4 d-flex flex-column align-items-end">
                    <h5>S/. {{$priceSubtotal}}</h5>
                    <h5>S/. {{$priceSubtotal}}</h5>
                </div>
                <div class="col-12">
                    <button class="w-100 btn btn-warning">Agregarlos al carrito</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-12">
        <div class="col-12 pt-4">
            <a class="btn btn-default" href="{{ route('clients.home') }}">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
