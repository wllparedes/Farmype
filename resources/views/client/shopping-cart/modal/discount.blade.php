<!-- Modal -->
<div class="modal fade" id="discount" tabindex="-1" role="dialog" aria-labelledby="discount" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir cupón de descuento para la compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="verifyCupon" data-url="{{ route('client.shopping.verifycoupions') }}">
                    <div id="input-alternative-component" class="tab-pane tab-example-result fade show active"
                        role="tabpanel" aria-labelledby="input-alternative-component-tab">
                        <input type="text" id="cupon" class="form-control form-control-flush"
                            placeholder="*****************" name="code">
                    </div>

                    {{-- create alert that say: cupon encontrado  --}}
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="cuponFound"
                        style="display: none;">

                        <span class="alert-inner--text"><strong>¡Cupón encontrado!</strong> Se aplicó el descuento
                            correctamente.</span>
                        {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button> --}}
                    </div>

                    {{-- create alert that say: cupon no encontrado  --}}
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="cuponNotFound"
                        style="display: none;">

                        <span class="alert-inner--text"><strong>¡Cupón no encontrado!</strong> El cupón no existe o ya
                            fue utilizado.</span>
                        {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button> --}}
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                        <button type="submit" class="btn btn-primary validateCupon">Validar cupón</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
