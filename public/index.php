<?php
declare(strict_types=1);
// Este es el punto de entrada de la aplicacion PHP desde /public/index.php


// Se declara que el archivo de php este en modo estricto

## Incluir los archivos necesarios (Cada vez que se agregue una nueva clase, se debe incluir aqui)

// Incluir la configuracion de la base de datos que retorna la conexion
require_once __DIR__ . '/../config/database.php';

// Incluir la clase Router para manejar las rutas de la aplicacion
require_once __DIR__ . '/../app/core/Router.php';

// Incluir la clase Controller para manejar las vistas y modelos
require_once __DIR__ . '/../app/core/Controller.php';

// Incluir la clase App para iniciar la sesion en toda la aplicacion si no ha sido iniciada
require_once __DIR__ . '/../app/core/App.php';


## Crear una instancia del router
$router = new Router();

## Ejecutar el router
$router->run();

?>