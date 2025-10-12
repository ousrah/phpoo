<?php
namespace App\Repository;

use App\Database\Connection;
use App\Entity\Client;
use App\Entity\Fournisseur;
use App\Entity\Personne;
use PDO;

class PersonneRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::get();
    }

    /**
     * Récupère tous les clients et tous les fournisseurs et les retourne
     * dans un seul tableau d'objets Personne.
     *
     * @return Personne[]
     */
    public function findAll(): array
    {
        // On utilise UNION ALL pour combiner les résultats de deux requêtes.
        // On ajoute une colonne 'type' pour pouvoir les différencier en PHP.
        $sql = "
            SELECT id, nom, email, telephone, 'client' as type FROM clients
            UNION ALL
            SELECT id, nom, email, telephone, 'fournisseur' as type FROM fournisseurs
            ORDER BY nom
        ";

        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $personnes = [];
        foreach ($rows as $row) {
            if ($row['type'] === 'client') {
                $personne = new Client($row['nom'], $row['email'], $row['telephone']);
            } else {
                $personne = new Fournisseur($row['nom'], $row['email'], $row['telephone']);
            }
            $personne->setId((int) $row['id']);
            $personnes[] = $personne;
        }

        return $personnes;
    }
}