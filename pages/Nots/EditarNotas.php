<?php
session_start();
require_once '../../includes/db_connection.php';

if (!isset($_SESSION['usuario_id'])) {
    die('Acesso não autorizado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['titulo'], $_POST['conteudo'])) {
    $id_nota = intval($_POST['id']);
    $titulo = trim($_POST['titulo']);
    $conteudo = trim($_POST['conteudo']);
    $id_usuario = $_SESSION['usuario_id'];

    $stmt = $conn->prepare("UPDATE notas SET titulo = ?, conteudo = ? WHERE id = ? AND id_usuario = ?");
    $stmt->bind_param("ssii", $titulo, $conteudo, $id_nota, $id_usuario);

    if ($stmt->execute()) {
        header("Location: ../Notas.php");
        exit();
    } else {
        die("Erro ao editar nota: " . $conn->error);
    }
} else {
    die('Requisição inválida.');
}
