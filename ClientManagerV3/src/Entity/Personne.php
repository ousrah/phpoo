<?php
namespace App\Entity;

abstract class Personne
{
    // Encapsulation : attributs privés
    private ?int $id = null;
    private string $nom;
    private string $email;
    private ?string $telephone;

    // Constructeur
    public function __construct(string $nom, string $email, ?string $telephone = null)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    // Getters & setters (encapsulation)
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom): void { $this->nom = $nom; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): void { $this->email = $email; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(?string $telephone): void { $this->telephone = $telephone; }

    // Méthode commune
    public function afficherIdentite(): string
    {
        return "{$this->nom} ({$this->email})";
    }

    // Méthode abstraite → doit être redéfinie dans les classes filles
    abstract public function getType(): string;
}
