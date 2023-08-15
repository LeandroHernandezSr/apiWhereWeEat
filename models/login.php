<?php

class Login
{

    private $userModel;

    function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function authenticate($tabla)
    {
        try {
            $query = "SELECT * FROM $tabla WHERE email = :email AND contrasenia = :contrasenia";
            $stmt = $this->userModel->getConn()->prepare($query);
            $stmt->bindValue(":email", $this->userModel->getEmail());
            $stmt->bindValue(":contrasenia", $this->userModel->getContrasenia());
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }catch(PDOException $ex){
            echo "Error en la conexion: ".$ex->getMessage();
        }
    }

}