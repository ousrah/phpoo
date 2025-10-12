<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Controller\ClientController;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$controller = new ClientController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store();
} else {
    $controller->index();
}
