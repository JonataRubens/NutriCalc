<?php
// Front Controller do padrão MVC
// Este arquivo recebe todas as requisições e faz o roteamento para o Controller adequado

session_start();

// Autoload simples para Controllers e Models
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/app/Controllers/' . $class . '.php',
        __DIR__ . '/app/Models/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Função para limpar a URL
function getUrl() {
    $url = isset($_GET['url']) ? $_GET['url'] : '';
    $url = rtrim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    return explode('/', $url);
}

// Roteamento básico
$url = getUrl();
$controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
$method = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Verifica se o controller existe
if (file_exists(__DIR__ . '/app/Controllers/' . $controllerName . '.php')) {
    $controller = new $controllerName();
    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
    } else {
        // Método não encontrado
        http_response_code(404);
        echo "Método não encontrado.";
    }
} else {
    // Controller não encontrado
    http_response_code(404);
    echo "Página não encontrada.";
}