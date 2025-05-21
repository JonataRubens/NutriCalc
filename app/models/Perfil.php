<?php
class Perfil {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Buscar perfil de um usuário
    public function buscarPorUsuario($usuario_id) {
        $stmt = $this->conn->prepare("SELECT * FROM perfil_usuario WHERE usuario_id = ?");
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        // Retorna array vazio se não encontrar
        return [
            'peso' => '',
            'idade' => '',
            'altura' => '',
            'ativo' => '',
            'sexo' => '',
            'objetivo' => '',
        ];
    }
    
    // Salvar ou atualizar perfil
    public function salvar($usuario_id, $dados) {
        // Verificar se o perfil já existe
        $perfil = $this->buscarPorUsuario($usuario_id);
        
        if (isset($perfil['usuario_id'])) {
            // Atualizar
            $stmt = $this->conn->prepare("UPDATE perfil_usuario SET peso = ?, idade = ?, altura = ?, ativo = ?, sexo = ?, objetivo = ? WHERE usuario_id = ?");
            $stmt->bind_param("diidssi", 
                $dados['peso'], 
                $dados['idade'], 
                $dados['altura'], 
                $dados['ativo'], 
                $dados['sexo'], 
                $dados['objetivo'], 
                $usuario_id
            );
            
            return $stmt->execute() ? "Perfil atualizado com sucesso!" : "Erro ao atualizar perfil.";
        } else {
            // Inserir
            $stmt = $this->conn->prepare("INSERT INTO perfil_usuario (usuario_id, peso, idade, altura, ativo, sexo, objetivo) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("idiidss", 
                $usuario_id, 
                $dados['peso'], 
                $dados['idade'], 
                $dados['altura'], 
                $dados['ativo'], 
                $dados['sexo'], 
                $dados['objetivo']
            );
            
            return $stmt->execute() ? "Perfil criado com sucesso!" : "Erro ao criar perfil.";
        }
    }
    
    // Calcular IMC
    public function calcularIMC($peso, $altura) {
        if ($altura > 0) {
            return $peso / ($altura * $altura);
        }
        return 0;
    }
    
    // Calcular necessidade calórica diária
    public function calcularCalorias($peso, $altura, $idade, $sexo, $ativo) {
        // Fórmula de Harris-Benedict
        if ($sexo == 'M') {
            $tmb = 88.362 + (13.397 * $peso) + (4.799 * ($altura * 100)) - (5.677 * $idade);
        } else {
            $tmb = 447.593 + (9.247 * $peso) + (3.098 * ($altura * 100)) - (4.330 * $idade);
        }
        
        // Fator de atividade
        $fator = $ativo ? 1.55 : 1.2;
        
        return $tmb * $fator;
    }
}
