<?php
require_once __DIR__ . '/../app/models/Usuario.php';

$usuario = new Usuario();

if ($usuario->createUserWithPassword("usuario", "prueba@test.com", "1234")) {
    echo "Usuario creado!";
} else {
    echo "Error al crear usuario";
}
