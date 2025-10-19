<?php

class Personne {
    /**
     * Les propriétés sont maintenant 'private'. Elles ne peuvent être accédées
     * que depuis l'intérieur de la classe elle-même.
     */
    private $nom;
    private $prenom;
    private $dateDeNaissance;

    public function __construct($nom, $prenom, $dateDeNaissance) {
        $this->setNom($nom); // On utilise le setter dès le constructeur
        $this->setPrenom($prenom);
        $this->dateDeNaissance = $dateDeNaissance;
    }

    // GETTERS (Accesseurs) : Méthodes publiques pour LIRE les propriétés privées

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getDateDeNaissance() {
        return $this->dateDeNaissance;
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
    
    public function getAge() {
        $dateNaissance = new DateTime($this->dateDeNaissance);
        $dateActuelle = new DateTime();
        $difference = $dateActuelle->diff($dateNaissance);
        return $difference->y;
    }
}

?>