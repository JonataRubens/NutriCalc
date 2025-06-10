<?php 

class Usuario{
    public $id;
    public $nome;
    public $sobrenome;
    public $email;
    public $senha;
    public $criado_em;

    public function __construct($row) {
        $this->id = $row['id'] ?? null;
        $this->nome = $row['nome'] ?? null;
        $this->sobrenome = $row['sobrenome'] ?? null;
        $this->email = $row['email'] ?? null;
        $this->senha = $row['senha'] ?? null;
        $this->criado_em = $row['criado_em'] ?? null;
    }

    // Retorna os dados como array associativo
    public function toArray($showSenha = true) {
        $arr = [
            'id' => $this->id,
            'nome' => $this->nome,
            'sobrenome' => $this->sobrenome,
            'email' => $this->email,
            'criado_em' => $this->criado_em
        ];
        if ($showSenha) {
            $arr['senha'] = $this->senha;
        }
        return $arr;
    }
    public static function listar($conn) {
        $result = $conn->query("SELECT * FROM usuarios");
        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuario = new Usuario($row);
            $usuarios[] = $usuario->toArray(false); // Não mostra senha
        }
        return $usuarios;
    }
    // Adicionar usuário
    public static function adicionar($conn, $data) {
        if (empty($data['nome']) || empty($data['sobrenome']) || empty($data['email']) || empty($data['senha'])) {
            return "Todos os campos são obrigatórios!";
        }
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss",
            $data['nome'],
            $data['sobrenome'],
            $data['email'],
            password_hash($data['senha'], PASSWORD_DEFAULT)
        );
        if ($stmt->execute()) {
            return "Usuário adicionado com sucesso!";
        } else {
            return "Erro ao adicionar usuário: " . $stmt->error;
        }
    }
    // Buscar usuário por ID
    public static function buscarPorId($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return new Usuario($result->fetch_assoc());
        }
        
        return null; // Retorna null se não encontrar
    }
    // editar usuário
    public static function editar($conn, $id, $data) {
        $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, sobrenome = ?, email = ?, senha = ? WHERE id = ?");
        $stmt->bind_param(
            "ssssi",
            $data['nome'],
            $data['sobrenome'],
            $data['email'],
            password_hash($data['senha'], PASSWORD_DEFAULT),
            $id
        );
        if ($stmt->execute()) {
            return "Usuário atualizado com sucesso!";
        } else {
            return "Erro ao atualizar usuário: " . $stmt->error;
        }
    }
    // Deletar usuário
    public static function deletar($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return "Usuário deletado com sucesso!";
        } else {
            return "Erro ao deletar usuário: " . $stmt->error;
        }
    }

}