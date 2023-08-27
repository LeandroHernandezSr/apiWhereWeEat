<?php
include_once 'crud.php';
include_once 'usuario.php';

class Restaurante extends Usuario implements Crud{
    private $tipoRestaurante;

    private $nombre;

    private $nroLocal;

    private $direccionRest;

    public function __construct(){
        parent::__construct();
    }

    public function setTipoRestaruante($tipoRestaurante){
        $this->tipoRestaurante=$tipoRestaurante;
    }

    public function getTipoRestaurante(){
        return $this->tipoRestaurante;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNroLocal($nroLocal){
        $this->nroLocal=$nroLocal;
    }

    public function getNroLocal(){
        return $this->nroLocal;
    }

    public function setDireccionRest($direccionRest){
        $this->direccionRest=$direccionRest;
    }

    public function getDireccionRest(){
        return $this->direccionRest;
    }

    public function create($tabla, $datos)
    {
        try {
            $query = "SELECT * FROM $tabla WHERE id = :id";
            $stmt = $this->getConn()->prepare($query);
            $stmt->bindValue(':id', $datos['id']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return "id ya almacenada, intente nuevamente";
            } else {
    
                //Generar un hash seguro usando el algoritmo bcrypt
                $hashedPass=password_hash($datos['contrasenia'],PASSWORD_BCRYPT);

                //Almaceno nuevamente la contraseña
                $datos['contrasenia']=$hashedPass;
                
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