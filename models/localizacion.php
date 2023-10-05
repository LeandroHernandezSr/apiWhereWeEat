<?php

require_once 'crudBasico.php';

require '../vendor/autoload.php';

use Dotenv\Dotenv;


class Localizacion extends CrudBasico
{

    private $idLocalizacion;

    private $nroPuerta;

    private $calle;

    private $esquina;

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

    public function setIdLocalizacion($idLocalizacion)
    {
        $this->idLocalizacion = $idLocalizacion;
    }

    public function getIdLocalizacion()
    {
        return $this->idLocalizacion;
    }

    public function setNroPuerta($nroPuerta)
    {
        $this->nroPuerta = $nroPuerta;
    }

    public function getNroPuerta()
    {
        return $this->nroPuerta;
    }

    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    public function getCalle()
    {
        return $this->calle;
    }

    public function setEsquina($esquina)
    {
        $this->esquina = $esquina;
    }

    public function getEsquina()
    {
        return $this->esquina;
    }
}
