<?php
use Bramus\Router\Router;
use App\Controller\ClientController;

return function (Router $router) {
    $base = $_ENV['APP_BASEPATH'] ?? '';
    $router->get('/', fn() => header("Location: {$base}/clients"));
    $router->get('/clients', [new ClientController(), 'index']);
    $router->post('/clients', [new ClientController(), 'store']);
};
