<?php

require_once 'crudBasico.php';


class Alojamiento extends CrudBasico{

    private $idAlojamiento;
    private $nombreAlojamiento;
    private $idLocAlojamiento;
    private $alojamientoActivo;


    public function __construct(){
        $this->setDatCon('../restauranteConfig.json');
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