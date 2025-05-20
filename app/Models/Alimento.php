<?php
// Model responsável pelas operações com alimentos
class Alimento {
    private $conn;

    public function __construct() {
        require_once __DIR__ . '/../../includes/db_connection.php';
        $this->conn = getDbConnection();
    }

    // Busca alimentos por termo de pesquisa
    public function buscar($termo) {
        $termo = "%$termo%";
        $stmt = $this->conn->prepare('SELECT * FROM alimentos WHERE descricao LIKE ? OR categoria LIKE ?');
        $stmt->bind_param('ss', $termo, $termo);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Busca alimentos por categoria
    public function buscarPorCategoria($categoria) {
        $stmt = $this->conn->prepare('SELECT * FROM alimentos WHERE categoria = ?');
        $stmt->bind_param('s', $categoria);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Busca todos os alimentos
    public function listarTodos() {
        $result = $this->conn->query('SELECT * FROM alimentos');
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
