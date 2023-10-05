<?php

require_once 'crudBasico.php';

require '../vendor/autoload.php';

use Dotenv\Dotenv;

class Premio extends CrudBasico
{
    private $idPremio;
    private $descripcion;
    private $cantidad;
    
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
