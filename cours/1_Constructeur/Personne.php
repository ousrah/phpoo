<?php

/**
 * Déclaration de la classe Personne.
 * Une classe est un modèle qui définit les propriétés et les méthodes communes
 * à un ensemble d'objets.
 */
class Personne {
    /**
     * Déclaration des propriétés (ou attributs). Ce sont les caractéristiques
     * de notre objet. Ici, elles sont déclarées en 'public', ce qui signifie
     * qu'on peut y accéder et les modifier de n'importe où dans le code.
     */
    public $nom;
    public $prenom;
    public $dateDeNaissance;

    /**
     * Le constructeur est une méthode spéciale qui est appelée automatiquement
     * lors de la création d'un nouvel objet (une instance) de la classe.
     * On l'utilise généralement pour initialiser les propriétés de l'objet.
     */
    public function __construct($nom, $prenom, $dateDeNaissance) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateDeNaissance = $dateDeNaissance;
    }

    /**
     * Une méthode est une fonction à l'intérieur d'une classe.
     * Elle définit une action que l'objet peut effectuer.
     * Ici, une méthode simple pour obtenir le nom complet de la personne.
     */
    public function getNomComplet() {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Une méthode pour calculer et retourner l'âge de la personne.
     */
    public function getAge() {
        $dateNaissance = new DateTime($this->dateDeNaissance);
        $dateActuelle = new DateTime();
        $difference = $dateActuelle->diff($dateNaissance);
        return $difference->y;
    }
}

?>