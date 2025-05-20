<?php
// Controller responsável pela página inicial
class HomeController {
    // Método padrão para exibir a home
    public function index() {
        // Inclui a view da home
        require __DIR__ . '/../Views/home/index.php';
    }
}
