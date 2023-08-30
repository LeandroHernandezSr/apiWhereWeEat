<?php
require_once '../models/turista.php';
require_once '../models/restaurante.php';
require_once '../models/login.php';
require_once '../models/session.php';

function sessionControler($userModel, $flag, $paginaDestino)
{
    $session = new Session($userModel);
    $session->setSession($flag, $paginaDestino);
}


function loginTuristaController($tabla, $datos)
{
    $turista = new Turista();
    $login = new Login($turista);
    $turista->setEmail($datos['email']);
    $turista->setContrasenia($datos['contrasena']);
    return $login->authenticate($tabla);
}

function loginRestauranteController($tabla, $datos)
{
    $restaurante = new Restaurante();
    $login = new Login($restaurante);
    $restaurante->setEmail($datos['email']);
    $restaurante->setContrasenia($datos['contrasena']);
    if ($login->authenticate($tabla)) {
        return true;
    }
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
            case 'loginRestaurante':
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);
                // Validar los datos recibidos
                if (isset($data['email']) && isset($data['contrasena'])) {
                    // Intentar autenticar al usuario
                    if (loginTuristaController("usuarios", $data)) {
                        $restaurante = new Restaurante();
                        $restaurante->setEmail($data['email']);
                        $restaurante->setContrasenia($data['contrasena']);
                        sessionControler($restaurante, "email", "tr");
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