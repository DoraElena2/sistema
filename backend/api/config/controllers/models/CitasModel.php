<?php
// models/CitasModel.php

include_once '../config/Database.php';

class CitasModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getCitas() {
        $query = "SELECT * FROM citas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCita($data) {
        $query = "INSERT INTO citas (paciente_id, tipo_atencion, fecha_deseada, estado) VALUES (:paciente_id, :tipo_atencion, :fecha_deseada, 'pendiente')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':paciente_id', $data['paciente_id']);
        $stmt->bindParam(':tipo_atencion', $data['tipo_atencion']);
        $stmt->bindParam(':fecha_deseada', $data['fecha_deseada']);
        return $stmt->execute();
    }
}
