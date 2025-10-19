<?php

require_once 'Person.php';
require_once 'Adressable.php';

class Fournisseur extends Person {

    // On réutilise EXACTEMENT le même code d'adresse ici.
    use Adressable;

    public $societe;

    public function __construct($nom, $prenom,  $societe) {
        parent::__construct($nom, $prenom);
        $this->societe = $societe;
    }

    public function getsociete() {
        return $this->societe;
    }

    /**
     * La même méthode 'getInfos' que pour Client, mais avec une implémentation
     * (un comportement) différente. C'est le polymorphisme.
     */
    public function getInfos() {
        return "Fournisseur : " . $this->getNomComplet() . ", Société : " . $this->societe;
    }

    public function getProfilDetails() {
        return "Profil Fournisseur : " . $this->getNomComplet() . " (Société: {$this->societe})";
    }

}

?>