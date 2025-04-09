<div class="modal " id="modalEditarGasto" tabindex="-1" aria-labelledby="modalEditarGastoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarGastoLabel">Editar Gasto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarGasto" class="form-gasto">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="action" value="editar">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="PrecioEditar" class="form-label">Precio:</label>
                            <input type="number" name="Precio" id="PrecioEditar" class="form-control" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="categoriaEditar" class="form-label">Categoría:</label>
                            <select name="categoria" id="categoriaEditar" class="form-control">
                                <option value="">Seleccione una opción</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['ID']; ?>"><?= $categoria['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="descripcionEditar"  class="form-label">Descripción</label>
                        <input type="text" id="descripcionEditar" name="descripcion" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary ">Actualizar Gasto</button>
                </form>

            </div>
        </div>
    </div>
</div>
