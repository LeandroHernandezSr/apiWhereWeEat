<?php

require_once '../models/turista.php';
function insertarController($alias = '', $urlImg = '', $email = '', $idUsuario = 0, $contrasenia = '', $rol = '', $nacionalidad = '')
{
    $turista = new Turista();
    $datosTurista = array(
        "alias" => $alias,
        "urlImg" => $urlImg,
        "email" => $email,
        "idUsuario" => $idUsuario,
        "contrasenia" => $contrasenia,
        "rol" => $rol,
        "nacionalidad" => $nacionalidad
    );

    return $turista->create("usuarios", $datosTurista);
}

function listarController($valores, $tabla)
{
    $turista = new Turista();
    $data = array(
        "valores" => "$valores",
        "tabla" => "$tabla"
    );
    return $turista->read($data);
}

function filtrarController($tabla, $datos)
{
    $turista = new Turista();
    return $turista->filter($tabla, $datos);
}

function borrarController($tabla, $datos){
    $turista=new Turista();
    $resultado=$turista->delete($tabla,$datos);
    echo $resultado;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['accion']) && $data['accion'] == 'altaTurista') {
        $resultado = insertarController(
            $data['alias'],
            $data['urlImg'],
            $data['email'],
            $data['idUsuario'],
            $data['contrasenia'],
            $data['rol'],
            $data['nacionalidad']
        );
    } else {
        $resultado='Error en la peticion, intente nuevamente';
    }
    echo $resultado;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['accion']) && $_GET['accion'] == 'listarTuristas') {
    $turistas = listarController("*", "usuarios");
    foreach ($turistas as $turista) {
        header('Content-Type: application/json');
        echo json_encode($turista);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['accion']) && $_GET['accion'] == 'filtrarTurista') {
    $datos = array(
        "alias" => $_GET['alias'],
        "contrasenia" => $_GET['contrasenia']
    );
    $turista = filtrarController("usuarios", $datos);
    echo json_encode($turista);
}


if($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['accion']) && $_GET['accion'] == 'eliminarTurista'){
    $datos = array(
        "alias" => $_GET['alias'],
        "contrasenia" => $_GET['contrasenia']
    );
    
    borrarController("usuarios",$datos);
}