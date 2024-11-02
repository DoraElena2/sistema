<?php
// api/index.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../controllers/CitasController.php';

$citasController = new CitasController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($citasController->getAllCitas());
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $result = $citasController->createCita($data);
    echo json_encode(["success" => $result]);
}
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../controllers/UsuariosController.php';
include_once '../controllers/CitasController.php';

$usuariosController = new UsuariosController();
$citasController = new CitasController();

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    switch ($data['action']) {
        case 'crear_usuario':
            $response = $usuariosController->crearUsuario($data);
            break;
        case 'login':
            $response = $usuariosController->login($data);
            break;
        case 'crear_cita':
            $response = $citasController->createCita($data);
            break;
        case 'reprogramar_cita':
            $response = $citasController->reprogramarCita($data);
            break;
        default:
            $response = array('success' => false, 'message' => 'Acción no definida');
    }

    echo json_encode($response);
} elseif ($requestMethod === 'GET') {
    if (isset($_GET['citas'])) {
        $response = $citasController->getAllCitas();
        echo json_encode($response);
    }
}