<?php
require_once '../models/turista.php';
require_once '../models/login.php';

function loginTuristaController($tabla, $datos)
{
    $turista = new Turista();
    $login = new Login($turista);
    $turista->setEmail($datos['email']);
    $turista->setContrasenia($datos['contrasenia']);
    return $login->authenticate($tabla);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['accion'])) {
        switch ($data['accion']) {
            case 'loginTurista':
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);
                // Validar los datos recibidos
                if (isset($data['email']) && isset($data['contrasenia'])) {
                    // Intentar autenticar al usuario
                    if (loginTuristaController("usuarios", $data)) {
                        echo json_encode(array("mensaje" => "Logueado correctamente"));
                    } else {
                        echo json_encode(array("mensaje" => "Credenciales incorrectas"));
                    }
                } else {
                    echo json_encode(array("mensaje" => "Datos incompletos"));
                }
                break;
            default:
                echo "Acción no reconocida";
        }
    } else {
        echo "No se proporcionó la acción";
    }
}