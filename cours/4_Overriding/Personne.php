<?php
class Personne {
    protected $nom;
    protected $prenom;

    public function __construct($nom, $prenom) {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    /**
     * Méthode de base qui sera redéfinie par les classes enfants.
     */
    public function getInfosDeBase() {
        return "Contact : {$this->prenom} {$this->nom}";
    }
}