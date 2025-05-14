<?php
include __DIR__ . '/../../includes/RoleMiddleware.php';
// Verifica se o usuário está logado e tem a função de administrador
roleMiddleware(['admin']);

include __DIR__ . '/../../includes/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui o usuário do banco de dados
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: Dashboard.php'); // Redireciona de volta para o painel
}
?>
