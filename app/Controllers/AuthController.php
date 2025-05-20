<?php
// Controller responsável por autenticação de usuários
class AuthController {
    // Exibe o formulário de login e processa autenticação
    public function login() {
        // Se o método for POST, processa o login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../Models/Usuario.php';
            $usuarioModel = new Usuario();
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $usuario = $usuarioModel->autenticar($email, $senha);
            if ($usuario) {
                // Login bem-sucedido, salva dados na sessão
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                header('Location: /');
                exit;
            } else {
                $erro = 'Email ou senha inválidos.';
            }
        }
        // Exibe a view de login
        require __DIR__ . '/../Views/auth/login.php';
    }

    // Exibe o formulário de registro e processa cadastro
    public function register() {
        // Se o método for POST, processa o cadastro
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../Models/Usuario.php';
            $usuarioModel = new Usuario();
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            if ($usuarioModel->emailExiste($email)) {
                $erro = 'Email já cadastrado.';
            } else {
                $usuarioModel->criar($nome, $email, $senha);
                header('Location: /Auth/login');
                exit;
            }
        }
        // Exibe a view de cadastro
        require __DIR__ . '/../Views/auth/register.php';
    }

    // Realiza o logout
    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}
