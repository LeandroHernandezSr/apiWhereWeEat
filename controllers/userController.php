<?php
class UserController {
    public function profile() {
        session_start();
        if (isset($_SESSION['usuario'])) {
            // Obtener información del usuario desde el modelo
            $userModel = new UserModel();
            $userData = $userModel->getUserData($_SESSION['usuario']);

            include 'views/profile_view.php';
        } else {
            header('Location: index.php');
        }
    }
}
?>
