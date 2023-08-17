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
            // Generar salt unico para cada usuario
            $salt=bin2hex(random_bytes(16));
            //Combinar la contrasenia del usuario con el salt
            $combinedPassword=$salt.$this->userModel->getContrasenia;
            //Generar un hash seguro usando el algoritmo bcrypt
            $hashedPass=password_hash($combinedPassword,PASSWORD_BCRYPT);
            //Almaceno nuevamente
            $this->userModel->setContrasenia($hashedPass);
            
            $query = "SELECT * FROM $tabla WHERE email = :email AND contrasenia = :contrasenia";
            $stmt = $this->userModel->getConn()->prepare($query);
            $stmt->bindValue(":email", $this->userModel->getEmail());
            $stmt->bindValue(":contrasenia", $this->userModel->getContrasenia());
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                return true; 
            } else {
                return false; // Datos incorrectos
            }
        } catch (PDOException $ex) {
            echo "Error en la conexión: " . $ex->getMessage();
        }
    }


}