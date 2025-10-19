<?php
require_once 'Person.php';
require_once 'Invitable.php';
/**
 * Client hérite de la classe abstraite Personne.
 * Il doit donc OBLIGATOIREMENT implémenter la méthode getProfilDetails().
 */
class Client extends Person implements Invitable {
    private $numeroClient;

    public function __construct($nom, $prenom, $numeroClient) {
        parent::__construct($nom, $prenom);
        $this->numeroClient = $numeroClient;
    }

    // Implémentation de la méthode abstraite, spécifique au Client.
    public function getProfilDetails() {
        return "Profil Client : " . $this->getNomComplet() . " (Numéro: {$this->numeroClient})";
    }

     public function envoyerInvitation($evenement) {
        echo "Invitation envoyée au client {$this->nom} pour l'événement '{$evenement}'.<br>";
    }

}