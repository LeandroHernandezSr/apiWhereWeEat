<?php

require_once './models/turista.php';
function insertarController($alias = '', $bloqueado = 1, $urlImg = '', $email = '', $idUsuario = 0, $contrasenia = '', $rol = '', $activo = 1, $nacionalidad = '')
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) & $_POST['accion']=='altaTurista') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

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

    $mensaje = ($resultado) ? "Inserción exitosa" : "Error al insertar";
    echo $mensaje;
}
