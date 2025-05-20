<?php
// Model responsável pelas operações com usuários
class Usuario {
    private $conn;

    public function __construct() {
        require_once __DIR__ . '/../../includes/db_connection.php';
        $this->conn = getDbConnection();
    }

    // Autentica um usuário pelo email e senha
    public function autenticar($email, $senha) {
        $stmt = $this->conn->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }

    // Cria um novo usuário
    public function criar($nome, $email, $senha) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $nome, $email, $hash);
        return $stmt->execute();
    }

    // Busca usuário por ID
    public function buscarPorId($id) {
        $stmt = $this->conn->prepare('SELECT * FROM usuarios WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Verifica se email já existe
    public function emailExiste($email) {
        $stmt = $this->conn->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
}
