<?php

require_once '../models/restaurante.php';
function insertarController($alias = '', $bloqueado = 0, $urlImg = '', $email = '', $idUsuario = 0, $contrasenia = '', $rol = '', $activo = 1, $nacionalidad = '')
{
    $restaurante = new Restaurante();
    $datosRestaruante = array(
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

    return $restaurante->create("restaurante", $datosRestaruante);
}

function listarController()
{
    $restaurante = new Restaurante();
    $data = array(
        "valores" => "*",
        "tabla" => "restaurante"
    );
    return $restaurante->read($data);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['accion']) && $data['accion'] == 'altaRestaurante') {
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

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['accion']) && $_GET['accion'] == 'listarRestaurantes') {
    $restaurantes = listarController();
    foreach ($restaurantes as $restaurante) {
        header('Content-Type: application/json');
        echo json_encode($restaurante);
    }
}