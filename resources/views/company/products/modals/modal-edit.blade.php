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
                                <label class="form-control-label" for="input-name">Nombre del producto</label>
                                <input type="text" id="input-name" name="name"
                                    class="form-control form-control-alternative input-reset "
                                    placeholder="Ingresa el nombre del producto" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Imagen * </label>
                                <div class="square-img-input-container">
                                    <div id="image-preview" class="image-preview h-100">
                                        <div id="img-picture" class="img-picture img-cover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-detail">Detalle</label>
                                <textarea type="text" id="input-detail" name="detail"
                                    class="form-control form-control-alternative input-reset w-100"
                                    placeholder="Ingresa el detalle" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="select-product-type">Categoria principal</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <span class="badge badge-pill badge-md badge-primary" id="parentCategory"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="select-product-type">Sub-categoria(s)</label>
                                <div class="input-group input-group-alternative mb-3" id="containerChildCategories">

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
                                <label class="form-control-label">Poner en oferta (opcional) </label>
                                <div class="input-group input-group-alternative mb-3">
                                    <label class="custom-toggle" id="toggle">
                                        <input type="checkbox" name="on_sale">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                </div>
                                <div class="div discount-value" id="discount-value">
                                    <label class="form-control-label" for="input-discount">% de descuento
                                        *</label>
                                    <input type="number" id="input-discount" name="discount"
                                        class="form-control form-control-alternative input-reset"
                                        placeholder="Ingrese el % de descuento" autocomplete="off" min="1"
                                        max="100">
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
