<table class="table table-striped table-hover text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($gastos)): ?>
            <tr>
                <td colspan="5" class="text-center">No hay gastos registrados.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($gastos as $gasto): ?>
                <tr>
                    <td><?= $gasto['Descripcion']; ?></td>
                    <td><?= $gasto['categoria']; ?></td>
                    <td><?= number_format($gasto['Precio']) ?> </td>
                    <td><?= $gasto['Fecha'] ?></td>
                    <td>
                        <button
                            class="btn btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarGasto"
                            data-id="<?= $gasto['ID'] ?>"
                            data-descripcion="<?= htmlspecialchars($gasto['Descripcion']) ?>"
                            data-categoria="<?= $gasto['Categoria'] ?>"
                            data-precio="<?= $gasto['Precio'] ?>">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-danger eliminar-gasto" data-id="<?= $gasto['ID'] ?>">
                            <i class="bi bi-trash"></i>
                        </button>

                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>