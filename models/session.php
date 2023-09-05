<?php

class Session{
    private $userModel;

    function __construct($userModel){
        $this->userModel=$userModel;
    }

    function getUserModel(){
        return $this->userModel;
    }

    function setSession($flag){
        session_start();
        if($flag == 'alias'){
            if(!isset($_SESSION['alias']) && isset($_SESSION['contrasena'])){
                $_SESSION['usuario']=$this->userModel->getAlias();
                $_SESSION['contrasena']=$this->userModel->getContrasenia();
                //Redirigo a la pagina del usuario
                //header("location: ");
            }
        }else if($flag == 'email'){
            if(!isset($_SESSION['email']) && !isset($_SESSION['contrasena'])){
                $_SESSION['usuario']=$this->userModel->getEmail();
                $_SESSION['contrasena']=$this->userModel->getContrasenia();
                echo "La sesion del usuario es: ".$_SESSION['usuario'];
                //Redirigo a la pagina del usuario
                header("location:http://localhost/Repositorio/apiWhereWeEat/views/turista.php");
            }
        }
    }

    function logout(){
        session_destroy();
        //Redirigo al login de la pagina
        header("location:http://localhost/Repositorio/apiWhereWeEat/views/login.php");
    }
    
}