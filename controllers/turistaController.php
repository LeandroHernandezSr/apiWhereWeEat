<?php

require_once '../models/turista.php';
function insertarController($alias = '', $bloqueado = 0, $urlImg = '', $email = '', $idUsuario = 0, $contrasenia = '', $rol = '', $activo = 1, $nacionalidad = '')
{
    $turista = new Turista();
    $datosTurista = array(
        "alias" => $alias,
        "bloqueado" => $bloqueado,
        "urlImg" => $urlImg,
        "email" => $email,
        "idUsuario" => $idUsuario,
        "contrasenia" => $contrasenia,
        "rol" => $rol,
        "activo" => $activo,
        "nacionalidad" => $nacionalidad
    );

    return $turista->create("turista", $datosTurista);
}

function listarController()
{
    $turista = new Turista();
    $data = array(
        "valores" => "*",
        "tabla" => "turista"
    );
    return $turista->read($data);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['accion']) && $data['accion'] == 'altaTurista') {
        $resultado = insertarController(
            $data['alias'],
            $data['bloqueado'],
            $data['urlImg'],
            $data['email'],
            $data['idUsuario'],
            $data['contrasenia'],
            $data['rol'],
            $data['activo'],
            $data['nacionalidad']
        );    
        $mensaje ="Inserción exitosa";
    } else {
        $mensaje="Error: Clave 'accion' faltante o incorrecta en el JSON.";
    }
    echo $mensaje;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['accion']) && $_GET['accion'] == 'listarTuristas') {
    $turistas = listarController();
    foreach ($turistas as $turista) {
        header('Content-Type: application/json');
        echo json_encode($turista);
    }
}