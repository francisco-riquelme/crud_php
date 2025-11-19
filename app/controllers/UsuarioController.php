<?php

## Se incluye el modelo Usuario
require_once __DIR__ .'/../models/Usuario.php';

## Clase controlador para manejar las operaciones relacionadas con los usuarios
class UsuarioController extends Controller {

    
    ## Método para mostrar la lista de usuarios
    public function index() {

        try {

            ## Crea una instancia o objeto de la clase Usuario (modelo)
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /usuario/index');
            exit;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($nombre === '' || $email === '') {
            die("Error: Nombre y Email son obligatorios.");
        }

        $usuarioModel = new Usuario();
        $usuarioModel->create($nombre, $email);

        Session::flash('success', 'Usuario creado correctamente');
        header("Location: /usuario/index");
        exit;
    }

    //Eliminar un usuario
    public function delete($id) {
        $usuarioModel = new Usuario();
        $usuarioModel->delete($id);

        // Redirigir de vuelta a la lista de usuarios
        Session::flash('success', 'Usuario eliminado correctamente');
        header('Location: /usuario/index');
        exit;
    }

    public function edit($id) {
        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            die("Usuario no encontrado.");
        }

        $this->view('usuario/editar', ['usuario' => $usuario]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /usuario/index');
            exit;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($nombre === '' || $email === '') {
            die("Error: Nombre y Email son obligatorios.");
        }

        $usuarioModel = new Usuario();
        $usuarioModel->update($id, $nombre, $email);


        Session::flash('success', 'Usuario actualizado correctamente');
        header('Location: /usuario/index');
        exit;
    }


}