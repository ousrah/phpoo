<?php
namespace App\Repository;

use App\Database\Connection;
use App\Entity\Fournisseur;
use App\Exceptions\DatabaseException;
use PDO;
use PDOException;

class FournisseurRepository
{
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Connection::get();
    }

    public function find(int $id): ?Fournisseur
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM fournisseurs WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) return null;

            $fournisseur = new Fournisseur($row['nom'], $row['email'], $row['telephone'], $row['societe']);
            $fournisseur->setId((int) $row['id']);
            return $fournisseur;
        } catch (PDOException $e) {
            throw new DatabaseException("Erreur lors de la récupération du fournisseur : " . $e->getMessage());
        }
    }

    public function findAll(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM fournisseurs ORDER BY id DESC");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $fournisseurs = [];
            foreach ($rows as $row) {
                $fournisseur = new Fournisseur($row['nom'], $row['email'], $row['telephone'], $row['societe']);
                $fournisseur->setId((int) $row['id']);
                $fournisseurs[] = $fournisseur;
            }
            return $fournisseurs;
        } catch (PDOException $e) {
            throw new DatabaseException("Erreur lors de la récupération des fournisseurs : " . $e->getMessage());
        }
    }

    public function save(Fournisseur $fournisseur): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO fournisseurs (nom, email, telephone, societe) VALUES (:nom, :email, :telephone, :societe)"
            );
            return $stmt->execute([
                'nom'       => $fournisseur->getNom(),
                'email'     => $fournisseur->getEmail(),
                'telephone' => $fournisseur->getTelephone(),
                'societe'   => $fournisseur->getSociete(),
            ]);
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') { throw new DatabaseException("Email déjà utilisé."); }
            throw new DatabaseException("Erreur lors de l’enregistrement : " . $e->getMessage());
        }
    }

    public function update(Fournisseur $fournisseur): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE fournisseurs SET nom = :nom, email = :email, telephone = :telephone, societe = :societe WHERE id = :id"
            );
            return $stmt->execute([
                'id'        => $fournisseur->getId(),
                'nom'       => $fournisseur->getNom(),
                'email'     => $fournisseur->getEmail(),
                'telephone' => $fournisseur->getTelephone(),
                'societe'   => $fournisseur->getSociete()
            ]);
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') { throw new DatabaseException("Email déjà utilisé."); }
            throw new DatabaseException("Erreur lors de la mise à jour : " . $e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM fournisseurs WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            throw new DatabaseException("Erreur lors de la suppression : " . $e->getMessage());
        }
    }
}