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
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $clients = [];
            foreach ($rows as $row) {
                $client = new Client($row['nom'], $row['email'], $row['telephone'] ?? null);
                $client->id = (int) $row['id'];
                $clients[] = $client;
            }

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
