<?php

require_once 'dataBaseConnection.php';
require '../vendor/autoload.php';

use Dotenv\Dotenv;

class EntityModel extends DataBaseConnection
{

    function __construct()
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

    public function getEntities($page, $perPage) {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM usuarios LIMIT $perPage OFFSET $offset";
        $result = $this->getConn()->query($query);
        if ($result) {
            return $result->fetchALL(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }
    

    public function getTotalEntitiesCount()
    {
        $query = "SELECT COUNT(*) as total FROM usuarios";
        $stmt =  $this->getConn()->query($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            return $row['total'];
        } else {
            return 0;
        }
    }

}