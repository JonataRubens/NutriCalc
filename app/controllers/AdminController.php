<?php
class DashboardController {
    private $model;
    
    public function __construct($database_connection) {
        require_once 'models/DashboardModel.php';
        $this->model = new DashboardModel($database_connection);
    }
    
    public function index() {
        // Verificar sessão
        $user_id = $this->model->verificarSessao();
        $nome_usuario_logado = $this->model->getNomeUsuarioLogado($user_id);
        
        // Processar paginação
        $pagina_usuarios = isset($_GET['p_usuarios']) ? (int)$_GET['p_usuarios'] : 1;
        $pagina_alimentos = isset($_GET['p_alimentos']) ? (int)$_GET['p_alimentos'] : 1;
        
        // Obter dados
        $data = [
            'usuarios' => $this->model->getUsuarios($pagina_usuarios),
            'alimentos' => $this->model->getAlimentos($pagina_alimentos),
            'total_paginas_usuarios' => $this->model->getTotalPaginasUsuarios(),
            'total_paginas_alimentos' => $this->model->getTotalPaginasAlimentos(),
            'nome_usuario_logado' => $nome_usuario_logado,
            'pagina_usuarios' => $pagina_usuarios,
            'pagina_alimentos' => $pagina_alimentos
        ];
        
        // Processar formulários
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['message'] = $this->processarFormularios();
        }
        
        // Carregar a view
        $this->loadView('dashboard', $data);
    }
    
    private function processarFormularios() {
        if (isset($_POST['add_user'])) {
            return $this->model->adicionarUsuario(
                $_POST['nome'],
                $_POST['sobrenome'], 
                $_POST['email'],
                $_POST['senha']
            );
        }
        
        if (isset($_POST['add_food'])) {
            return $this->model->adicionarAlimento(
                $_POST['descricao'],
                $_POST['categoria'],
                $_POST['energia'],
                $_POST['proteina'],
                $_POST['lipideos'],
                $_POST['carboidratos']
            );
        }
        
        return null;
    }
    
    private function loadView($view, $data = []) {
        extract($data);
        require_once "views/{$view}.php";
    }
}
