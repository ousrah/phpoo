<?php
namespace App\Entity;

class Client extends Personne
{
    private ?float $solde = null;

    public function __construct(string $nom, string $email, ?string $telephone = null, ?float $solde = 0)
    {
        parent::__construct($nom, $email, $telephone);
        $this->solde = $solde;
    }

    public function getSolde(): ?float { return $this->solde; }
    public function setSolde(?float $solde): void { $this->solde = $solde; }

    // Polymorphisme : redéfinition de la méthode getType()
    public function getType(): string
    {
        return "Client";
    }
}
