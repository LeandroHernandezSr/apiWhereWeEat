<?php

require_once 'crudBasico.php';
class Premio extends CrudBasico
{
    private $idPremio;
    private $descripcion;
    private $cantidad;
    
    public function __construct(){
        parent::__construct();
        $this->setDatCon('../restauranteConfig.json');
    }

    public function setIdPremio($idPremio){
        $this->idPremio=$idPremio;
    }

    public function getIdPremio(){
        return $this->idPremio;
    }

    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setCantidad($cantidad){
        $this->cantidad=$cantidad;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

}
