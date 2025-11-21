<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../core/Session.php';

## Clase controlador para manejar las operaciones relacionadas con los usuarios
class AuthController extends Controller {

    private int $maxAttempts = 5;
    private int $lockTime = 900; // 15 minutos en segundos
    
    ## Método para mostrar la página de login ruta /auth/login
    public function loginForm() {
        $this->view('auth/login', [], 'Login');
    }

    public function login(){   

        ## Validar el token CSRF
        if (!Csrf::validateToken($_POST['csrf_token'] ?? '')) {
            Session::flash('error', 'Token CSRF inválido.');
            return $this->redirect('auth/loginForm');
        }

        // --- RATE LIMIT CHECK ---
        if (isset($_SESSION['lock_time']) && time() < $_SESSION['lock_time']) {
            $segundosRestantes = $_SESSION['lock_time'] - time();
            Session::flash('error', "Demasiados intentos. Intenta nuevamente en {$segundosRestantes} segundos.");
            return $this->redirect('auth/loginForm');
        }

        // Si no existe el contador, iniciarlo
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
        }


        ## Obtiene los datos del formulario de login
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        ## Busca el usuario por su email
        $usuarioModel = new Usuario();
        ## Obtiene el usuario por su email
        $usuario = $usuarioModel->getByEmail($email);

        ## Verifica si el usuario existe y si la contraseña es correcta
        if (!$usuario) {
            $_SESSION['login_attempts']++;

            if ($_SESSION['login_attempts'] >= $this->maxAttempts) {
                $_SESSION['lock_time'] = time() + $this->lockTime; 
                Session::flash('error', 'Demasiados intentos fallidos. Intenta más tarde.');
                return $this->redirect('auth/loginForm');
            }

            Session::flash('error', 'Correo o contraseña no encontrado');
            return $this->redirect('auth/loginForm');
        }


        ## Verifica si la contraseña es correcta
        if (!password_verify($password, $usuario['password_hash'])) {
            $_SESSION['login_attempts']++;

            if ($_SESSION['login_attempts'] >= $this->maxAttempts) {
                $_SESSION['lock_time'] = time() + $this->lockTime;
                Session::flash('error', 'Demasiados intentos fallidos. Intenta más tarde.');
                return $this->redirect('auth/loginForm');
            }

            Session::flash('error', 'Correo o contraseña no encontrado');
            return $this->redirect('auth/loginForm');
        }


        ## Inicia la sesión del usuario
        session_regenerate_id(true);

        // Resetear rate limit
        unset($_SESSION['login_attempts'], $_SESSION['lock_time']);


        ## Almacena los datos del usuario en la sesión
        $_SESSION['user'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'email' => $usuario['email'],
            'role' => $usuario['role'],
        ];

        ## Redirige al usuario a la página principal después de iniciar sesión
        Session::flash('success', 'Bienvenido ' . $usuario['nombre'] . '!');
        return $this->redirect('usuario/index');
    }

    public function logout()
    {
        // Guardamos el flash antes de matar todo
        $msg = "Sesión cerrada correctamente.";

        // Limpiar sesión
        $_SESSION = [];

        // // Borrar cookie ANTES del session_destroy()
        // if (ini_get("session.use_cookies")) {
        //     $params = session_get_cookie_params();
        //     setcookie(session_name(), '', time() - 42000,
        //         $params['path'], $params['domain'],
        //         $params['secure'], $params['httponly']
        //     );
        // }

        // Destruir la sesión en el servidor
        session_destroy();

        // Crear una sesión nueva y limpia
        session_start();
        Session::flash('success', $msg);

        // Redirigir
        $this->redirect('auth/loginForm');
    }




}