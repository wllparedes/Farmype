<div class="card-body row bg-list-productos">
    <div class="row col-lg-8 col-md-12 col-sm-12 d-flex justify-content-around">
        {{-- <div class="container-products row col-lg-8 col-md-12 col-sm-12"> --}}
        <p class="col-12">Productos</p>

        @php
            $quantityProducts = 0;
            $priceSubtotal = 0;
        @endphp

        @foreach ($productsOnList as $productList)
            @if ($productList->products->isEmpty())
                <h3 class="col-12 text-center">No hay productos registrados</h3>
            @else
                @foreach ($productList->products as $product)
                    <div class="col-12 mb-4 justify-content-around column-product-list">
                        <div class="col-12 container-product-items">
                            <div class="container-list-img">
                                <img src="{{ verifyImage($product->file) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="container-description">
                                <h4 class="card-title"> {{ $product->name }} </h4>
                                <p class="card-text"> {{ $product->detail ? $product->detail : 'Sin detalle.' }}
                                </p>
                            </div>
                            <div class="container-price">
                                @if ($product->on_sale)
                                    @php

                                        if ($product->stock != 0) {
                                            $priceSubtotal = $priceSubtotal + ($product->discounted_price * $product->pivot->quantity);
                                        }

                                    @endphp
                                    <span
                                        class="badge badge-pill badge-sm badge-success text-decoration-line-through">S/.
                                        {{ $product->price }}</span>
                                    <span class="badge badge-pill badge-sm badge-danger discount-value-selected">-%
                                        {{ $product->discount }}</span>
                                    <span class="badge badge-pill badge-sm badge-light">S/.
                                        {{ $product->discounted_price }}</span>
                                    <span class="btn btn-danger btn-sm span-on_sale-selected">OFERTA</span>
                                @else
                                    <span class="badge badge-pill badge-sm badge-primary">S/.
                                        {{ $product->price }}</span>
                                    @php

                                        if ($product->stock != 0) {
                                            $priceSubtotal = $priceSubtotal + ($product->price * $product->pivot->quantity);
                                        }

                                    @endphp
                                @endif
                            </div>

                            @if ($product->stock != 0)
                                @php
                                    $quantityProducts++;
                                @endphp
                                <div class="container-cuantity">
                                    <div class="row-cuantity d-flex justify-content-between p-2">
                                        <button type="button" class="addCuantity btn btn-sm btn-default"
                                            {{ whatIsTop($product->pivot->quantity) }}
                                            data-add="{{ route('client.selected-products.addCuantity', $product->id) }}">+</button>
                                        <span class="valueQuantity"> {{ $product->pivot->quantity }} </span>
                                        <button type="button" class="subtractCuantity btn btn-sm btn-default"
                                            {{ whatIsBottom($product->pivot->quantity) }}
                                            data-subtract="{{ route('client.selected-products.subtractCuantity', $product->id) }}">-</button>
                                    </div>
                                    <p class="card-text text-center text-sm-center text-sm">Máx 10 unidades</p>
                                </div>
                            @else
                                <div class="container-cuantity">
                                    <p class="card-text text-danger text-center text-sm-center text-sm">Producto sin
                                        stock.</p>
                                    <button class="deleteProductOnList btn btn-sm btn-danger"
                                        data-delete-list="{{ route('client.products.delete', $product->id) }}">
                                        Eliminar de la lista
                                    </button>
                                </div>
                            @endif
                        </div>

                        @if ($product->stock != 0)
                            <div class="dropdown" id="dropdown-three">
                                <button class="btn btn-sm btn-icon-only bg-transparent text-light" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item"
                                        data-add-cart-shopping="{{ route('client.selected-products.addShoppingCart', $product->id) }}">Añadir
                                        al carrito</a>
                                    <a class="dropdown-item"
                                        data-delete-list="{{ route('client.products.delete', $product->id) }}">Eliminar
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
