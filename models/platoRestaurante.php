<?php


require_once 'crudBasico.php';

require '../vendor/autoload.php';

use Dotenv\Dotenv;

class PlatoRestaurante extends CrudBasico
{
    private $idPlato;
    private $nombrePlato;
    private $costo;
    private $descripcion;
    private $urlImgMenu;
    private $estadoPlato;
    private $idUsuario;
    private $plato;

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

    public function setIdPlato($idPlato)
    {
        $this->idPlato = $idPlato;
    }

    public function getIdPlato()
    {
        return $this->idPlato;
    }

    public function setNombrePlato($nombrePlato)
    {
        $this->nombrePlato = $nombrePlato;
    }

    public function getNombrePlato()
    {
        return $this->nombrePlato;
    }

    public function setCosto($costo)
    {
        $this->costo = $costo;
    }

    public function getCosto()
    {
        return $this->costo;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setUrlImgMenu($urlImgMenu)
    {
        $this->urlImgMenu = $urlImgMenu;
    }

    public function getUrlImgMenu()
    {
        return $this->urlImgMenu;
    }

    public function setEstadoPlato($estadoPlato)
    {
        $this->estadoPlato = $estadoPlato;
    }

    public function getEstadoPlato()
    {
        return $this->estadoPlato;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setPlato()
    {
        $this->plato = array(
            "id_plato" => $this->getIdPlato(),
            "nombre_plato" => $this->getNombrePlato(),
            "costo" => $this->getCosto(),
            "descripcion" => $this->getDescripcion(),
            "url_img_menu" => $this->getUrlImgMenu(),
            "estado_plato" => $this->getEstadoPlato(),
            "id_usuario_rest" => $this->getIdUsuario()
        );
    }

    public function getPlato()
    {
        return $this->plato;
    }

    public function persistirPlato()
    {
        //Valido que exista el id del usuario restaurante
        try {
            $query = "SELECT id_usuario FROM restaurante WHERE id_usuario= :id_usuario";
            $stmt = $this->getConn()->prepare($query);
            $stmt->bindValue(":id_usuario", $this->getIdUsuario());
            $stmt->execute();
            $idRows = $stmt->fetchAll();
            if (!empty($idRows)) {
                try {
                    //Persisto el plato en la tabla plato_restaurantes
                    $query = "INSERT INTO plato_restaurantes(nombre_plato,costo,descripcion,url_img_menu,estado_plato,id_usuario_rest) VALUES (:nombre_plato,:costo,:descripcion,:url_img_menu,:estado_plato,:id_usuario_rest)";
                    $stmt = $this->getConn()->prepare($query);
                    $stmt->bindValue(":nombre_plato", $this->getNombrePlato());
                    $stmt->bindValue(":costo", $this->getCosto());
                    $stmt->bindValue(":descripcion", $this->getDescripcion());
                    $stmt->bindValue(":url_img_menu", $this->getUrlImgMenu());
                    $stmt->bindValue(":estado_plato", $this->getEstadoPlato());
                    $stmt->bindValue(":id_usuario_rest", $this->getIdUsuario());
                    if ($stmt->execute()) {
                        return true;
                    }
                } catch (PDOException $ex) {
                    return "Error en el insert: " . $ex->getMessage();
                }
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            return "Error en la busqueda del usuario restaurante:" . $ex->getMessage();
        }
    }
}
