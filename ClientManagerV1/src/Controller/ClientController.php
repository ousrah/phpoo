<?php
namespace App\Controller;

use App\Entity\Client;
use App\Exceptions\DatabaseException;

class ClientController
{


    public function __construct()
    {
       
    }

    public function index(): void
    {
        try {
            $clients = Client::all();
        } catch (DatabaseException $e) {
            $error = $e->getMessage();
            $clients = [];
        }

        include __DIR__ . '/../../public/list.php';
    }

    public function store(): void
    {
        try {
            $client = new Client(null,
                trim($_POST['nom']),
                trim($_POST['email']),
                $_POST['telephone'] ?? null
            );
            $client->save();
            header('Location: /phpoo/clientManagerv1/public');
            exit;
        } catch (DatabaseException $e) {
            die("Erreur : " . htmlspecialchars($e->getMessage()));
        }
    }
}
