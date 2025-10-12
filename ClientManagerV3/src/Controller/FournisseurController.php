<?php
namespace App\Controller;

use App\Entity\Fournisseur;
use App\Repository\FournisseurRepository;
use App\Exceptions\DatabaseException;

/**
 * Ce contrôleur est dédié à la gestion des Fournisseurs.
 * Il suit les mêmes principes que le ClientController :
 * - Héritage de BaseController pour la méthode render().
 * - Encapsulation de son Repository.
 * - Méthodes dédiées pour chaque action CRUD, renvoyant du JSON pour les requêtes AJAX.
 */
class FournisseurController extends BaseController
{
    private FournisseurRepository $repo;

    public function __construct() {
        $this->repo = new FournisseurRepository();
    }

    /** Affiche la page principale avec la liste des fournisseurs */
    public function index(): void
    {
        try {
            $fournisseurs = $this->repo->findAll();
            $this->render('fournisseurs/list', [
                'fournisseurs' => $fournisseurs,
                'title' => 'Gestion des Fournisseurs'
            ]);
        } catch (DatabaseException $e) {
            $this->render('fournisseurs/list', ['error' => $e->getMessage(), 'title' => 'Erreur']);
        }
    }

    /**
     * Affiche le formulaire HTML (partiel) pour l'ajout ou la modification.
     */
    public function showForm(int $id = null): void
    {
        $fournisseur = $id ? $this->repo->find($id) : null;
        include __DIR__ . '/../../views/partials/_fournisseur_form.php';
    }
    
    /** Récupère les données d'un fournisseur en JSON (pour l'édition) */
    public function show(int $id): void
    {
        header('Content-Type: application/json');
        $fournisseur = $this->repo->find($id);
        if ($fournisseur) {
            echo json_encode([
                'id' => $fournisseur->getId(),
                'nom' => $fournisseur->getNom(),
                'email' => $fournisseur->getEmail(),
                'telephone' => $fournisseur->getTelephone(),
                'societe' => $fournisseur->getSociete()
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Fournisseur non trouvé']);
        }
    }

    /** Crée un nouveau fournisseur (appelé en AJAX) */
    public function store(): void
    {
        header('Content-Type: application/json');
        try {
            $fournisseur = new Fournisseur(
                $_POST['nom'],
                $_POST['email'],
                $_POST['telephone'] ?: null,
                $_POST['societe'] ?: null
            );
            $this->repo->save($fournisseur);
            echo json_encode(['success' => true, 'message' => 'Fournisseur ajouté avec succès.']);
        } catch (DatabaseException $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /** Met à jour un fournisseur (appelé en AJAX) */
    public function update(int $id): void
    {
        header('Content-Type: application/json');
        try {
            $fournisseur = $this->repo->find($id);
            if (!$fournisseur) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Fournisseur non trouvé.']);
                return;
            }
            $fournisseur->setNom($_POST['nom']);
            $fournisseur->setEmail($_POST['email']);
            $fournisseur->setTelephone($_POST['telephone'] ?: null);
            $fournisseur->setSociete($_POST['societe'] ?: null);
            $this->repo->update($fournisseur);
            echo json_encode(['success' => true, 'message' => 'Fournisseur mis à jour.']);
        } catch (DatabaseException $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /** Supprime un fournisseur (appelé en AJAX) */
    public function destroy(int $id): void
    {
        header('Content-Type: application/json');
        try {
            $this->repo->delete($id);
            echo json_encode(['success' => true, 'message' => 'Fournisseur supprimé.']);
        } catch (DatabaseException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}