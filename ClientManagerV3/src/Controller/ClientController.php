<?php
namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Exceptions\DatabaseException;

class ClientController extends BaseController
{
    private ClientRepository $repo;

    public function __construct() {
        $this->repo = new ClientRepository();
    }

    /** Affiche la page principale avec la liste des clients */
    public function index(): void
    {
        try {
            $clients = $this->repo->findAll();
            $this->render('clients/list', [
                'clients' => $clients,
                'title' => 'Gestion des Clients'
            ]);
        } catch (DatabaseException $e) {
            $this->render('clients/list', ['error' => $e->getMessage(), 'title' => 'Erreur']);
        }
    }

    /**
     * Affiche le formulaire HTML (partiel) pour l'ajout ou la modification.
     * Cette méthode est appelée via Fetch par le JavaScript.
     */
    public function showForm(int $id = null): void
    {
        $client = $id ? $this->repo->find($id) : null;
        
        // On inclut directement le fichier de la vue partielle.
        // La variable $client sera disponible dans ce fichier.
        include __DIR__ . '/../../views/partials/_client_form.php';
    }
    
    /** Récupère les données d'un client en JSON (pour l'édition) */
    public function show(int $id): void
    {
        header('Content-Type: application/json');
        $client = $this->repo->find($id);
        if ($client) {
            echo json_encode([
                'id' => $client->getId(),
                'nom' => $client->getNom(),
                'email' => $client->getEmail(),
                'telephone' => $client->getTelephone(),
                'solde' => $client->getSolde()
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Client non trouvé']);
        }
    }

    /** Crée un nouveau client (appelé en AJAX) */
    public function store(): void
    {
        header('Content-Type: application/json');
        try {
            $client = new Client(
                $_POST['nom'],
                $_POST['email'],
                $_POST['telephone'] ?: null,
                (float) ($_POST['solde'] ?: 0)
            );
            $this->repo->save($client);
            echo json_encode(['success' => true, 'message' => 'Client ajouté avec succès.']);
        } catch (DatabaseException $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /** Met à jour un client (appelé en AJAX) */
    public function update(int $id): void
    {
        header('Content-Type: application/json');
        try {
            $client = $this->repo->find($id);
            if (!$client) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Client non trouvé.']);
                return;
            }
            $client->setNom($_POST['nom']);
            $client->setEmail($_POST['email']);
            $client->setTelephone($_POST['telephone'] ?: null);
            $client->setSolde((float) ($_POST['solde'] ?: 0));
            $this->repo->update($client);
            echo json_encode(['success' => true, 'message' => 'Client mis à jour.']);
        } catch (DatabaseException $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /** Supprime un client (appelé en AJAX) */
    public function destroy(int $id): void
    {
        header('Content-Type: application/json');
        try {
            $this->repo->delete($id);
            echo json_encode(['success' => true, 'message' => 'Client supprimé.']);
        } catch (DatabaseException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}