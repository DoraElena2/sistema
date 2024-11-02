<?php
// controllers/UsuariosController.php

include_once '../models/UsuariosModel.php';

class UsuariosController {
    private $usuariosModel;

    public function __construct() {
        $this->usuariosModel = new UsuariosModel();
    }

    public function crearUsuario($data) {
        return $this->usuariosModel->crearUsuario($data);
    }

    public function login($data) {
        $usuario = $this->usuariosModel->autenticar($data['correo'], $data['password']);
        if ($usuario) {
            return [
                "success" => true,
                "message" => "Login exitoso",
                "usuario" => $usuario
            ];
        }
        return [
            "success" => false,
            "message" => "Credenciales incorrectas"
        ];
    }
}
