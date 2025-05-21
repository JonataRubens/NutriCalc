<?php
session_start();
require_once __DIR__ . '/../../../public/includes/db_connection.php';
require_once __DIR__ . '/../../models/Nota.php'; // Inclui o model

if (!isset($_SESSION['usuario_id'])) {
    die('Acesso não autorizado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id_nota = intval($_POST['id']);
    $id_usuario = $_SESSION['usuario_id'];

    // Usando o model para excluir a nota
    $notaModel = new Nota($conn);
    if ($notaModel->excluir($id_nota, $id_usuario)) {
        header("Location: /Urls.php?page=notas");
        exit();
    } else {
        die("Erro ao excluir nota.");
    }
} else {
    die('Requisição inválida.');
}
