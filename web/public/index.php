<?php
// Autoload do Composer, caso esteja usando
require_once '../../vendor/autoload.php';

// Incluir o arquivo de rotas
$routes = require '../routes.php';

// Obter a URI da requisição e o método HTTP
$requestUri = trim($_SERVER['REQUEST_URI'], '/');
$requestMethod = $_SERVER['REQUEST_METHOD'];
// Chamar a função de roteamento
handleRoute($requestUri, $requestMethod, $routes);

// Função para lidar com o roteamento
function handleRoute($uri, $method, $routes)
{
    // Verificar se a rota e o método existem
    if (isset($routes[$method][$uri])) {
        // Obter o controller e o método
        list($controller, $action) = $routes[$method][$uri];

        // Verificar se o controller e o método existem
        if (class_exists($controller) && method_exists($controller, $action)) {
            // Instanciar o controller e chamar o método
            $controllerObj = new $controller();
            $controllerObj->$action();
        } else {
            echo "Erro: Controller ou método não encontrados!";
        }
    } else {
        echo "404 - Página não encontrada.";
    }
}
