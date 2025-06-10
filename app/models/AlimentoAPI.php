<?php
// Model para a tabela lista_alimentos
class ListaAlimento {
    public $id;
    public $descricao;
    public $categoria;
    public $energia;
    public $proteina;
    public $lipideos;
    public $carboidratos;
    public $criado_em;

    public function __construct($row) {
        $this->id = $row['id'] ?? null;
        $this->descricao = $row['descricao'] ?? null;
        $this->categoria = $row['categoria'] ?? null;
        $this->energia = $row['energia'] ?? null;
        $this->proteina = $row['proteina'] ?? null;
        $this->lipideos = $row['lipideos'] ?? null;
        $this->carboidratos = $row['carboidratos'] ?? null;
        $this->criado_em = $row['criado_em'] ?? null;
    }

    // Retorna os dados como array associativo
    public function toArray() {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao,
            'categoria' => $this->categoria,
            'energia' => $this->energia,
            'proteina' => $this->proteina,
            'lipideos' => $this->lipideos,
            'carboidratos' => $this->carboidratos,
            'criado_em' => $this->criado_em
        ];
    }

    public static function listar($conn) {
        $result = $conn->query("SELECT * FROM alimentos");
        $alimentos = [];
        while ($row = $result->fetch_assoc()) {
            $alimento = new ListaAlimento($row);
            $alimentos[] = $alimento->toArray();
        }
        return $alimentos;
    }

    // Adicionar alimento
    public static function adicionar($conn, $data) {
        $stmt = $conn->prepare("INSERT INTO alimentos (descricao, categoria, energia, proteina, lipideos, carboidratos) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssdddd",
            $data['descricao'],
            $data['categoria'],
            $data['energia'],
            $data['proteina'],
            $data['lipideos'],
            $data['carboidratos']
        );
        if ($stmt->execute()) {
            // Buscar o alimento recém inserido para retornar como objeto
            $id = $conn->insert_id;
            $result = $conn->query("SELECT * FROM alimentos WHERE id = $id");
            $row = $result->fetch_assoc();
            $alimento = new ListaAlimento($row);
            return ['success' => true, 'id' => $id, 'alimento' => $alimento->toArray()];
        } else {
            return ['error' => 'Erro ao inserir alimento'];
        }
    }

    // Deletar alimento
    public static function deletar($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM alimentos WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['error' => 'Erro ao deletar alimento'];
        }
    }

        // Editar alimento
    public static function editar($conn, $id, $data) {
        $stmt = $conn->prepare("UPDATE alimentos SET descricao = ?, categoria = ?, energia = ?, proteina = ?, lipideos = ?, carboidratos = ? WHERE id = ?");
        $stmt->bind_param(
            "ssddddi",
            $data['descricao'],
            $data['categoria'],
            $data['energia'],
            $data['proteina'],
            $data['lipideos'],
            $data['carboidratos'],
            $id
        );
        if ($stmt->execute()) {
            // Buscar o alimento atualizado
            $result = $conn->query("SELECT * FROM alimentos WHERE id = $id");
            $row = $result->fetch_assoc();
            $alimento = new ListaAlimento($row);
            return ['success' => true, 'alimento' => $alimento->toArray()];
        } else {
            return ['error' => 'Erro ao editar alimento'];
        }
    }

    
    // Filtrar alimentos por termo (busca em descricao e categoria)
    public static function filtrar($conn, $termo) {
        $termo = "%" . $termo . "%";
        $stmt = $conn->prepare("SELECT * FROM alimentos WHERE descricao LIKE ? OR categoria LIKE ?");
        $stmt->bind_param("ss", $termo, $termo);
        $stmt->execute();
        $result = $stmt->get_result();
        $alimentos = [];
        while ($row = $result->fetch_assoc()) {
            $alimento = new ListaAlimento($row);
            $alimentos[] = $alimento->toArray();
        }
        return $alimentos;
    }

    
    // Filtrar por categoria exata
    public static function filtrarPorCategoria($conn, $categoria) {
        $stmt = $conn->prepare("SELECT * FROM alimentos WHERE categoria = ?");
        $stmt->bind_param("s", $categoria);
        $stmt->execute();
        $result = $stmt->get_result();
        $alimentos = [];
        while ($row = $result->fetch_assoc()) {
            $alimento = new ListaAlimento($row);
            $alimentos[] = $alimento->toArray();
        }
        return $alimentos;
    }
    
}
?>