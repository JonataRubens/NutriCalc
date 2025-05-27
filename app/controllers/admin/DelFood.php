<?php
// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: /Urls.php?page=admin');
    exit();
}

include_once __DIR__ . '/../../../public/includes/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui o alimento do banco de dados
    $sql = "DELETE FROM alimentos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: /Urls.php?page=admin&action=dash'); // Redireciona de volta para o painel
}
?>
