<?php
require_once '../models/session.php';
require_once '../models/usuario.php';

session_start();

if(!isset($_SESSION['email']) && !isset($_SESSION['contrasena']) || !isset($_SESSION['alias']) && !isset($_SESSION['contrasena'])){
    $usuario=new Usuario();
    $session=new Session($usuario);
    $session->logout();
}else{
    echo "Estas conectado con la sesion de ".$_SESSION['email'];
}
