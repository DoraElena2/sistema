<?php
// models/UsuariosModel.php

include_once '../config/Database.php';

class UsuariosModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function crearUsuario($data) {
        $query = "INSERT INTO usuarios (correo_electronico, contraseña, rol) VALUES (:correo, :password, :rol)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $data['correo']);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $stmt->bindParam(':rol', $data['rol']);
        return $stmt->execute();
    }

    public function autenticar($correo, $password) {
        $query = "SELECT * FROM usuarios WHERE correo_electronico = :correo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($password, $usuario['contraseña'])) {
            return $usuario;
        }
        return false;
    }
}
