<?php

class Session{
    private $userModel;

    function __construct($userModel){
        $this->userModel=$userModel;
    }

    function getUserModel(){
        return $this->userModel;
    }

    function setSession($flag,$paginaDestino){
        session_start();
        if($flag == 'alias'){
            if(!isset($_SESSION['alias']) && isset($_SESSION['contrasenia'])){
                $_SESSION['usuario']=$this->userModel->getAlias();
                $_SESSION['contrasenia']=$this->userModel->getContrasenia();
                //Redirigo a la pagina del usuario
                header("location: ".$paginaDestino);
            }
        }else if($flag == 'email'){
            if(!isset($_SESSION['email']) && !isset($_SESSION['contrasenia'])){
                $_SESSION['usuario']=$this->userModel->getEmail();
                $_SESSION['contrasenia']=$this->userModel->getContrasenia();
                //Redirigo a la pagina del usuario
                header("location: ".$paginaDestino);
            }
        }
    }

    function logout(){
        session_destroy();
        //Redirigo al login de la pagina
        header("location:login.php");
    }
    
}