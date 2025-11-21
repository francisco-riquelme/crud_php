<?php

## Se incluye el modelo Usuario
require_once __DIR__ .'/../models/Usuario.php';

## Clase controlador para manejar las operaciones relacionadas con los usuarios
class UsuarioController extends Controller {

    public function __construct() {} 

    ## Método para mostrar la lista de usuarios
    public function index() {

        try {
            $this->requireAuth(); // Verifica si el usuario está autenticado
            
            ## Crear una instancia del modelo Usuario
            $usuarioModel = new Usuario();

            ## Almacena en la variable Usuarios el metodo getAllUsers() del modelo Usuario
            $usuarios = $usuarioModel->all();

            ## Carga la vista index.php y le pasa la variable usuarios
            $this->view('usuario/index', ['usuarios' => $usuarios], 'Usuario Listado');
        } catch (Exception $e) {
            die("Error al mostrar la lista de usuarios: " . $e->getMessage());
        }
    }

    public function create() {
        ## Verifica si el formulario ha sido enviado
        $this->view('usuario/crear', [], 'Crear Usuario');
    }

    // Método para guardar un nuevo usuario
    public function store() {


        // 1. Método correcto
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('usuario/index');
        }

        if (!Csrf::validateToken($_POST['csrf_token'] ?? '')) {
            Session::flash('error', 'Token CSRF inválido.');
            return $this->redirect('usuario/create');
        }

        // 2. Sanitizar datos
        $nombre = trim($_POST['nombre'] ?? '');
        $email  = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // 3. Validaciones
        if ($nombre === '' || $email === '' || $password === '') {
            Session::flash('error', 'Todos los campos son obligatorios.');
            $this->redirect('usuario/create');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('error', 'El correo ingresado no es válido.');
            $this->redirect('usuario/create');
            return;
        }

        if (strlen($nombre) < 3) {
            Session::flash('error', 'El nombre debe tener al menos 3 caracteres.');
            $this->redirect('usuario/create');
            return;
        }

        if (strlen($password) < 6) {
            Session::flash('error', 'La contraseña debe tener al menos 6 caracteres.');
            $this->redirect('usuario/create');
            return;
        }

        // 4. Email duplicado
        $usuarioModel = new Usuario();
        $userExists = $usuarioModel->getByEmail($email);

        if ($userExists) {
            Session::flash('error', 'Este correo ya está registrado.');
            return $this->redirect('usuario/create');
            
        }

        // 5. Intentar crear usuario
        if ($usuarioModel->create($nombre, $email, $password)) {
            Session::flash('success', 'Usuario creado correctamente.');
        } else {
            Session::flash('error', 'Hubo un problema al crear el usuario.');
        }

        return $this->redirect('usuario/index');
    }

    ##- --------------------------------------------------- -------------------------------------------------------

    //Eliminar un usuario
    public function delete($id) {
        $this->requireAuth(); // Verifica si el usuario está autenticado
        $this->requireRole('admin'); // Verifica si el usuario tiene rol de admin

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('usuario/index');
           
        }

        if (!Csrf::validateToken($_POST['csrf_token'] ?? '')) {
            Session::flash('error', 'Token CSRF inválido.');
            return $this->redirect('usuario/index');
        }

        $id = intval($id);

        if ($id === 0 || $id == '') {
            die("Error: ID de usuario inválido.");
        }

        $usuarioModel = new Usuario();
        $usuarioModel->delete($id);

        // Redirigir de vuelta a la lista de usuarios
        Session::flash('success', 'Usuario eliminado correctamente');
        return $this->redirect('usuario/index');
        
    }

    public function edit($id) {
        $this->requireAuth(); // Verifica si el usuario está autenticado

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            die("Usuario no encontrado.");
        }

        $this->view('usuario/editar', ['usuario' => $usuario]);
    }

    public function update($id) {
        $this->requireAuth(); // Verifica si el usuario está autenticado


        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('usuario/index');
           
        }

        if (!Csrf::validateToken($_POST['csrf_token'] ?? '')) {
            Session::flash('error', 'Token CSRF inválido.');
            return $this->redirect('usuario/update/' . $id);
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($nombre === '' || $email === '') {
            die("Error: Nombre y Email son obligatorios.");
        }

        $usuarioModel = new Usuario();
        $usuarioModel->update($id, $nombre, $email);


        Session::flash('success', 'Usuario actualizado correctamente');
        return $this->redirect('usuario/index');
       
    }

}