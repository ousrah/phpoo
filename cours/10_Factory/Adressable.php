<?php
// On réutilise les classes de base Personne, Client, Fournisseur...

/**
 * Trait Adressable
 * Contient les propriétés et méthodes liées à une adresse.
 * Il pourra être "injecté" dans n'importe quelle classe.
 */
trait Adressable {
    public $rue;
    public $ville;
    public $codePostal;

    public function getAdresseComplete() {
        return "{$this->rue}, {$this->codePostal} {$this->ville}";
    }
}