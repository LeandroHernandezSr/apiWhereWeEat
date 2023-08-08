<?php
class LoginController {
    public function index() {
        include 'views/login_view.php';
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Realizar la validación del usuario y contraseña aquí (ejemplo simplificado)
        if ($username === 'usuario' && $password === 'contraseña') {
            session_start();
            $_SESSION['usuario'] = $username;

            // Crear cookie de sesión
            setcookie('usuario', $username, time() + 3600, '/'); // Cookie válida por 1 hora

            header('Location: index.php');
        } else {
            echo 'Credenciales inválidas';
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        
       
        setcookie('usuario', '', time() - 3600, '/');

        header('Location: index.php');
    }
}


?>
