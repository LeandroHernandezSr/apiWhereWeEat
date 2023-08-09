<?php

include_once './dataBaseConnection.php';
include_once './crud.php';

class Turista extends DataBaseConnection implements Crud
{

    private $alias;

    private $bloqueado;

    private $urlImg;

    private $email;

    private $idUsuario;

    private $contrasenia;

    private $rol;

    private $activo;

    public function __construct()
    {
        parent::__construct();
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
        // Construir la parte de los nombres de columnas y los marcadores de posición
        $columnNames = implode(', ', array_keys($datos));
        $placeholders = implode(', ', array_fill(0, count($datos), '?'));

        // Construir la consulta SQL
        $query = "INSERT INTO $tabla ($columnNames) VALUES ($placeholders)";

        // Preparar la consulta
        $stmt = $this->getConn()->prepare($query);

        // Enlazar los valores de los parámetros
        $index = 1;
        foreach ($datos as $valor) {
            $stmt->bindValue($index, $valor);
            $index++;
        }

        // Ejecutar la consulta con los valores enlazados
        $result = $stmt->execute();

        // Devuelve verdadero o falso según la consulta
        return $result;
    }


    public function delete($data)
    {

    }


    public function alter($data)
    {

    }


    public function read($data)
    {

    }


    public function filter($data)
    {

    }

}