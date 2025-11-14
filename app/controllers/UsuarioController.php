<?php

## Se incluye el modelo Usuario
require_once __DIR__ .'/../models/Usuario.php';

## Clase controlador para manejar las operaciones relacionadas con los usuarios
class UsuarioController extends Controller {

    
    ## Método para mostrar la lista de usuarios
    public function mostrarTodosUsuarios() {

        try {

            ## Crea una instancia o objeto de la clase Usuario (modelo)
            $usuarioModel = new Usuario();

            ## Almacena en la variable Usuarios el metodo getAllUsers() del modelo Usuario
            $usuarios = $usuarioModel->getAllUsers();

            ## Carga la vista index.php y le pasa la variable usuarios
            $this->view('usuario/index', ['usuarios' => $usuarios]);
        } catch (Exception $e) {
            die("Error al mostrar la lista de usuarios: " . $e->getMessage());
        }
    }

    public function crearUsuario() {
        ## Verifica si el formulario ha sido enviado
        $this->view('usuario/crear');
    }
}