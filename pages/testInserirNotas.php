<?php
require_once '../includes/db_connection.php';

$id_usuario = 1;
$titulo = "Nota de teste";
$conteudo = "Esta é uma nota inserida diretamente no banco.";

$stmt = $conn->prepare("INSERT INTO notas (id_usuario, titulo, conteudo) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $id_usuario, $titulo, $conteudo);

if ($stmt->execute()) {
    echo "✅ Nota inserida com sucesso!";
} else {
    echo "❌ Erro ao inserir nota: " . $conn->error;
}
