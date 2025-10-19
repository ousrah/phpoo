<?php

abstract  class Person {
    /**
     * Les propriétés sont maintenant 'private'. Elles ne peuvent être accédées
     * que depuis l'intérieur de la classe elle-même.
     */
    private $nom;
    private $prenom;


    public function __construct($nom, $prenom, ) {
        $this->setNom($nom); // On utilise le setter dès le constructeur
        $this->setPrenom($prenom);

    }

    // GETTERS (Accesseurs) : Méthodes publiques pour LIRE les propriétés privées

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }



    // SETTERS (Mutateurs) : Méthodes publiques pour MODIFIER les propriétés privées

    /**
     * Le setter pour le nom. On peut y ajouter de la logique de validation.
     * Par exemple, s'assurer que le nom n'est pas vide.
     */
    public function setNom($nom) {
        if (!empty($nom)) {
            $this->nom = $nom;
        }
    }

    public function setPrenom($prenom) {
        if (!empty($prenom)) {
            $this->prenom = $prenom;
        }
    }
    
    // Les autres méthodes restent inchangées
    public function getNomComplet() {
        return $this->prenom . ' ' . $this->nom;
    }

    abstract public function getProfilDetails();
}

?>