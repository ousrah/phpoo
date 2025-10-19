<?php
require_once 'Person.php';
/**
 * Fournisseur hérite aussi de Personne.
 * Il doit donc LUI AUSSI implémenter la méthode getProfilDetails().
 */
class Fournisseur extends Person {
    private $societe;

    public function __construct($nom, $prenom, $societe) {
        parent::__construct($nom, $prenom);
        $this->societe = $societe;
    }

    // Implémentation de la méthode abstraite, spécifique au Fournisseur.
    public function getProfilDetails() {
        return "Profil Fournisseur : " . $this->getNomComplet() . " (Société: {$this->societe})";
    }
}
