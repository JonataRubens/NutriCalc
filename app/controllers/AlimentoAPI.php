<?php
require_once __DIR__ . '/../models/AlimentoAPI.php';
require_once __DIR__ . '/../../public/includes/db_connection.php';

class AlimentosController {
    public static function index(){
        $conn = getDbConnection();
        return ListaAlimento::listar($conn);
    }

    public static function adicionar($data){
        $conn = getDbConnection();
        return ListaAlimento::adicionar($conn, $data);
    }

    public static function editar($id, $data){
        $conn = getDbConnection();
        return ListaAlimento::editar($conn, $id, $data);
    }

    public static function excluir($id){
        $conn = getDbConnection();
        return ListaAlimento::excluir($conn, $id);
    }

    public static function filtrar($termo){
        $conn = getDbConnection();
        return ListaAlimento::filtrar($conn, $termo);
    }
    
    public static function buscarPorId($id){
        $conn = getDbConnection();
        return ListaAlimento::buscarPorId($conn, $id);
    }

    public static function filtrarPorCategoria($categoria){
        $conn = getDbConnection();
        return ListaAlimento::filtrarPorCategoria($conn, $categoria);
    }
}

?>