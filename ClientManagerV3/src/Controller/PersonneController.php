<?php
namespace App\Controller;

use App\Repository\PersonneRepository;
use App\Exceptions\DatabaseException;

class PersonneController extends BaseController
{
    private PersonneRepository $repo;

    public function __construct()
    {
        $this->repo = new PersonneRepository();
    }

    /**
     * Affiche une liste de toutes les personnes (Clients ET Fournisseurs).
     * C'est ici que le polymorphisme est le plus visible :
     * nous traitons des objets Client et Fournisseur de la même manière (comme des Personne)
     * et nous appelons la même méthode getType() sur eux, mais elle renvoie un résultat différent.
     */
    public function index(): void
    {
        try {
            $personnes = $this->repo->findAll();
        } catch (DatabaseException $e) {
            $error = $e->getMessage();
            $personnes = [];
        }

        // Utilisation de la méthode render héritée de BaseController
        $this->render('personnes/list', [
            'personnes' => $personnes,
            'error' => $error ?? null
        ]);
    }
}