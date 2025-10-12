<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Bramus\Router\Router;
use App\Controller\ClientController;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Création du routeur
$router = new Router();

// 🔹 adapte bien le nom de ton dossier ici
$base = $_ENV['APP_BASEPATH'] ?? '';
$router->setBasePath($base);

// Chargement des routes
$routes = require __DIR__ . '/../routes/web.php';
$routes($router);

// Lancer le routeur
$router->run();
