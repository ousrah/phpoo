<?php
namespace App\Entity;

class Client
{
    public ?int $id = null;
    public string $nom;
    public string $email;
    public ?string $telephone;

    public function __construct(?int $id, string $nom, string $email, ?string $telephone = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    public function __toString(): string
    {
        return "{$this->nom} ({$this->email})";
    }
}
