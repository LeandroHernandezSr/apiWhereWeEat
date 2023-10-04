<?php

require_once 'usuario.php';

class Admin extends Usuario{

    private $nroEmpleado;

    private $nombres;

    private $apellidos;

    public function __construct(){
        parent::__construct();
        $this->setDatCon('../restauranteConfig.json');
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