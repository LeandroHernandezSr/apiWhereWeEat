<?php

include_once 'crud.php';
include_once 'dataBaseConnection.php';

class Admin extends DataBaseConnection implements Crud
{
    private $alias;

    private $bloqueado;

    private $urlImg;

    private $email;

    private $idUsuario;

    private $contrasenia;

    private $rol;

    private $activo;

    private $list;

    public function __construct()
    {
        parent::__construct();
        $this->list = array();
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    public function getAlias()
    {
        return $this->alias;
    }


    public function setBloqueado($bloqueado)
    {
        $this->bloqueado = $bloqueado;
    }

    public function getBloqueado()
    {
        return $this->bloqueado;
    }

    public function setUrlImg($urlImg)
    {
        $this->urlImg = $urlImg;
    }

    public function getUrlImg()
    {
        return $this->urlImg;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    public function getActivo()
    {
        return $this->activo;
    }
    public function create($tabla, $datos)
    {
        $columnNames = implode(', ', array_keys($datos));
        $placeholders = implode(', ', array_map(function ($key) {
            return ':' . $key;
        }, array_keys($datos)));

        $query = "INSERT INTO $tabla ($columnNames) VALUES ($placeholders)";

        $stmt = $this->getConn()->prepare($query);

        foreach ($datos as $nombre => $valor) {
            $stmt->bindValue(':' . $nombre, $valor);
        }

        $result = $stmt->execute();

        return $result;
    }



    public function delete($tabla,$datos)
    {

    }


    public function alter($data)
    {

    }


    public function read($data)
    {
        $query = "SELECT {$data['valores']} FROM {$data['tabla']}";
        $stmt = $this->getConn()->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }



    public function filter($tabla,$datos)
    {

    }
}