<?php

class Personne {
    public $nom;
    public $prenom;

    public function __construct($nom, $prenom) {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function getNomComplet() {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Simule la surcharge de la méthode sePresenter().
     * L'argument $interlocuteur est optionnel grâce à "= null".
     * 
     * @param Personne|null $interlocuteur La personne à qui l'on s'adresse.
     */
    public function sePresenter(Personne $interlocuteur = null) {
        // Cas 1 : Aucun argument n'est fourni ($interlocuteur est null)
        if ($interlocuteur === null) {
            echo "Bonjour, je m'appelle " . $this->getNomComplet() . ".<br>";
        } 
        // Cas 2 : Un argument de type Personne est fourni
        else {
            echo $this->getNomComplet() . " : Bonjour " . $interlocuteur->getNomComplet() . ", enchanté(e) !<br>";
        }
    }

    
}