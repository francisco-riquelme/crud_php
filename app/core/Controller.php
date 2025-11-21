<?php
require_once __DIR__ . '/Session.php';

class Controller {
    

    ## Método para cargar una vista con datos y un título opcional
    public function view(string $view, array $data = [], string $title = "Mi NUEVA APP ACTUALIZADA") {
        extract($data);


        ## Incluye el header, la vista específica y el footer
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/' . $view . '.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    ## Método para redirigir a una ruta específica
    public function redirect(string $path) {
        header('Location: /' . $path);
        exit();
    }

    ## Método para verificar si el usuario está autenticado
    public function requireAuth() {
        if (!isset($_SESSION['user'])) {
            Session::flash('error', 'Por favor, inicia sesión para continuar.');
            $this->redirect('auth/loginForm');
        }
    }



    public function requireRole(string $role){
        // Verificar login
        if (!isset($_SESSION['user'])) {
            Session::flash('error', 'Debes iniciar sesión primero.');
            return $this->redirect('auth/loginForm');
        }

        // Verificar que la clave "role" exista
        if (!isset($_SESSION['user']['role'])) {
            Session::flash('error', 'Rol de usuario no definido.');
            return $this->redirect('usuario/index');
        }

        // Verificar rol específico
        if ($_SESSION['user']['role'] !== $role) {
            Session::flash('error', 'No tienes permisos para acceder a esta sección .');
            return $this->redirect('usuario/index');
        }
    }

}