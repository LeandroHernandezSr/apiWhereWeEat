<?php

require_once 'crudBasico.php';

require '../vendor/autoload.php';

use Dotenv\Dotenv;


class Descuento extends CrudBasico
{
    private $idDescuento;
    private $activo;
    private $idRestaurante;
    private $descuentoActivo;
    private $tituloDescuento;
    private $descripcion;
    private $urlImgDesc;
    private $fechaInicio;
    private $fechaFin;

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

    public function setIdDescuento($idDescuento)
    {
        $this->idDescuento = $idDescuento;
    }

    public function getIdDescuento()
    {
        return $this->idDescuento;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setIdRestaurante($idRestaurante)
    {
        $this->idRestaurante = $idRestaurante;
    }

    public function getIdRestaurante()
    {
        return $this->idRestaurante;
    }

    public function setDescuentoActivo($descuentoActivo)
    {
        $this->descuentoActivo = $descuentoActivo;
    }

    public function getDescuentoActivo()
    {
        $this->descuentoActivo;
    }

    public function setTituloDescuento($tituloDescuento)
    {
        $this->tituloDescuento = $tituloDescuento;
    }

    public function getTituloDescuento()
    {
        return $this->tituloDescuento;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setUrlImagenDesc($urlImgDesc)
    {
        $this->urlImgDesc = $urlImgDesc;
    }

    public function getUrlImagenDesc()
    {
        return $this->urlImgDesc;
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    }

    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    public function crearDescuento()
    {
        try {
            $query = "INSERT INTO descuento(id_descuento,activo,titulo_descuento,descripcion,url_img_descuento) VALUES (:id_descuento,:activo,:titulo_descuento,:descripcion,:url_img_descuento)";
            $stmt = $this->getConn()->prepare($query);
            $stmt->bindValue(":id_descuento", $this->getIdDescuento());
            $stmt->bindValue(":activo", $this->getActivo());
            $stmt->bindValue(":titulo_descuento", $this->getTituloDescuento());
            $stmt->bindValue(":descripcion", $this->getDescripcion());
            $stmt->bindValue(":url_img_descuento", $this->getUrlImagenDesc());
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $ex) {
            echo "Error en el insert: " . $ex->getMessage();
        }
    }
}
