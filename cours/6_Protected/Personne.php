<?php

class Personne {
    /**
     * Les propriétés sont maintenant 'protected'.
     * Elles ne peuvent PAS être lues ou modifiées directement depuis
     * l'extérieur de la classe ou des classes héritées.
     */
    protected $nom;
    protected $prenom;

    public function __construct($nom, $prenom) {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    /**
     * Méthode publique pour afficher le nom complet.
     * Cette méthode UTILISE les propriétés protected.
     */
    public function getNomComplet() {
        return $this->prenom . ' ' . $this->nom;
    }
}

?>