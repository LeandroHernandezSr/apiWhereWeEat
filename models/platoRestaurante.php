<?php


require_once 'crudBasico.php';

require '../vendor/autoload.php';

use Dotenv\Dotenv;

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
