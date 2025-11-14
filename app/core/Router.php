
<?php



class Router {

    public function run() {

        $url = $_GET['url'] ?? 'home/index';
        $url = trim($url, '/');
        $urlParts = explode('/', $url);

        $controllerName = ucfirst($urlParts[0]) . 'Controller';
        $method = $urlParts[1] ?? 'index';

        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            http_response_code(404);
            echo "Controller not found.";
            exit;
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            http_response_code(404);
            echo "Controller class not found.";
            exit;
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            http_response_code(404);
            echo "Action not found.";
            exit;
        }

        $controller->$method();

    
        
    
    
    
    }
}