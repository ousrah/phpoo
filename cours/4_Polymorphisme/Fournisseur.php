<?php

require_once 'Personne.php';

class Fournisseur extends Personne {
    private $societe;

    public function __construct($nom, $prenom, $dateDeNaissance, $societe) {
        parent::__construct($nom, $prenom, $dateDeNaissance);
        $this->societe = $societe;
    }

    public function getSociete() {
        return $this->societe;
    }

    /**
     * La même méthode 'getInfos' que pour Client, mais avec une implémentation
     * (un comportement) différente. C'est le polymorphisme.
     */
    public function getInfos() {
        return "Fournisseur : " . $this->getNomComplet() . ", Société : " . $this->societe;
    }
}

?>