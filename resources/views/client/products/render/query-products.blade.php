<div class="card-body">
    <div class="row container-products">
        @foreach ($products as $product)
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <div class="container-image">
                            <img class="card-img-top" src="{{ verifyImage($product->file) }}" alt="{{ $product->name }}">
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
                                    <button class="deleteProductOnList btn btn-icon btn-danger btn-sm" type="button"
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
                        <span class="badge badge-pill badge-lg badge-primary">S/. {{ $product->price }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card-footer">
    {{ $products->links() }}
</div>


