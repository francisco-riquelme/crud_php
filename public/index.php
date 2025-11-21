<?php
declare(strict_types=1);
// Este es el punto de entrada de la aplicacion PHP desde /public/index.php


// ===== CONFIGURACIÓN SEGURA DE COOKIES DE SESIÓN =====

// Solo si usas HTTPS (si estás en HTTP ponlo en false TEMPORALMENTE)
$secure = false;  // cámbialo a true cuando uses HTTPS

session_set_cookie_params([
    'lifetime' => 0,           // dura hasta cerrar navegador
    'path' => '/',
    'domain' => '',            // en caso de dominios externos, se especifica
    'secure' => $secure,       // TRUE requiere HTTPS
    'httponly' => true,        // JS NO puede leer cookies
    'samesite' => 'Strict'     // previene robo de sesión por otros sitios
]);

// ===== INICIAR SESIÓN =====
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Se declara que el archivo de php este en modo estricto

## Incluir los archivos necesarios (Cada vez que se agregue una nueva clase, se debe incluir aqui)

// Incluir la configuracion de la base de datos que retorna la conexion
require_once __DIR__ . '/../config/database.php';

// Incluir la clase Router para manejar las rutas de la aplicacion
require_once __DIR__ . '/../app/core/Router.php';

// Incluir la clase Controller para manejar las vistas y modelos
require_once __DIR__ . '/../app/core/Controller.php';

require_once __DIR__ . '/../app/core/Session.php';

require_once __DIR__ . '/../app/core/Csrf.php';

require_once __DIR__ . '/../app/core/helpers.php';


## Crear una instancia del router
$router = new Router();

## Ejecutar el router
$router->run();

?>