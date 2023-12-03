<!-- Modal -->
<div class="modal fade" id="createCoupionModal" tabindex="-1" role="dialog" aria-labelledby="createCoupionModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información del cupón</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.discount.store') }}" id="registerCoupionForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="code">Codigo del cupón
                                    *</label>
                                <input type="text" id="code" name="code"
                                    class="form-control form-control-alternative input-reset "
                                    placeholder="Digite el codigo del cupón" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="discount">Descuento cupón
                                    *</label>
                                <input type="number" max="100" min="1" id="discount"
                                    name="discount" class="form-control form-control-alternative input-reset"
                                    placeholder="Digite el descuento del cupón" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="" id="name-parent-category">
                                    <label class="form-control-label" for="max_uses">Usos máximos
                                        *</label>
                                    <input type="number" max="300" min="1" id="max_uses"
                                        name="max_uses" class="form-control form-control-alternative input-reset"
                                        placeholder="Digite el máximo de usos que se le dará al cupón" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cupón</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
