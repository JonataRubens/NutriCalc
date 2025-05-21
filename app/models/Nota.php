<?php
class Nota {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Buscar todas as notas de um usuário
    public function buscarPorUsuario($usuario_id) {
        $stmt = $this->conn->prepare("SELECT * FROM notas WHERE id_usuario = ? ORDER BY data_criacao DESC");
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result;
    }
    
    // Buscar uma nota específica
    public function buscarPorId($id, $usuario_id) {
        $stmt = $this->conn->prepare("SELECT * FROM notas WHERE id = ? AND id_usuario = ?");
        $stmt->bind_param("ii", $id, $usuario_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Criar nova nota
    public function criar($titulo, $conteudo, $usuario_id) {
        $stmt = $this->conn->prepare("INSERT INTO notas (titulo, conteudo, id_usuario) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $titulo, $conteudo, $usuario_id);
        
        return $stmt->execute();
    }
    
    // Atualizar nota existente
    public function atualizar($id, $titulo, $conteudo, $usuario_id) {
        $stmt = $this->conn->prepare("UPDATE notas SET titulo = ?, conteudo = ? WHERE id = ? AND id_usuario = ?");
        $stmt->bind_param("ssii", $titulo, $conteudo, $id, $usuario_id);
        
        return $stmt->execute();
    }
    
    // Excluir nota
    public function excluir($id, $usuario_id) {
        $stmt = $this->conn->prepare("DELETE FROM notas WHERE id = ? AND id_usuario = ?");
        $stmt->bind_param("ii", $id, $usuario_id);
        
        return $stmt->execute();
    }
}
