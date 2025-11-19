<?php
require_once __DIR__ . '/Session.php';

class Controller {
    
    public function view(string $view, array $data = [], string $title = "Mi NUEVA APP ACTUALIZADA") {
        extract($data);

        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/' . $view . '.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }
}