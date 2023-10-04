<?php
require_once '../models/turista.php';
require_once '../models/restaurante.php';
require_once '../models/login.php';
require_once '../models/session.php';
require_once 'cors.php';

function loginTuristaController($tabla, $datos)
{
    $turista = new Turista();
    $login = new Login($turista);
    $turista->setEmail($datos['email']);
    $turista->setContrasenia($datos['contrasena']);
    if($login->authenticate($tabla)){
        $session = new Session($turista);
        $session->setSession("email");
        return true;
    }
    return false;
}

function loginRestauranteController($tabla, $datos)
{
    $restaurante = new Restaurante();
    $login = new Login($restaurante);
    $restaurante->setEmail($datos['email']);
    $restaurante->setContrasenia($datos['contrasena']);
    if($login->authenticate($tabla)){
        $session = new Session($restaurante);
        $session->setSession("email");
        return true;
    }
    return false;
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
                if (isset($data['email']) && isset($data['contrasena'])) {
                    if (!loginTuristaController("usuarios", $data)) {
                        echo json_encode(array("mensaje" => "false"));
                    }else{
                        echo json_encode(array("mensaje" => "true"));
                    }
                } else {
                    echo json_encode(array("mensaje" => "Datos incompletos"));
                }
                break;
            case 'loginRestaurante':
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);
                if (isset($data['email']) && isset($data['contrasena'])) {
                    if (!loginTuristaController("usuarios", $data)) {
                        echo json_encode(array("mensaje" => "false"));
                    }else{
                        echo json_encode(array("mensaje" => "true"));
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