<?php
// Controller responsável pelas operações relacionadas a alimentos
class AlimentoController {
    // Endpoint para busca AJAX de alimentos
    public function buscar() {
        header('Content-Type: application/json');
        require_once __DIR__ . '/../Models/Alimento.php';
        $alimentoModel = new Alimento();
        $termo = $_GET['term'] ?? '';
        $resultados = $alimentoModel->buscar($termo);
        echo json_encode($resultados);
        exit;
    }
    // Endpoint para busca por categoria
    public function categoria() {
        header('Content-Type: application/json');
        require_once __DIR__ . '/../Models/Alimento.php';
        $alimentoModel = new Alimento();
        $categoria = $_GET['categoria'] ?? '';
        $resultados = $alimentoModel->buscarPorCategoria($categoria);
        echo json_encode($resultados);
        exit;
    }
}
