<?php
include_once 'crud.php';
include_once 'usuario.php';

require '../vendor/autoload.php';

use Dotenv\Dotenv;

class Restaurante extends Usuario implements Crud
{
    private $tipoRestaurante;

    private $nombre;

    private $nroLocal;

    private $direccionRest;

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

    public function setTipoRestaruante($tipoRestaurante)
    {
        $this->tipoRestaurante = $tipoRestaurante;
    }

    public function getTipoRestaurante()
    {
        return $this->tipoRestaurante;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNroLocal($nroLocal)
    {
        $this->nroLocal = $nroLocal;
    }

    public function getNroLocal()
    {
        return $this->nroLocal;
    }

    public function setDireccionRest($direccionRest)
    {
        $this->direccionRest = $direccionRest;
    }

    public function getDireccionRest()
    {
        return $this->direccionRest;
    }


    public function createInRestaurante($tabla, $datos, $datosRestaurante)
    {
        try {
            $query = "SELECT id_usuario FROM usuarios WHERE email = :email";
            $stmt = $this->getConn()->prepare($query);
            $stmt->bindValue(':email', $datos['email']);
            $stmt->execute();
            $idRows = $stmt->fetchAll();

            if (!empty($idRows)) {
                $datosRestaurante['id_usuario'] = $idRows[0]['id_usuario'];
                $columnNames = implode(', ', array_keys($datosRestaurante));
                $placeholders = implode(', ', array_map(function ($key) {
                    return ':' . $key;
                }, array_keys($datosRestaurante)));

                $query = "INSERT INTO $tabla ($columnNames) VALUES ($placeholders)";

                $stmt = $this->getConn()->prepare($query);

                foreach ($datosRestaurante as $nombre => $valor) {
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