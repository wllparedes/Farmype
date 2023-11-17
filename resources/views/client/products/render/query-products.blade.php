<div class="card-body">
    <div class="row container-products">
        @if ($products->isEmpty())
            <h3 class="col-12 text-center">No hay productos registrados</h3>
        @else
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="container-image">
                                <img class="card-img-top" src="{{ verifyImage($product->file) }}"
                                    alt="{{ $product->name }}">
                            </div>
                            @if ($product->stock === 0)
                                <span class="btn btn-warning span-stock">AGOTADO</span>
                            @else
                                @if ($product->product_lists_count === 0)
                                    <div class="d-flex justify-content-center cart-shooping">
                                        <button class="addProductOnList btn btn-icon btn-primary btn-sm" type="button"
                                            data-url="{{ route('client.products.add', $product->id) }}">
                                            <span class="btn-inner--icon"> <i class="fa fa-clipboard-list"></i> </span>
                                            <span class="btn-inner--text">Añadir a mi lista</span>
                                        </button>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center cart-shooping">
                                        <button class="deleteProductOnList btn btn-icon btn-danger btn-sm"
                                            type="button"
                                            data-url="{{ route('client.products.delete', $product->id) }}">
                                            <span class="btn-inner--icon"> <i class="fa fa-clipboard-list"></i> </span>
                                            <span class="btn-inner--text">Eliminar de mi lista</span>
                                        </button>
                                    </div>
                                @endforelse
                            @endforelse
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <p class="card-text product-description">
                                {{ $product->detail ? $product->detail : 'Sin detalle.' }}
                            </p>
                            @if ($product->on_sale)
                                <span class="badge badge-pill badge-sm badge-success text-decoration-line-through">S/.
                                    {{ $product->price }}</span>
                                <span
                                    class="badge badge-pill badge-sm badge-danger span-discount">-{{ $product->discount }}%</span>
                                <span class="badge badge-pill badge-sm badge-light">S/.
                                    {{ $product->discounted_price }}</span>
                                <span class="btn btn-danger span-on_sale">OFERTA</span>
                            @else
                                <span class="badge badge-pill badge-sm badge-success">S/. {{ $product->price }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="card-footer">
    {{ $products->links() }}
</div>

<div class="row col-12">
    <div class="col-12 p-4">
        <a class="btn btn-default" href="{{ route('clients.home') }}">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>
