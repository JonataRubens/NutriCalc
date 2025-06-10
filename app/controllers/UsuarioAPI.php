<?php
require_once __DIR__ . '/../models/UsuarioAPI.php';
require_once __DIR__ . '/../../public/includes/db_connection.php';

class UsuarioController {
    public static function listar() {
        $conn = getDbConnection();
        return Usuario::listar($conn);
    }

    public static function adicionar($data) {
        $conn = getDbConnection();
        return Usuario::adicionar($conn, $data);
    }

    public static function editar($id, $data) {
        return Usuario::editar($id, $data);
    }

    public static function excluir($id) {
        return Usuario::excluir($id);
    }

    public static function buscarPorId($id) {
        return Usuario::buscarPorId($id);
    }
}
?>
