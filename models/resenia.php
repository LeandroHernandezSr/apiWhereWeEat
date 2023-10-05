<?php

require_once 'crudBasico.php';

require '../vendor/autoload.php';

use Dotenv\Dotenv;

class Resenia extends CrudBasico{
    private $idUsuarioTurista;
    private $idUsuarioRest;
    private $calificacionMenu;
    private $calificacionInstalaciones;
    private $calificacionPersonal;
    private $calificacionGeneral;
    private $fecha;

    public function __construct(){
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

    public function setIdUsuarioTurista($idUsuarioTurista){
        $this->idUsuarioTurista=$idUsuarioTurista;
    }

    public function getIdUsuarioTurista(){
        return $this->idUsuarioTurista;
    }

    public function setIdUsuarioRest($idUsuarioRest){
        $this->idUsuarioRest=$idUsuarioRest;
    }

    public function getIdUsuarioRest(){
        return $this->idUsuarioRest;
    }

    public function setCalificacionMenu($calificacionMenu){
        $this->calificacionMenu=$calificacionMenu;
    }

    public function getCalificacionMenu(){
        return $this->calificacionMenu;
    }

    public function setCalificacionInstalaciones($calificacionInstalaciones){
        $this->calificacionInstalaciones=$calificacionInstalaciones;
    }

    public function getCalificacionInstalaciones(){
        return $this->calificacionInstalaciones;
    }

    public function setCalificacionPersonal($calificacionPersonal){
        $this->calificacionPersonal=$calificacionPersonal;
    }

    public function getCalificacionPersonal(){
        return $this->calificacionPersonal;
    }


    public function setCalificacionGeneral($calificacionGeneral){
        $this->calificacionGeneral=$calificacionGeneral;
    }

    public function getCalificacionGeneral(){
        return $this->calificacionGeneral;
    }

    public function setFecha($fecha){
        $this->fecha=$fecha;
    }

    public function getFecha(){
        return $this->fecha;
    }

}