<?php

require_once 'dataBaseConnection.php';
require_once 'crud.php';

class Usuario extends DataBaseConnection implements Crud{

    private $alias;

    private $email;

    private $contrasenia;

    private $activo;

    private $bloqueado;

    private $urlImagenUsuario;

    private $fechaCambioPwd;

    private $rol;

    function  __construct(){
        parent::__construct();
    }

  
	public function getAlias() {
		return $this->alias;
	}
	

	public function setAlias($alias): self {
		$this->alias = $alias;
		return $this;
	}
	

	public function getEmail() {
		return $this->email;
	}
	

	public function setEmail($email): self {
		$this->email = $email;
		return $this;
	}
	
	
	public function getContrasenia() {
		return $this->contrasenia;
	}
	

	public function setContrasenia($contrasenia): self {
		$this->contrasenia = $contrasenia;
		return $this;
	}
	

	public function getActivo() {
		return $this->activo;
	}

	public function setActivo($activo): self {
		$this->activo = $activo;
		return $this;
	}
	

	public function getBloqueado() {
		return $this->bloqueado;
	}
	

	public function setBloqueado($bloqueado): self {
		$this->bloqueado = $bloqueado;
		return $this;
	}
	

	public function getUrlImagenUsuario() {
		return $this->urlImagenUsuario;
	}
	

	public function setUrlImagenUsuario($urlImagenUsuario): self {
		$this->urlImagenUsuario = $urlImagenUsuario;
		return $this;
	}
	
	
	public function getFechaCambioPwd() {
		return $this->fechaCambioPwd;
	}
	
	public function setFechaCambioPwd($fechaCambioPwd): self {
		$this->fechaCambioPwd = $fechaCambioPwd;
		return $this;
	}
	
	
	public function getRol() {
		return $this->rol;
	}


	public function setRol($rol): self {
		$this->rol = $rol;
		return $this->rol;
	}


	public function create($tabla, $datos)
    {
        try {
            $query = "SELECT * FROM $tabla WHERE email = :email";
            $stmt = $this->getConn()->prepare($query);
            $stmt->bindValue(':email', $datos['email']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return false;
            } else {
                $hashedPass = password_hash($datos['contrasena'],PASSWORD_BCRYPT);
        
                //Almaceno nuevamente la contraseña
                $datos['contrasena'] = $hashedPass;

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

                return true;
            }
        } catch (PDOException $ex) {
            echo "Error al insertar: " . $ex->getMessage();
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