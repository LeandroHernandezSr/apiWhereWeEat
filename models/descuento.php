<?php

require_once 'crud.php';
require_once 'DataBaseConnection.php';
require_once 'crudBasico.php';


class Descuento extends CrudBasico
{
    private $idDescuento;
    private $descuentoActivo;
    private $tituloDescuento;
    private $descripcion;
    private $urlImgDesc;

    public function __construct(){
        $this->setDatCon('../restauranteConfig.json');
    }

    public function setIdDescuento($idDescuento){
        $this->idDescuento=$idDescuento;
    }

    public function getIdDescuento(){
        return $this->idDescuento;
    }

    public function setDescuentoActivo($descuentoActivo){
        $this->descuentoActivo=$descuentoActivo;
    }

    public function getDescuentoActivo(){
        $this->descuentoActivo;
    }

    public function setTituloDescuento($tituloDescuento){
        $this->tituloDescuento=$tituloDescuento;
    }

    public function getTituloDescuento(){
        return $this->tituloDescuento;
    }

    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setUrlImagenDesc($urlImgDesc){
        $this->urlImgDesc=$urlImgDesc;
    }

    public function getUrlImagenDesc(){
        return $this->urlImgDesc;
    }



}
