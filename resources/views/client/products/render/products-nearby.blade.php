@foreach ($inventories as $inventory)
    <div class="col-12 container-product-items">
        <div class="container-list-img">
            <img src="{{ verifyImage($inventory->product->file) }}" alt="{{ $inventory->product->name }}">
        </div>

        <div class="container-price">
            @if ($inventory->on_sale)
                <span class="badge badge-pill badge-sm badge-success text-decoration-line-through">S/.
                    {{ $inventory->price }}</span>
                <span
                    class="badge badge-pill badge-sm badge-danger discount-value-selected view-product-on on-sale-main">-%
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

        @if ($inventory->stock < 1)
            <span class="btn btn-warning span-stock">AGOTADO</span>
        @else
            <div class="container-cuantity">
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
                        <button class="deleteProductOnList btn btn-icon btn-danger btn-sm" type="button"
                            data-url="{{ route('client.inventory.delete', $inventory->id) }}">
                            <span class="btn-inner--icon"> <i class="fa fa-clipboard-list"></i> </span>
                            <span class="btn-inner--text">Eliminar de mi lista</span>
                        </button>
                    </div>
                @endforelse
            </div>
        @endforelse
    </div>
@endforeach
