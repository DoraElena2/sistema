<?php
// controllers/CitasController.php

include_once '../models/CitasModel.php';

class CitasController {
    private $citasModel;

    public function __construct() {
        $this->citasModel = new CitasModel();
    }

    public function getAllCitas() {
        return $this->citasModel->getCitas();
    }

    public function createCita($data) {
        return $this->citasModel->createCita($data);
    }
}
