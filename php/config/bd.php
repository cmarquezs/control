<?php
class Database {
    public static function getConnection() {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=control_db", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
