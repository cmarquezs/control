<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Gastos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="container mt-4">
    <div class="container">
        <?php
        // === Cargar clases y servicios ===
        require_once __DIR__ . '/php/modules/categoriaServices.php';
        require_once __DIR__ . '/php/modules/gastoServices.php';

        // === Instanciar servicios ===
        $categoriaService = new CategoriaService();
        $categorias = $categoriaService->obtenerCategorias();

        $gastoService = new GastoServices();
        $gastos = $gastoService->obtenerGastos();

        // === Modales ===
        require_once __DIR__ . '/views/modalRegistroGasto.php';
        require_once __DIR__ . '/views/modalEditarGasto.php';
        ?>

        <h3>Listado de Gastos
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalGasto">
                Agregar Gasto
            </a>
        </h3>
        <hr>

        <?php
        require_once __DIR__ . '/views/tablaGastos.php';
        ?>
    </div>
    <script src="./assets/js/main.js"></script>
</body>

</html>
