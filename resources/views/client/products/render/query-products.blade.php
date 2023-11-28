<div class="card-body">
    <div class="row container-products">
        @if ($products->isEmpty())
            <h3 class="col-12 text-center">No hay productos registrados</h3>
        @else
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-6 col-lg-3 card-responsive-mobil">
                    <div class="card">
                        <div class="card-header">
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
                            <a class="btn btn-primary btn-sm w-100" href="{{ route('client.product.view', $product->id) }}">Ver más</a>
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
