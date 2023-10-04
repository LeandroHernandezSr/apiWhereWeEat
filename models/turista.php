<?php
include_once 'crud.php';
include_once 'usuario.php';

class Turista extends Usuario implements Crud
{

    private $idUsuario;

    private $nacionalidad;

    private $motivoAlojamiento;

    private $nombre;

    private $apellido;


    public function __construct()
    {
        $this->setDatCon('../turistaConfig.json');
        parent::__construct();
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;
    }

    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    public function setMotivoAlojamiento($motivoAlojamiento)
    {
        $this->motivoAlojamiento = $motivoAlojamiento;
    }

    public function getMotivoAlojamiento()
    {
        return $this->motivoAlojamiento;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setApellido($apellido){
        $this->apellido;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function createInTurista($tabla, $datos, $datosTurista)
    {
        try {
            $query = "SELECT id_usuario FROM usuarios WHERE email = :email";
            $stmt = $this->getConn()->prepare($query);
            $stmt->bindValue(':email', $datos['email']);
            $stmt->execute();
            $idRows = $stmt->fetchAll();

            if (!empty($idRows)) {
                $datosTurista['id_usuario'] = $idRows[0]['id_usuario'];
                $columnNames = implode(', ', array_keys($datosTurista));
                $placeholders = implode(', ', array_map(function ($key) {
                    return ':' . $key;
                }, array_keys($datosTurista)));

                $query = "INSERT INTO $tabla ($columnNames) VALUES ($placeholders)";

                $stmt = $this->getConn()->prepare($query);

                foreach ($datosTurista as $nombre => $valor) {
                    $stmt->bindValue(':' . $nombre, $valor);
                }

                $stmt->execute();

                return true;
            } else {
                return "No se encontró ningún registro con ese email.";
            }
        } catch (PDOException $ex) {
            throw new Exception("Error al insertar: " . $ex->getMessage());
        }
    }

}