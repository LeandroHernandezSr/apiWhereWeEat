<?php

require_once 'usuario.php';

require '../vendor/autoload.php';

use Dotenv\Dotenv;

class Admin extends Usuario{

    private $nroEmpleado;

    private $nombres;

    private $apellidos;

    public function __construct(){
        // Carga las variables de entorno desde el archivo .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../apiWhereWeEat');
        $dotenv->load();
        $this->setHost($_ENV['DB_HOST']);
        $this->setUser($_ENV['DB_USERNAME']);
        $this->setPassword($_ENV['DB_PASSWORD']);
        $this->setDatabase($_ENV['DB_DATABASE']);
        $this->setDriver($_ENV['DB_DRIVER']);
        $this->setDatCon();
        parent::__construct();
    }

    public function setNroEmpleado($nroEmpleado){
        $this->nroEmpleado=$nroEmpleado;
    }

    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }

    public function setNombres($nombres){
        $this->nombres=$nombres;
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function setApellidos($apellidos){
        $this->apellidos=$apellidos;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

}