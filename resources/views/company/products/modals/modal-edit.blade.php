<!-- Modal edit product -->
<div class="modal fade" id="updateProductModal" tabindex="-1" role="dialog" aria-labelledby="updateProductModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Editar información del producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="editProductForm" class="form-inputs" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-name">Nombre del producto
                                    *</label>
                                <input type="text" id="input-name" name="name"
                                    class="form-control form-control-alternative input-reset"
                                    placeholder="Ingresa el nombre del producto" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="select-product-type">Tipo de producto *</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <select id="select-product-type"
                                        class="form-control js-example-basic-single input-form-class"
                                        name="product_type">
                                        <option></option>
                                        @foreach ($productTypes as $key => $type)
                                            <option value="{{ $key }}"> {{ $type }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-stock">Stock *</label>
                                <input type="number" id="input-stock" name="stock"
                                    class="form-control form-control-alternative input-reset"
                                    placeholder="Ingresa el stock" autocomplete="off" min="0">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-price">Precio *</label>
                                <input type="number" id="input-price" name="price"
                                    class="form-control form-control-alternative input-reset"
                                    placeholder="Ingresa el precio" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-detail">Detalle (opcional)</label>
                                <input type="text" id="input-detail" name="detail"
                                    class="form-control form-control-alternative input-reset"
                                    placeholder="Ingresa el detalle">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Imagen * </label>
                                <div class="square-img-input-container">
                                    <div id="image-preview" class="image-preview">
                                        <label class="form-control-label" for="image-upload" id="image-label">Subir
                                            Imagen</label>
                                        <input type="file" name="image" id="input-product-image-store"
                                            data-value="" class="">
                                        <div id="img-holder" class="img-holder img-cover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success btn-save">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
