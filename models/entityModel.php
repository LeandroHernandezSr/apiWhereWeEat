<?php

require_once 'dataBaseConnection.php';

class EntityModel extends DataBaseConnection
{

    function __construct()
    {
        $this->setDatCon('../config.json');
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