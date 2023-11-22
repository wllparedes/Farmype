<!-- Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información de la categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.store') }}" id="registerCategoryForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Crear categoria principal </label>
                                <div class="input-group input-group-alternative mb-3">
                                    <label class="custom-toggle" id="toggle">
                                        <input type="checkbox" checked name="create_parent_category">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                </div>
                                <div class="div div-name-parent-category-active" id="name-parent-category">
                                    <label class="form-control-label" for="input-parent-category">Nombre de la categoria
                                        principal *</label>
                                    <input type="text" id="input-parent-category" name="name_parent"
                                        class="form-control form-control-alternative input-reset"
                                        placeholder="Digite el nombre de la categoria prinicpal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Crear sub-categoria </label>
                                <div class="input-group input-group-alternative mb-3">
                                    <label class="custom-toggle" id="toggle">
                                        <input type="checkbox" name="create_child_category">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="div div-name-child-category" id="name-child-category">
                                <div class="form-group">
                                    <label class="form-control-label" for="select-parent-category">Categoria
                                        Princial *</label>
                                    <div class="input-group input-group-alternative mb-3">
                                        <select id="select-parent-category" class="form-control input-form-class"
                                            name="parent_category_id">
                                            <option selected disabled>Selecciona una categoria principal</option>
                                            @foreach ($parentCategories as $key => $parentCategory)
                                                <option value="{{ $parentCategory->id }}"> {{ $parentCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-discount">Nombre de la
                                        sub-categoria *</label>
                                    <input type="text" id="input-discount" name="name_child"
                                        class="form-control form-control-alternative input-reset"
                                        placeholder="Digite el nombre de la sub-categoria" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar categoria</button>
            </div>
                </form>
            </div>

        </div>
    </div>
</div>
