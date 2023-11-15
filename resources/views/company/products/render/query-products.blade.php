<div class="card-body">
    <div class="row container-products">
        @foreach ($products as $product)
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between mb-4">
                            <button id="btn-update" data-original-title="edit" data-toggle="modal"
                                class="btn btn-outline-success btn-sm editProduct"
                                data-id="{{ $product->id }}"
                                data-url="{{ route('company.product.update', $product->id) }}"
                                data-send="{{ route('company.product.edit', $product->id) }}">
                                <i class="fa fa-pen"></i>
                            </button>

                            <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm text-danger deleteProduct"
                                data-url="{{ route('company.product.delete', $product->id) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        <div class="container-image">
                            <img class="card-img-top" src="{{ verifyImage($product->file) }}" alt="{{ $product->name }}">
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text product-description">
                            {{ $product->detail ? $product->detail : 'Sin detalle.' }}
                        </p>
                        <span class="badge badge-pill badge-danger">S/. {{ $product->price }}</span>
                        <span class="badge badge-pill badge-primary">Cant.
                            {{ $product->stock }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card-footer">
    {{ $products->links() }}
</div>
