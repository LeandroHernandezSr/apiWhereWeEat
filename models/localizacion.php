<?php

require_once 'crudBasico.php';


class Localizacion extends CrudBasico
{

    private $idLocalizacion;

    private $nroPuerta;

    private $calle;

    private $esquina;

    public function __construct()
    {
        parent::__construct();
        $this->setDatCon('../restauranteConfig.json');
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
