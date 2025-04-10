<?php
require_once __DIR__ . '/../config/bd.php';
require_once __DIR__ . '/../model/gastoModel.php';
require_once __DIR__ . '/gastoServices.php';

$method = $_SERVER['REQUEST_METHOD'];
$gastoService = new GastoServices();


if ($method === 'GET') {

    if ($_GET['action'] === 'contar') {
        //$servicio = new GastoService();
        echo json_encode(['total' => $gastoService->contarTotalGastos()]);
        //exit;
    }
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($gastoService->borrarGasto($id)) {
            echo json_encode(["status" => "success", "message" => "Gasto eliminado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al eliminar el gasto"]);
        }
        exit;
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $gasto = $gastoService->obtenerGastoPorId($id);
        header('Content-Type: application/json');
        echo json_encode($gasto);
        exit;
    }
}

if ($method === 'POST') {
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

    if (strpos($contentType, 'application/json') !== false) {
        // Crear gasto
        $data = json_decode(file_get_contents("php://input"), true);
        $gasto = new Gasto();
        $gasto->setDescripcion($data['descripcion']);
        $gasto->setCategoria($data['categoria']);
        $gasto->setPrecio($data['precio']);

        if ($gasto->getCategoria($data['categoria']) == 0) {
            echo json_encode(["status" => "warning", "message" => "Debes seleccionar una categoria"]);
            exit;
        }

        if ($gastoService->registrarGasto($gasto)) {
            echo json_encode(["status" => "success", "message" => "Gasto registrado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al registrar el gasto"]);
        }
        exit;
    } elseif (strpos($contentType, 'application/x-www-form-urlencoded') !== false) {
        // Editar gasto
        $id = $_POST['ID'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $precio = $_POST['Precio'];

        if ($gastoService->actualizarGasto($id, $descripcion, $categoria, $precio)) {
            echo json_encode(["status" => "success", "message" => "Gasto actualizado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al actualizar el gasto"]);
        }
        exit;
    }
}
