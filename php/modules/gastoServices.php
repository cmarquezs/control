<?php
require_once __DIR__ . '/../config/bd.php';
require_once __DIR__ . '/../model/gastoModel.php';

class GastoServices
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Database::getConnection();
    }

    public function registrarGasto(Gasto $gasto)
    {
        $sql = "INSERT INTO gastos (Descripcion, categoria, Precio) VALUES (:descripcion, :categoria, :Precio)";
        $stmt = $this->conexion->prepare($sql);

        $descripcion = $gasto->getDescripcion();
        $categoria = $gasto->getCategoria();
        $precio = $gasto->getPrecio();

        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':Precio', $precio);

        return $stmt->execute();
    }



    public function obtenerGastos()
    {
        $sql = "SELECT g.ID, g.Descripcion, g.Precio, g.Fecha, c.nombre AS categoria, g.Categoria  
                FROM gastos g
                LEFT JOIN gastos_categorias c ON g.Categoria = c.ID
                ORDER BY g.fecha DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarGasto($id, $descripcion, $categoria, $Precio)
    {
        try {
            $sql = "UPDATE gastos SET Descripcion = :descripcion, Categoria = :categoria, Precio = :Precio WHERE ID = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':Precio', $Precio);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                $error = $stmt->errorInfo();
                echo "Error al actualizar: " . $error[2];
                return false;
            }
        } catch (Exception $e) {
            echo "Exception al actualizar: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerGastoPorId($id)
    {
        $sql = "SELECT g.ID, g.Descripcion, g.Precio, g.Fecha, c.nombre AS categoria, g.Categoria  
            FROM gastos g
            LEFT JOIN gastos_categorias c ON g.Categoria = c.ID
            WHERE g.ID = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
