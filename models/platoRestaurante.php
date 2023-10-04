<?php


require_once 'crudBasico.php';

class PlatoRestaurante extends CrudBasico
{
    private $idPlato;
    private $nombrePlato;
    private $costo;
    private $descripcion;
    private $urlImgMenu;
    private $estadoPlato;
    private $idUsuario;

    public function __construct()
    {
        parent::__construct();
        $this->setDatCon('../restauranteConfig.json');
    }

    public function setIdPlato($idPlato)
    {
        $this->idPlato = $idPlato;
    }

    public function getIdPlato()
    {
        return $this->idPlato;
    }

    public function setNombrePlato($nombrePlato)
    {
        $this->nombrePlato = $nombrePlato;
    }

    public function getNombrePlato()
    {
        return $this->nombrePlato;
    }

    public function setCosto($costo)
    {
        $this->costo=$costo;
    }

    public function getCosto(){
        return $this->costo;
    }

    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setUrlImgMenu($urlImgMenu){
        $this->urlImgMenu=$urlImgMenu;
    }

    public function getUrlImgMenu(){
        return $this->urlImgMenu;
    }
    
    public function setEstadoPlato($estadoPlato){
        $this->estadoPlato=$estadoPlato;
    }

    public function getEstadoPlato(){
        return $this->estadoPlato;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario=$idUsuario;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }
    
}
