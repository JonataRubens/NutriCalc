<?php
session_start();
require_once __DIR__ . '/db_connection.php';
require_once __DIR__ . '/../../app/models/ListaAlimento.php';

// Verifica se usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Usuário não logado']);
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$listaModel = new ListaAlimento($conn);

// Determina a ação
$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';

switch ($acao) {
    case 'carregar':
        // Carrega a lista do usuário
        $result = $listaModel->buscarPorUsuario($usuario_id);
        $alimentos = [];
        
        while ($row = $result->fetch_assoc()) {
            $alimentos[] = [
                'id' => $row['id_alimento'],
                'descricao' => $row['descricao'],
                'categoria' => $row['categoria'],
                'energia' => $row['energia'],
                'proteina' => $row['proteina'],
                'lipideos' => $row['lipideos'],
                'carboidratos' => $row['carboidratos']
            ];
        }
        
        echo json_encode($alimentos);
        break;
        
    case 'adicionar':
        // Adiciona alimento à lista
        $id_alimento = $_POST['id_alimento'] ?? 0;
        $descricao = $_POST['descricao'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $energia = $_POST['energia'] ?? '';
        $proteina = $_POST['proteina'] ?? '';
        $lipideos = $_POST['lipideos'] ?? '';
        $carboidratos = $_POST['carboidratos'] ?? '';
        
        if ($listaModel->jaExiste($usuario_id, $id_alimento)) {
            echo json_encode(['error' => 'Alimento já está na lista']);
        } else {
            $sucesso = $listaModel->adicionar($usuario_id, $id_alimento, $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos);
            echo json_encode(['success' => $sucesso]);
        }
        break;
        
    case 'remover':
        // Remove alimento da lista
        $id_alimento = $_POST['id_alimento'] ?? 0;
        $sucesso = $listaModel->remover($usuario_id, $id_alimento);
        echo json_encode(['success' => $sucesso]);
        break;
        
    case 'limpar':
        // Limpa toda a lista
        $sucesso = $listaModel->limparLista($usuario_id);
        echo json_encode(['success' => $sucesso]);
        break;
        
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Ação inválida']);
}
?>
