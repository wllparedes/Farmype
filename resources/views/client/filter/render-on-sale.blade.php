<div class="card-body">
    <div class="row container-products">
        @if ($productsOnSale->isEmpty())
            <h3 class="col-12 text-center">No hay productos registrados</h3>
        @else
            @foreach ($productsOnSale as $productsOnSal)
                <div class="col-sm-6 col-md-6 col-lg-3 card-responsive-mobil">
                    <div class="card">
                        <div class="card-header" style="">
                            <div class="container-image" style="">
                                <img style="" class="card-img-top"
                                    src="{{ verifyImage($productsOnSal->product->file) }}"
                                    alt="{{ $productsOnSal->product->name }}">
                            </div>
                            @if ($productsOnSal->stock === 0)
                                <span class="btn btn-warning span-stock btn-sm">AGOTADO</span>
                            @else
                                @if ($productsOnSal->shoppings_count === 0)
                                    <div class="d-flex justify-content-center cart-shooping">
                                        <button class="addOnShoppingCart btn btn-icon btn-primary btn-sm cart-shooping"
                                            type="button"
                                            data-add-cart-shopping="{{ route('client.selected-inventory.addShoppingCartDirect', $productsOnSal->id) }}">
                                            <span class="btn-inner--icon"> <i class="fa fa-tag"></i></span>
                                            <span class="btn-inner--text">Añadir al carrito</span>
                                        </button>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center cart-shooping">
                                        <button class="deleteProductOnShopping btn btn-icon btn-danger btn-sm"
                                            type="button"
                                            data-delete-shopping="{{ route('client.shopping.delete', $productsOnSal->id) }}">
                                            <span class="btn-inner--icon"> <i class="fa fa-tag"></i> </span>
                                            <span class="btn-inner--text">Eliminar del carrito</span>
                                        </button>
                                    </div>
                                @endforelse
                            @endforelse
                        </div>
                        <div class="card-body info-product-onSale" style="">
                            <h4 class="card-title">{{ $productsOnSal->product->name }}</h4>
                            <p class="card-text product-description">
                                {{ $productsOnSal->product->detail ? $productsOnSal->product->detail : 'Sin detalle.' }}
                            </p>
                            <p class="card-text text-small">
                                <strong>{{ $productsOnSal->user->names_surnames }}</strong>
                            </p>
                            <span class="badge badge-pill badge-sm badge-warning text-decoration-line-through">S/.
                                {{ $productsOnSal->price }}</span>
                            <span
                                class="badge badge-pill badge-sm badge-danger span-discount-onSale">-{{ $productsOnSal->discount }}%</span>
                            <span class="badge badge-pill badge-sm badge-light">S/.
                                {{ $productsOnSal->discounted_price }}</span>
                            <p class="text-small text-sm-success text-success mt-4 ">Stock Disponible:
                                {{ $productsOnSal->stock }}</p>
                            <span class="btn btn-danger btn-sm span-on_sale">OFERTA</span>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="card-footer">
    {{ $productsOnSale->links() }}
</div>

<div class="row col-12">
    <div class="col-12 p-4">
        <a class="btn btn-default" href="{{ route('clients.home') }}">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>
