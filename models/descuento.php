<?php

require_once 'crudBasico.php';

require '../vendor/autoload.php';

use Dotenv\Dotenv;


class Descuento extends CrudBasico
{
    private $idDescuento;
    private $descuentoActivo;
    private $tituloDescuento;
    private $descripcion;
    private $urlImgDesc;

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
