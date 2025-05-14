<?php
session_start();
require_once '../../includes/db_connection.php';

if (!isset($_SESSION['usuario_id'])) {
    die('Acesso não autorizado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id_nota = intval($_POST['id']);
    $id_usuario = $_SESSION['usuario_id'];

    $stmt = $conn->prepare("DELETE FROM notas WHERE id = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id_nota, $id_usuario);

    if ($stmt->execute()) {
        header("Location: ../Notas.php");
        exit();
    } else {
        die("Erro ao excluir nota: " . $conn->error);
    }
} else {
    die('Requisição inválida.');
}
