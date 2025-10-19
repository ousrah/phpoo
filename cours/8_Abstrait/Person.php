<?php

/**
 * La classe Personne est maintenant abstraite.
 * On ne peut plus créer d'objet avec "new Personne()".
 * Elle sert de modèle commun et de contrat pour ses enfants.
 */
abstract class Person {
    protected $nom;
    protected $prenom;

    public function __construct($nom, $prenom) {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function getNomComplet() {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Méthode abstraite.
     * Elle N'A PAS de code ici.
     * Elle OBLIGE chaque classe qui hérite de Personne
     * à définir sa propre version de cette méthode.
     */
    abstract public function getProfilDetails();
}