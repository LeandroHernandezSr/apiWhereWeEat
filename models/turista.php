<?php

include_once 'dataBaseConnection.php';
include_once 'crud.php';

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
        try {
            $query = "SELECT * FROM $tabla WHERE email = :email OR alias = :alias";
            $stmt = $this->getConn()->prepare($query);
            $stmt->bindValue(':email', $datos['email']);
            $stmt->bindValue(':alias', $datos['alias']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return "Usuario o mail existentes, intente nuevamente";
            } else {
                $columnNames = implode(', ', array_keys($datos));
                $placeholders = implode(', ', array_map(function ($key) {
                    return ':' . $key;
                }, array_keys($datos)));

                $query = "INSERT INTO $tabla ($columnNames) VALUES ($placeholders)";

                $stmt = $this->getConn()->prepare($query);

                foreach ($datos as $nombre => $valor) {
                    $stmt->bindValue(':' . $nombre, $valor);
                }

                $stmt->execute();

                $result = "Insercion exitosa";

                return $result;
            }
        }catch(PDOException $ex){
            echo "Error al insertar: ".$ex->getMessage();
        }
    }

    public function delete($tabla, $datos)
    {
        try {
            $query = "SELECT * FROM $tabla WHERE alias = :alias AND contrasenia = :contrasenia";
            $stmt = $this->getConn()->prepare($query);
            $stmt->bindValue(':alias', $datos['alias']);
            $stmt->bindValue(':contrasenia', $datos['contrasenia']);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $columnNames = implode(', ', array_keys($datos));
                $conditions = array_map(function ($key) {
                    return "$key = :$key";
                }, array_keys($datos));
                $query = "DELETE FROM $tabla WHERE " . implode(' AND ', $conditions);

                $stmt = $this->getConn()->prepare($query);

                // Asignar valores a los marcadores de posición en la consulta
                foreach ($datos as $key => $value) {
                    $stmt->bindValue(':' . $key, $value);
                }

                // Ejecutar la consulta con condicional para ver qué retorna
                if ($stmt->execute()) {
                    return "Se eliminó correctamente";
                } else {
                    return "Error al eliminar el registro";
                }
            } else {
                return "No se encontró ningún registro que coincida con los datos proporcionados";
            }
        } catch (PDOException $e) {
            // Manejar el error de PDO
            return "Error al eliminar: " . $e->getMessage();
        }
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

    public function filter($tabla, $datos)
    {
        $columnNames = implode(', ', array_keys($datos));
        $conditions = array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($datos));
        $query = "SELECT $columnNames FROM $tabla WHERE " . implode(' AND ', $conditions);

        $stmt = $this->getConn()->prepare($query);

        // Asignar valores a los marcadores de posición en la consulta
        foreach ($datos as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        // Mostrar la consulta con los valores reales de los marcadores de posición
        $debugQuery = $stmt->queryString;

        foreach ($datos as $key => $value) {
            $debugQuery = str_replace(":$key", $value, $debugQuery);
        }
        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados como objetos y retornarlos
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }


}