<?php

require_once 'crudBasico.php';

require '../vendor/autoload.php';

use Dotenv\Dotenv;


class Alojamiento extends CrudBasico{

    private $idAlojamiento;
    private $nombreAlojamiento;
    private $idLocAlojamiento;
    private $alojamientoActivo;


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


    public function setIdAlojamiento($idAlojamiento){
        $this->idAlojamiento=$idAlojamiento;
    }

    public function getIdAlojamiento(){
        return $this->idAlojamiento;
    }

    public function setNombreAlojamiento($nombreAlojamiento){
        $this->nombreAlojamiento=$nombreAlojamiento;
    }

    public function getNombreAlojamiento(){
        return $this->nombreAlojamiento;
    }

    public function setIdLocAlojamiento($idLocAlojamiento){
        $this->idLocAlojamiento=$idLocAlojamiento;
    }

    public function getIdLocAlojamiento(){
        return $this->idLocAlojamiento;
    }

    public function setAlojamientoActivo($alojamientoActivo){
        $this->alojamientoActivo=$alojamientoActivo;
    }

    public function getAlojamientoActivo(){
        return $this->alojamientoActivo;
    }

}   