<?php
namespace App\Repository;

use App\Database\Connection;
use App\Entity\Client;
use App\Exceptions\DatabaseException;
use PDO;
use PDOException;

class ClientRepository
{
    private PDO $pdo;

    public function __construct()
    {
        
        $this->pdo = Connection::get();
    }

    /**
     * Retourne tous les clients de la base
     * @return Client[]
     * @throws DatabaseException
     */
    public function all(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM clients ORDER BY id DESC");
            $clients = $stmt->fetchAll(PDO::FETCH_FUNC, function($id, $nom, $email, $telephone) {
                return new Client($id, $nom, $email, $telephone);
            });

            return $clients;
        } catch (PDOException $e) {
            throw new DatabaseException("Erreur lors de la récupération des clients : " . $e->getMessage());
        }
    }

    /**
     * Enregistre un nouveau client
     * @throws DatabaseException
     */
    public function save(Client $client): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO clients (nom, email, telephone) VALUES (:nom, :email, :telephone)"
            );
            return $stmt->execute([
                'nom' => $client->nom,
                'email' => $client->email,
                'telephone' => $client->telephone,
            ]);
        } catch (PDOException $e) {
            throw new DatabaseException("Erreur lors de l’enregistrement du client : " . $e->getMessage());
        }
    }
}
