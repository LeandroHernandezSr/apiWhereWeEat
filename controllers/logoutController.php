<?php

require_once '../models/session.php';
include_once '../models/usuario.php';
require_once 'cors.php';

function logout(){
    $usuario = new Usuario();
    $session=new Session($usuario);
    $session->logout();
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    logout();
}