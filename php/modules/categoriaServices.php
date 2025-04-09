<?php
require_once __DIR__ . '/../config/bd.php';

class CategoriaService
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Database::getConnection();
    }

    public function obtenerCategorias()
    {
        $sql = "SELECT ID, nombre FROM gastos_categorias";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
