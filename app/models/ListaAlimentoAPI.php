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
}
?>