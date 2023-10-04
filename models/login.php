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
            $conn = $this->userModel->getConn(); 
            //Crear un metodo para que destruya la session anterior para no tener problemas
            
            //Consulta para obtener el salt y la contraseña hash del usuario según su email
            $query = "SELECT contrasena FROM usuarios WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(":email", $this->userModel->getEmail());
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userData) {
                return false;
            }
            
            // Verificar la contraseña utilizando password_verify
            if (password_verify($this->userModel->getContrasenia(), $userData['contrasena'])) {
                return true;
            }
                return false;
        } catch (PDOException $ex) {
            echo "Error en la conexión: " . $ex->getMessage();
        }
    }

}