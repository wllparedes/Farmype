<!-- Modal -->
<div class="modal fade" id="createPromotionModal" tabindex="-1" role="dialog" aria-labelledby="createPromotionModal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información de la promoción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('company.promotions.store') }}" id="registerPromotionForm" method="POST" class="form-inputs">
                    @csrf

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="numberPromotion">Número de promoción
                                            *</label>
                                        <input type="text" id="numberPromotion" name="numberPromotion"
                                            class="form-control form-control-alternative input-reset"
                                            placeholder="Digite el número de promoción" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="products">Productos
                                            *</label>
                                        <div class="form-control form-control-alternative input-reset"
                                            id="selectProduct" name="selectProduct"
                                            data-get="{{ route('admin.inventory.getProductsForSelect') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="price">Precio
                                            *</label>
                                        <input type="number" min="1" id="price" name="price"
                                            class="form-control form-control-alternative input-reset"
                                            placeholder="Digite el precio de la promoción" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Imagen * </label>
                                        <div class="square-img-input-container">
                                            <div id="image-preview" class="image-preview">
                                                <label class="form-control-label" for="image-upload"
                                                    id="image-label">Subir
                                                    Imagen</label>
                                                <input type="file" name="image" id="input-product-image-store"
                                                    data-value="" class="">
                                                <div id="img-holder" class="img-holder img-cover">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="price">Stock
                                            *</label>
                                        <input type="number" min="1" id="stock" name="stock"
                                            class="form-control form-control-alternative input-reset"
                                            placeholder="Digite el stock de la promoción" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="date">Fecha de inicio y finalización
                                            *</label>
                                        <input type="text" hidden
                                            class="form-control form-control-alternative input-reset" id="datepicker"
                                            name="datepicker">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar promoción</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
