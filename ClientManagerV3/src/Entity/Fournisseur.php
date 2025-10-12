<?php
namespace App\Entity;

class Fournisseur extends Personne
{
    private ?string $societe;

    public function __construct(string $nom, string $email, ?string $telephone = null, ?string $societe = null)
    {
        parent::__construct($nom, $email, $telephone);
        $this->societe = $societe;
    }

    public function getSociete(): ?string { return $this->societe; }
    public function setSociete(?string $societe): void { $this->societe = $societe; }

    // Polymorphisme : redéfinition de getType()
    public function getType(): string
    {
        return "Fournisseur";
    }
}
