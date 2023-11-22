<div class="card-body">
    <div class="row container-products">
        @if ($products->isEmpty())
            <h3 class="col-12 text-center">No hay productos registrados</h3>
        @else
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between mb-4">
                                <button id="btn-update" data-original-title="edit" data-toggle="modal"
                                    class="btn btn-outline-success btn-sm editProduct" data-id="{{ $product->id }}"
                                    data-url="{{ route('admin.product.update', $product->id) }}"
                                    data-send="{{ route('admin.product.edit', $product->id) }}">
                                    <i class="fa fa-pen"></i>
                                </button>

                                <a href="javascript:void(0)"
                                    class="btn btn-outline-danger btn-sm text-danger deleteProduct"
                                    data-url="{{ route('admin.product.delete', $product->id) }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <div class="container-image">
                                <img class="card-img-top" src="{{ verifyImage($product->file) }}"
                                    alt="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <p class="card-text product-description">
                                {{ $product->detail ? $product->detail : 'Sin detalle.' }}
                            </p>
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
        <a class="btn btn-default" href="{{ route('company.home') }}">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>