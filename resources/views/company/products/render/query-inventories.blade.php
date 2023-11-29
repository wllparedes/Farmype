<div class="card-body">
    <div class="row container-products">
        @if ($inventories->isEmpty())
            <div class="col-12">
                <div class="row">
                    <div class="col-12 d-flex flex-column">
                        <div class="container-empty">
                            <img class="image-empty" src="{{ asset('assets/img/theme/almacen.png') }}" alt="">
                            <div class="container-note">
                                <h3 class="col-12 text-start pl-0">Inventario pendiente</h3>
                                <p>Estimado farmacéutico, aún no hay productos registrados en su inventario. Por favor,
                                    tome un momento para agregar sus productos y ayudarnos a servir mejor a nuestros
                                    clientes. ¡Gracias!</p>
                            </div>
                        </div>
                        <a class="btn btn-outline-warning btn-md button-inventary-create"
                            href="{{ route('company.inventory.create') }}">
                            Registrar en inventario
                        </a>
                    </div>
                </div>
            </div>
        @else
            @foreach ($inventories as $inventory)
                <div class="col-sm-3 col-md-6 col-lg-3 card-responsive-mobil">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between mb-4">
                                <button id="btn-update" data-original-title="edit" data-toggle="modal"
                                    class="btn btn-outline-success btn-sm editProduct" data-id="{{ $inventory->id }}"
                                    data-url="{{ route('company.inventory.update', $inventory->id) }}"
                                    data-send="{{ route('company.inventory.edit', $inventory->id) }}">
                                    <i class="fa fa-pen"></i>
                                </button>

                                <a href="javascript:void(0)"
                                    class="btn btn-outline-danger btn-sm text-danger deleteProduct"
                                    data-url="{{ route('company.inventory.delete', $inventory->id) }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <div class="container-image">
                                <img class="card-img-top" src="{{ verifyImage($inventory->product->file) }}"
                                    alt="{{ $inventory->name }}">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{ $inventory->product->name }}</h4>
                            <p class="card-text product-description">
                                {{ $inventory->product->detail ? $inventory->product->detail : 'Sin detalle.' }}
                            </p>
                            @if ($inventory->on_sale)
                                <span class="badge badge-pill badge-success text-decoration-line-through">S/.
                                    {{ $inventory->price }}</span>
                                <span class="badge badge-pill badge-warning">-% {{ $inventory->discount }}</span>
                                <span class="badge badge-pill badge-danger">S/
                                    {{ $inventory->discounted_price }}</span>
                            @else
                                <span class="badge badge-pill badge-success">S/. {{ $inventory->price }}</span>
                            @endif

                            <span class="badge badge-pill badge-primary">Stock.
                                {{ $inventory->stock }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="card-footer">
    {{ $inventories->links() }}
</div>

<div class="row col-12">
    <div class="col-12 p-4">
        <a class="btn btn-default" href="{{ route('company.home') }}">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>
