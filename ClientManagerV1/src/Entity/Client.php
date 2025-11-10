<?php
namespace App\Entity;
use PDO;
use PDOException;
use App\Database\Connection;
use App\Exceptions\DatabaseException;
class Client
{
    public ?int $id = null;
    public string $nom;
    public string $email;
    public ?string $telephone;

    private static PDO $pdo;


    public function __construct(string $nom, string $email, ?string $telephone = null)
    {
        
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    public function __toString(): string
    {
        return "{$this->nom} ({$this->email})";
    }

    /**
     * Retourne tous les clients de la base
     * @return Client[]
     * @throws DatabaseException
     */
    public static function all(): array
{
    try {
        $pdo = Connection::get();
        $stmt = $pdo->query("SELECT * FROM clients ORDER BY id DESC");
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



     public function save(): bool
    {
        try {
            $pdo = Connection::get();
            $stmt = $pdo->prepare(
                "INSERT INTO clients (nom, email, telephone) VALUES (:nom, :email, :telephone)"
            );
            return $stmt->execute([
                'nom' => $this->nom,
                'email' => $this->email,
                'telephone' => $this->telephone,
            ]);
        } catch (PDOException $e) {
            throw new DatabaseException("Erreur lors de l’enregistrement du client : " . $e->getMessage());
        }
    }

}
