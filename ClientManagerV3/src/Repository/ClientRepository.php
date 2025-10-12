<?php
namespace App\Repository;

use App\Database\Connection;
use App\Entity\Client;
use App\Exceptions\DatabaseException;
use PDO;
use PDOException;

/**
 * Le Repository est une classe qui a pour unique rôle de communiquer avec la base de données
 * pour une entité spécifique (ici, Client). Il abstrait la logique des requêtes SQL.
 */
class ClientRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::get();
    }

    /**
     * Récupère un client par son ID.
     *
     * @param int $id L'identifiant du client à trouver.
     * @return Client|null Retourne un objet Client si trouvé, sinon null.
     * @throws DatabaseException Si une erreur de base de données survient.
     */
    public function find(int $id): ?Client
    {
        try {
            // REQUÊTE PRÉPARÉE : Utiliser des requêtes préparées est crucial pour la SÉCURITÉ.
            // Le '?' est un marqueur qui sera remplacé par la valeur de $id.
            // PDO s'assure que la valeur est traitée comme une donnée et non comme du code SQL,
            // ce qui empêche les injections SQL.
            $stmt = $this->pdo->prepare("SELECT * FROM clients WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si aucun enregistrement n'est trouvé, fetch() retourne false.
            if (!$row) {
                return null;
            }

            // On "hydrate" l'objet Client avec les données de la base.
            $client = new Client($row['nom'], $row['email'], $row['telephone'], (float)$row['solde']);
            $client->setId((int) $row['id']);

            return $client;

        } catch (PDOException $e) {
            throw new DatabaseException("Erreur lors de la récupération du client : " . $e->getMessage());
        }
    }

    /**
     * Retourne tous les clients de la base, triés par ID décroissant.
     *
     * @return Client[] Un tableau d'objets Client.
     * @throws DatabaseException
     */
    public function findAll(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM clients ORDER BY id DESC");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $clients = [];
            foreach ($rows as $row) {
                // On crée un objet Client pour chaque ligne de résultat
                $client = new Client($row['nom'], $row['email'], $row['telephone'], (float)$row['solde']);
                $client->setId((int) $row['id']); // On n'oublie pas de setter l'ID
                $clients[] = $client;
            }

            return $clients;
        } catch (PDOException $e) {
            throw new DatabaseException("Erreur lors de la récupération des clients : " . $e->getMessage());
        }
    }

    /**
     * Enregistre un nouveau client dans la base de données.
     *
     * @param Client $client L'objet Client à enregistrer.
     * @return bool Retourne true si l'enregistrement a réussi, sinon false.
     * @throws DatabaseException
     */
    public function save(Client $client): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO clients (nom, email, telephone, solde) VALUES (:nom, :email, :telephone, :solde)"
            );
            
            // On utilise les getters de l'objet Client pour respecter l'ENCAPSULATION.
            // On n'accède pas directement aux propriétés, on passe par les méthodes publiques.
            return $stmt->execute([
                'nom' => $client->getNom(),
                'email' => $client->getEmail(),
                'telephone' => $client->getTelephone(),
                'solde' => $client->getSolde(),
            ]);
        } catch (PDOException $e) {
            // Gérer le cas où l'email est déjà utilisé (contrainte UNIQUE)
            if ($e->getCode() === '23000') {
                throw new DatabaseException("Erreur : L'adresse email est déjà utilisée par un autre client.");
            }
            throw new DatabaseException("Erreur lors de l’enregistrement du client : " . $e->getMessage());
        }
    }

    /**
     * Met à jour un client existant dans la base de données.
     *
     * @param Client $client L'objet Client contenant les nouvelles données.
     * @return bool Retourne true si la mise à jour a réussi, sinon false.
     * @throws DatabaseException
     */
    public function update(Client $client): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE clients SET nom = :nom, email = :email, telephone = :telephone, solde = :solde WHERE id = :id"
            );

            return $stmt->execute([
                'id' => $client->getId(), // L'ID est crucial pour la clause WHERE
                'nom' => $client->getNom(),
                'email' => $client->getEmail(),
                'telephone' => $client->getTelephone(),
                'solde' => $client->getSolde()
            ]);
        } catch (PDOException $e) {
             if ($e->getCode() === '23000') {
                throw new DatabaseException("Erreur : L'adresse email est déjà utilisée par un autre client.");
            }
            throw new DatabaseException("Erreur lors de la mise à jour du client : " . $e->getMessage());
        }
    }

     /**
     * Supprime un client de la base de données par son ID.
     *
     * @param int $id L'ID du client à supprimer.
     * @return bool Retourne true si la suppression a réussi, sinon false.
     * @throws DatabaseException
     */
    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM clients WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            throw new DatabaseException("Erreur lors de la suppression du client : " . $e->getMessage());
        }
    }
}