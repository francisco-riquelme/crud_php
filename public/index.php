
<?php

// Se declara que el archivo de php este en modo estricto
declare(stric_types=1);


## Incluir los archivos necesarios (Cada vez que se agregue una nueva clase, se debe incluir aqui)
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Controller.php';


## Crear una instancia del router
$router = new Router();

## Ejecutar el router
$router->run();