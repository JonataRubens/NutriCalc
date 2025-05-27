<?php
class NotasController {
    private $notaModel;
    private $conn;
    
    public function __construct($database_connection) {
        $this->conn = $database_connection;
        require_once __DIR__ . '/../models/Nota.php';
        $this->notaModel = new Nota($database_connection);
    }
    
    // Verificar se usuário está logado
    private function verificarAutenticacao() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /');
            exit();
        }
        
        return $_SESSION['usuario_id'];
    }
    
    // Listar todas as notas do usuário
    public function index() {
        $usuario_id = $this->verificarAutenticacao();
        
        $data = [
            'notas' => $this->notaModel->buscarPorUsuario($usuario_id),
            'usuario_id' => $usuario_id
        ];
        
        $this->loadView('notas/index', $data);
    }
    
    // Exibir formulário de nova nota
    public function create() {
        $usuario_id = $this->verificarAutenticacao();
        
        $data = [
            'usuario_id' => $usuario_id,
            'titulo' => '',
            'conteudo' => ''
        ];
        
        $this->loadView('notas/create', $data);
    }
    
    // Salvar nova nota
    public function store() {
        $usuario_id = $this->verificarAutenticacao();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo'] ?? '');
            $conteudo = trim($_POST['conteudo'] ?? '');
            
            // Validação
            if (empty($titulo) || empty($conteudo)) {
                $data = [
                    'error' => 'Título e conteúdo são obrigatórios',
                    'titulo' => $titulo,
                    'conteudo' => $conteudo,
                    'usuario_id' => $usuario_id
                ];
                $this->loadView('notas/create', $data);
                return;
            }
            
            if ($this->notaModel->criar($titulo, $conteudo, $usuario_id)) {
                header('Location: /Urls.php?page=notas&success=created');
                exit();
            } else {
                $data = [
                    'error' => 'Erro ao criar nota',
                    'titulo' => $titulo,
                    'conteudo' => $conteudo,
                    'usuario_id' => $usuario_id
                ];
                $this->loadView('notas/create', $data);
            }
        }
    }
    
    // Exibir formulário de edição
    public function edit() {
        $usuario_id = $this->verificarAutenticacao();
        $nota_id = $_GET['id'] ?? null;
        
        if (!$nota_id) {
            header('Location: /Urls.php?page=notas');
            exit();
        }
        
        $nota = $this->notaModel->buscarPorId($nota_id, $usuario_id);
        
        if (!$nota) {
            header('Location: /Urls.php?page=notas&error=not_found');
            exit();
        }
        
        $data = [
            'nota' => $nota,
            'usuario_id' => $usuario_id
        ];
        
        $this->loadView('notas/edit', $data);
    }
    
    // Atualizar nota
    public function update() {
        $usuario_id = $this->verificarAutenticacao();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nota_id = $_POST['id'] ?? null;
            $titulo = trim($_POST['titulo'] ?? '');
            $conteudo = trim($_POST['conteudo'] ?? '');
            
            // Validação
            if (!$nota_id || empty($titulo) || empty($conteudo)) {
                header('Location: /Urls.php?page=edit-notas&id=' . $nota_id . '&error=validation');
                exit();
            }
            
            if ($this->notaModel->atualizar($nota_id, $titulo, $conteudo, $usuario_id)) {
                header('Location: /Urls.php?page=notas&success=updated');
                exit();
            } else {
                header('Location: /Urls.php?page=edit-notas&id=' . $nota_id . '&error=update_failed');
                exit();
            }
        }
    }
    
    // Excluir nota
    public function delete() {
        $usuario_id = $this->verificarAutenticacao();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nota_id = $_POST['id'] ?? null;
            
            if (!$nota_id) {
                header('Location: /Urls.php?page=notas&error=invalid_id');
                exit();
            }
            
            if ($this->notaModel->excluir($nota_id, $usuario_id)) {
                header('Location: /Urls.php?page=notas&success=deleted');
                exit();
            } else {
                header('Location: /Urls.php?page=notas&error=delete_failed');
                exit();
            }
        }
    }
    
    // Carregar view
    private function loadView($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../views/{$view}.php";
    }
}
