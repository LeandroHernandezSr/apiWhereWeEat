<?php

require_once '../models/turista.php';
require_once 'cors.php';

function insertarController($alias = '', $url_img_usuario = '', $email = '', $contrasena = '', $rol = '',$nacionalidad='',$motivoAlojamiento='',$nombres='',$apellidos='')
{
    $turista = new Turista();
    $datosUsuario = array(
        "alias" => $alias,
        "url_img_usuario" => $url_img_usuario,
        "email" => $email,
        "contrasena" => $contrasena,
        "rol" => $rol
    );

    $datosTurista=array(
        "nacionalidad"=>$nacionalidad,
        "motivo_alojamiento"=>$motivoAlojamiento,
        "id_usuario"=>"",
        "nombres"=>$nombres,
        "apellidos"=>$apellidos
    );

    if($turista->create("usuarios", $datosUsuario)){
       if($turista->createInTurista("turista",$datosUsuario,$datosTurista)){
            return "Creacion de usuario exitosa";
       }else{
            return "Error en la creacion de usuario";
       }
    }else{
        return "El usuario ya existe";
    }
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
            $data['url_img_usuario'],
            $data['email'],
            $data['contrasena'],
            $data['rol'],
            $data['nacionalidad'],
            $data['motivo_alojamiento'],
            $data['nombres'],
            $data['apellidos']
        );
    } else {
        $resultado='Error en la peticion, intente nuevamente';
    }
    echo $resultado;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['accion']) && $_GET['accion'] == 'listarTuristas') {
    $turistas = listarController("*", "usuarios");
     
    header('Content-Type: application/json');
    
    $turistas_array = array();
    foreach ($turistas as $turista) {
        $turistas_array[] = $turista;
    }
    

    echo json_encode($turistas_array);
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

