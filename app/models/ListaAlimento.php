<?php
class ListaAlimento {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Buscar todos os alimentos de um usuário
    public function buscarPorUsuario($usuario_id) {
        $stmt = $this->conn->prepare("SELECT * FROM lista_alimentos WHERE id_usuario = ? ORDER BY data_adicao DESC");
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result;
    }
    
    // Adicionar alimento à lista do usuário
    public function adicionar($usuario_id, $id_alimento, $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos) {
        $stmt = $this->conn->prepare("INSERT INTO lista_alimentos (id_usuario, id_alimento, descricao, categoria, energia, proteina, lipideos, carboidratos) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissssss", $usuario_id, $id_alimento, $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos);
        
        return $stmt->execute();
    }
    
    // Remover alimento da lista do usuário
    public function remover($usuario_id, $id_alimento) {
        $stmt = $this->conn->prepare("DELETE FROM lista_alimentos WHERE id_usuario = ? AND id_alimento = ?");
        $stmt->bind_param("ii", $usuario_id, $id_alimento);
        
        return $stmt->execute();
    }
    
    // Verificar se alimento já está na lista do usuário
    public function jaExiste($usuario_id, $id_alimento) {
        $stmt = $this->conn->prepare("SELECT id FROM lista_alimentos WHERE id_usuario = ? AND id_alimento = ?");
        $stmt->bind_param("ii", $usuario_id, $id_alimento);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    
    // Limpar toda a lista do usuário
    public function limparLista($usuario_id) {
        $stmt = $this->conn->prepare("DELETE FROM lista_alimentos WHERE id_usuario = ?");
        $stmt->bind_param("i", $usuario_id);
        
        return $stmt->execute();
    }
}
?>
