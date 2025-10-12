<?php
namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Exceptions\DatabaseException;
use App\Core\Redirect;

class ClientController
{
    private ClientRepository $repo;

    public function __construct()
    {
        $this->repo = new ClientRepository();
    }

    public function index(): void
    {
        try {
            $clients = $this->repo->all();
        } catch (DatabaseException $e) {
            $error = $e->getMessage();
            $clients = [];
        }

        include __DIR__ . '/../../public/list.php';
    }

    public function store(): void
    {
        try {
            $client = new Client(
                trim($_POST['nom']),
                trim($_POST['email']),
                $_POST['telephone'] ?? null
            );
            $this->repo->save($client);
            $base = $_ENV['APP_BASEPATH'] ?? '';
            Redirect::to('/clients');
            //Redirect::back();
            exit;
        } catch (DatabaseException $e) {
            die("Erreur : " . htmlspecialchars($e->getMessage()));
        }
    }
}
