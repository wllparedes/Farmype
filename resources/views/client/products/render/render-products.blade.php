<div class="card-body">
    <div class="row container-products">
        @if ($inventories->isEmpty())
            <h3 class="col-12 text-center">No hay productos para vender</h3>
        @else
            @php
                $var = 0;
            @endphp
            @foreach ($inventories as $inventory)
                <div class="col-lg-4 col-md-12 col-sm-12 mb-4 justify-content-around column-product-list">
                    <div class="col-12">
                        <h2 class="card-text text-center"> {{ $inventory->product->name }} </h2>
                        <div class="image-product">
                            <img src="{{ verifyImage($inventory->product->file) }}" alt="">
                        </div>
                        <p class="card-text"> {{ $inventory->detail ? $inventory->detail : 'Sin detalle.' }}</p>
                        @foreach ($inventory->product->childCategories as $childCategory)
                            @if ($var === 0)
                                <span class="badge badge-pill badge-default"> {{ $childCategory->parentCategory->name }}
                                </span>
                                @php
                                    $var++
                                @endphp
                            @endif
                            <span class="badge badge-pill badge-light"> {{ $childCategory->name }} </span>
                        @endforeach
                    </div>
                </div>
            @break
        @endforeach
        <div class="col-lg-8 col-md-12 col-sm-12 mb-4 justify-content-around column-product-list">
            @foreach ($inventories as $inventory)
                <div class="col-12 container-product-items">
                    <div class="container-list-img">
                        <img src="{{ verifyImage($inventory->product->file) }}"
                            alt="{{ $inventory->product->name }}">
                    </div>

                    <div class="container-price">
                        @if ($inventory->on_sale)
                            <span class="badge badge-pill badge-sm badge-success text-decoration-line-through">S/.
                                {{ $inventory->price }}</span>
                            <span class="badge badge-pill badge-sm badge-danger discount-value-selected">-%
                                {{ $inventory->discount }}</span>
                            <span class="badge badge-pill badge-sm badge-light">S/.
                                {{ $inventory->discounted_price }}</span>
                            <span class="btn btn-danger btn-sm span-on_sale-selected">OFERTA</span>
                        @else
                            <span class="badge badge-pill badge-sm badge-primary">S/.
                                {{ $inventory->price }}</span>
                        @endif
                    </div>

                    <div class="container-user">
                        <p class="text-small"><strong> Farmacia: </strong> {{ $inventory->user->names_surnames }}
                        </p>
                        <p class="text-small"><strong> Telefono: </strong> {{ $inventory->user->phone }} </p>
                        <p class="text-small"><strong> Dirección: </strong> {{ $inventory->user->address }} </p>
                    </div>

                    <div class="container-cuantity">
                        @if ($inventory->stock === 0)
                            <span class="btn btn-warning span-stock">AGOTADO</span>
                        @else
                            @if ($inventory->product_lists_count === 0)
                                <div class="d-flex justify-content-center cart-shooping">
                                    <button class="addProductOnList btn btn-icon btn-primary btn-sm" type="button"
                                        data-url="{{ route('client.inventory.add', $inventory->id) }}">
                                        <span class="btn-inner--icon"> <i class="fa fa-clipboard-list"></i> </span>
                                        <span class="btn-inner--text">Añadir a mi lista</span>
                                    </button>
                                </div>
                            @else
                                <div class="d-flex justify-content-center cart-shooping">
                                    <button class="deleteProductOnList btn btn-icon btn-danger btn-sm"
                                        type="button"
                                        data-url="{{ route('client.inventory.delete', $inventory->id) }}">
                                        <span class="btn-inner--icon"> <i class="fa fa-clipboard-list"></i> </span>
                                        <span class="btn-inner--text">Eliminar de mi lista</span>
                                    </button>
                                </div>
                            @endforelse
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
</div>

<div class="row col-12">
<div class="col-12 p-4">
    <a class="btn btn-default" href="{{ route('client.products.index') }}">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>
</div>
