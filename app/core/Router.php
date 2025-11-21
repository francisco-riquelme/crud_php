<?php



class Router {



    public function run() {

        // Obtener la URL solicitada y la analiza para determinar el controlador y la acción
        $url = $_GET['url'] ?? 'home/index';
        // Eliminar barras diagonales al inicio y al final
        $url = trim($url, '/');
        // Dividir la URL en partes
        $urlParts = explode('/', $url);

        // Determinar el controlador y la acción
        $controllerName = ucfirst($urlParts[0]) . 'Controller';

        // Acción por defecto si no se proporciona
        // Si no se proporciona un método, se usa 'index' por defecto
        $method = $urlParts[1] ?? 'index';


        // Si no se proporciona un parámetro, se establece como null
        $param = $urlParts[2] ?? null;

        // Incluir el archivo del controlador
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';


        // Verificar si el archivo del controlador existe
        if (!file_exists($controllerFile)) {
            http_response_code(404);
            require_once __DIR__ . '/../views/errors/404.php';
            exit;
        }

        // Incluir el archivo del controlador
        require_once $controllerFile;


        // Validacion de errores de clase y metodo
        if (!class_exists($controllerName)) {
            http_response_code(404);
            require_once __DIR__ . '/../views/errors/404.php';
            exit;
        }

        // Crear una instancia del controlador
        $controller = new $controllerName();


        // Verificar si el método existe en el controlador
        if (!method_exists($controller, $method)) {
            http_response_code(404);
            require_once __DIR__ . '/../views/errors/404.php';
            exit;}


        // Obtener parámetros dinámicos (todos los que vengan después del método)
        $params = array_slice($urlParts, 2);


        // Evitar continuar si ya hubo una redirección
        if (headers_sent()) {
            return;
        }
        // Ejecutar el método con los parámetros necesarios
        return call_user_func_array([$controller, $method], $params);

    
    }
}