<?php
// Controller para operações com alimentos
require_once __DIR__ . '/../models/ListaAlimentoAPI.php';
class AlimentosController {
    // Listar todos os alimentos
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

    // Buscar alimentos com calorias mais próximas
    // MODIFICAÇÃO AQUI: Adiciona $excludeId e muda o limite padrão para 4
    public static function getSimilarByCalories($conn, $targetEnergia, $excludeId = null, $limit = 4) {
        // Cláusula WHERE para excluir o alimento de comparação, se um ID for fornecido
        $whereClause = $excludeId ? " AND id != ?" : "";
        
        // Find foods with energy less than or equal to target, ordered by energy descending
        $sqlLess = "SELECT * FROM alimentos WHERE energia <= ?{$whereClause} ORDER BY energia DESC LIMIT ?";
        $stmtLess = $conn->prepare($sqlLess);

        if ($excludeId) {
            $stmtLess->bind_param("dii", $targetEnergia, $excludeId, $limit);
        } else {
            $stmtLess->bind_param("di", $targetEnergia, $limit);
        }
        $stmtLess->execute();
        $resultLess = $stmtLess->get_result();
        $alimentosLess = [];
        while ($row = $resultLess->fetch_assoc()) {
            $alimentosLess[] = (new ListaAlimento($row))->toArray();
        }
        
        // Find foods with energy greater than target, ordered by energy ascending
        $sqlGreater = "SELECT * FROM alimentos WHERE energia > ?{$whereClause} ORDER BY energia ASC LIMIT ?";
        $stmtGreater = $conn->prepare($sqlGreater);

        if ($excludeId) {
            $stmtGreater->bind_param("dii", $targetEnergia, $excludeId, $limit);
        } else {
            $stmtGreater->bind_param("di", $targetEnergia, $limit);
        }
        $stmtGreater->execute();
        $resultGreater = $stmtGreater->get_result();
        $alimentosGreater = [];
        while ($row = $resultGreater->fetch_assoc()) {
            $alimentosGreater[] = (new ListaAlimento($row))->toArray();
        }

        // Combine and sort by absolute difference from target
        $allAlimentos = array_merge($alimentosLess, $alimentosGreater);
        usort($allAlimentos, function($a, $b) use ($targetEnergia) {
            $diffA = abs($a['energia'] - $targetEnergia);
            $diffB = abs($b['energia'] - $targetEnergia);
            return $diffA <=> $diffB;
        });

        // Return the top N similar foods (adjusted from 3 to 4)
        return array_slice($allAlimentos, 0, $limit);
    }
}