<?php
require_once 'Person.php';
require_once 'Invitable.php';
require_once 'Validable.php';
/**
 * Fournisseur hérite aussi de Personne.
 * Il doit donc LUI AUSSI implémenter la méthode getProfilDetails().
 */
class Fournisseur extends Person implements Invitable, Validable {
    private $societe;

    public function __construct($nom, $prenom, $societe) {
        parent::__construct($nom, $prenom);
        $this->societe = $societe;
    }

    // Implémentation de la méthode abstraite, spécifique au Fournisseur.
    public function getProfilDetails() {
        return "Profil Fournisseur : " . $this->getNomComplet() . " (Société: {$this->societe})";
    }

     // Implémentation de la méthode de l'interface Invitable
    public function envoyerInvitation($evenement) {
        echo "Invitation VIP envoyée au fournisseur {$this->societe} pour l'événement '{$evenement}'.<br>";
    }
    
    // Implémentation de la méthode de l'interface Validable
    public function validerCompte() {
        echo "Le compte du fournisseur {$this->societe} a été validé par la comptabilité.<br>";
    }

}
