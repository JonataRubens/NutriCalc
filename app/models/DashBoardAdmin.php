<?php
class DashboardModel {
    private $conn;
    private $registros_por_pagina = 15;
    
    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }
    
    // Métodos para Usuários
    public function getUsuarios($pagina = 1) {
        $inicio = ($pagina - 1) * $this->registros_por_pagina;
        $sql = "SELECT * FROM usuarios LIMIT $inicio, {$this->registros_por_pagina}";
        return $this->conn->query($sql);
    }
    
    public function getTotalUsuarios() {
        $sql = "SELECT COUNT(*) AS total FROM usuarios";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }
    
    public function getTotalPaginasUsuarios() {
        return ceil($this->getTotalUsuarios() / $this->registros_por_pagina);
    }
    
    public function getUsuarioById($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function getUsuarioByEmail($email) {
        $sql = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    
    public function adicionarUsuario($nome, $sobrenome, $email, $senha) {
        if ($this->getUsuarioByEmail($email)) {
            return ['success' => false, 'message' => 'Este e-mail já está cadastrado!'];
        }
        
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $sobrenome, $email, $senha_hash);
        
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Usuário adicionado com sucesso!'];
        } else {
            return ['success' => false, 'message' => 'Erro ao adicionar usuário: ' . $this->conn->error];
        }
    }
    
    public function atualizarUsuario($id, $nome, $sobrenome, $email) {
        $sql = "UPDATE usuarios SET nome = ?, sobrenome = ?, email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $nome, $sobrenome, $email, $id);
        return $stmt->execute();
    }
    
    public function deletarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    // Métodos para Alimentos
    public function getAlimentos($pagina = 1) {
        $inicio = ($pagina - 1) * $this->registros_por_pagina;
        $sql = "SELECT * FROM alimentos LIMIT $inicio, {$this->registros_por_pagina}";
        return $this->conn->query($sql);
    }
    
    public function getTotalAlimentos() {
        $sql = "SELECT COUNT(*) AS total FROM alimentos";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }
    
    public function getTotalPaginasAlimentos() {
        return ceil($this->getTotalAlimentos() / $this->registros_por_pagina);
    }
    
    public function getAlimentoById($id) {
        $sql = "SELECT * FROM alimentos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function adicionarAlimento($descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos) {
        // Validação dos campos
        if (empty($descricao) || empty($categoria) || empty($energia) || empty($proteina) || empty($lipideos) || empty($carboidratos)) {
            return ['success' => false, 'message' => 'Por favor, preencha todos os campos.'];
        }
        
        $sql = "INSERT INTO alimentos (descricao, categoria, energia, proteina, lipideos, carboidratos) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdddd", $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos);
        
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Alimento adicionado com sucesso!'];
        } else {
            return ['success' => false, 'message' => 'Erro ao adicionar alimento: ' . $this->conn->error];
        }
    }
    
    public function atualizarAlimento($id, $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos) {
        $sql = "UPDATE alimentos SET descricao = ?, categoria = ?, energia = ?, proteina = ?, lipideos = ?, carboidratos = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssddddi", $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos, $id);
        return $stmt->execute();
    }
    
    public function deletarAlimento($id) {
        $sql = "DELETE FROM alimentos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    // Métodos de Autenticação
    public function verificarSessao() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: /Urls.php?page=admin');
            exit();
        }
        
        return $_SESSION['user_id'];
    }
    
    public function getNomeUsuarioLogado($user_id) {
        $sql = "SELECT nome FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            return $user_data['nome'];
        } else {
            header('Location: /Urls.php?page=admin');
            exit();
        }
    }
    
    // Métodos de Busca e Filtros
    public function buscarUsuarios($termo, $pagina = 1) {
        $inicio = ($pagina - 1) * $this->registros_por_pagina;
        $sql = "SELECT * FROM usuarios WHERE nome LIKE ? OR sobrenome LIKE ? OR email LIKE ? LIMIT $inicio, {$this->registros_por_pagina}";
        $stmt = $this->conn->prepare($sql);
        $termo_busca = "%$termo%";
        $stmt->bind_param("sss", $termo_busca, $termo_busca, $termo_busca);
        $stmt->execute();
        return $stmt->get_result();
    }
    
    public function buscarAlimentos($termo, $pagina = 1) {
        $inicio = ($pagina - 1) * $this->registros_por_pagina;
        $sql = "SELECT * FROM alimentos WHERE descricao LIKE ? OR categoria LIKE ? LIMIT $inicio, {$this->registros_por_pagina}";
        $stmt = $this->conn->prepare($sql);
        $termo_busca = "%$termo%";
        $stmt->bind_param("ss", $termo_busca, $termo_busca);
        $stmt->execute();
        return $stmt->get_result();
    }
    
    // Métodos de Estatísticas
    public function getEstatisticasDashboard() {
        $stats = [];
        
        // Total de usuários
        $stats['total_usuarios'] = $this->getTotalUsuarios();
        
        // Total de alimentos
        $stats['total_alimentos'] = $this->getTotalAlimentos();
        
        // Usuários cadastrados hoje
        $sql = "SELECT COUNT(*) as total FROM usuarios WHERE DATE(created_at) = CURDATE()";
        $result = $this->conn->query($sql);
        $stats['usuarios_hoje'] = $result ? $result->fetch_assoc()['total'] : 0;
        
        // Alimentos por categoria
        $sql = "SELECT categoria, COUNT(*) as total FROM alimentos GROUP BY categoria";
        $result = $this->conn->query($sql);
        $stats['alimentos_por_categoria'] = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $stats['alimentos_por_categoria'][] = $row;
            }
        }
        
        return $stats;
    }
    
    // Método para validar dados
    public function validarDados($dados, $tipo) {
        $erros = [];
        
        if ($tipo === 'usuario') {
            if (empty($dados['nome'])) $erros[] = 'Nome é obrigatório';
            if (empty($dados['sobrenome'])) $erros[] = 'Sobrenome é obrigatório';
            if (empty($dados['email'])) $erros[] = 'Email é obrigatório';
            if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) $erros[] = 'Email inválido';
            if (empty($dados['senha']) && !isset($dados['id'])) $erros[] = 'Senha é obrigatória';
        }
        
        if ($tipo === 'alimento') {
            if (empty($dados['descricao'])) $erros[] = 'Descrição é obrigatória';
            if (empty($dados['categoria'])) $erros[] = 'Categoria é obrigatória';
            if (!is_numeric($dados['energia'])) $erros[] = 'Energia deve ser um número';
            if (!is_numeric($dados['proteina'])) $erros[] = 'Proteína deve ser um número';
            if (!is_numeric($dados['lipideos'])) $erros[] = 'Lipídeos deve ser um número';
            if (!is_numeric($dados['carboidratos'])) $erros[] = 'Carboidratos deve ser um número';
        }
        
        return $erros;
    }
}
?>
