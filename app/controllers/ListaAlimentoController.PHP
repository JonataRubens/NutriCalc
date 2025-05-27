<?php
session_start();

include_once __DIR__ . '/../models/ListaAlimento.php';
include_once __DIR__ . '/../../public/includes/db_connection.php'; // ajuste o caminho conforme necessário

class ListaAlimentoController
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new ListaAlimento($conn);
    }

    // Exibe a lista de alimentos do usuário
    public function index()
    {
        $usuario_id = $_SESSION['usuario_id'] ?? null;
        if (!$usuario_id) {
            header('Location: /login');
            exit();
        }

        $result = $this->model->buscarPorUsuario($usuario_id);
        $alimentos = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $alimentos[] = $row;
            }
        }
        // Renderiza a view passando os alimentos
        include __DIR__ . '/../views/meusAlimentos/index.php';
    }

    // Adiciona um alimento à lista do usuário
    public function adicionar()
    {
        $usuario_id = $_SESSION['usuario_id'] ?? null;
        if (!$usuario_id) {
            echo json_encode(['success' => false, 'error' => 'Usuário não autenticado']);
            exit();
        }

        // Recebe dados do POST
        $id_alimento = $_POST['id_alimento'];
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $energia = $_POST['energia'];
        $proteina = $_POST['proteina'];
        $lipideos = $_POST['lipideos'];
        $carboidratos = $_POST['carboidratos'];

        // Verifica se já existe
        if ($this->model->jaExiste($usuario_id, $id_alimento)) {
            echo json_encode(['success' => false, 'error' => 'Alimento já está na sua lista']);
            exit();
        }

        $ok = $this->model->adicionar($usuario_id, $id_alimento, $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos);
        echo json_encode(['success' => $ok]);
    }

    // Remove um alimento da lista do usuário
    public function remover()
    {
        $usuario_id = $_SESSION['usuario_id'] ?? null;
        if (!$usuario_id) {
            echo json_encode(['success' => false, 'error' => 'Usuário não autenticado']);
            exit();
        }

        $id_alimento = $_POST['id_alimento'];
        $ok = $this->model->remover($usuario_id, $id_alimento);
        echo json_encode(['success' => $ok]);
    }

    // Limpa toda a lista do usuário
    public function limpar()
    {
        $usuario_id = $_SESSION['usuario_id'] ?? null;
        if (!$usuario_id) {
            echo json_encode(['success' => false, 'error' => 'Usuário não autenticado']);
            exit();
        }

        $ok = $this->model->limparLista($usuario_id);
        echo json_encode(['success' => $ok]);
    }
}

// Roteamento simples (exemplo)
$conn = $conn ?? (include __DIR__ . '/../../public/includes/db_connection.php'); // ajuste se necessário
$controller = new ListaAlimentoController($conn);

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'adicionar':
        $controller->adicionar();
        break;
    case 'remover':
        $controller->remover();
        break;
    case 'limpar':
        $controller->limpar();
        break;
    default:
        $controller->index();
        break;
}
?>
