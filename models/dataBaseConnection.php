<?php

abstract class DataBaseConnection
{

    private $host;

    private $user;

    private $password;

    private $database;

    private $driver;

    private $conn;

    private $data;

    function __construct()
    {
        try {
            $this->conn = new PDO("$this->driver:host=$this->host;dbname=$this->database", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "falla de conexion" . $e;
        }
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setDatabase($database)
    {
        $this->database = $database;
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function setDatCon(){
        $this->host=$this->getHost();
        $this->user=$this->getUser();
        $this->password=$this->getPassword();
        $this->driver=$this->getDriver();
        $this->database=$this->getDatabase();
    }

    public function closeCon(){
        return $this->conn=null;
    }

}