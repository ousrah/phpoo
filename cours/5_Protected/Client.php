<?php

require_once 'Personne.php';

class Client extends Personne {
    private $numeroClient;

    public function __construct($nom, $prenom, $numeroClient) {
        // On appelle le constructeur parent pour initialiser nom et prenom
        parent::__construct($nom, $prenom);
        $this->numeroClient = $numeroClient;
    }

    /**
     * Une méthode qui utilise directement les propriétés 'protected' du parent ($nom et $prenom).
     * C'est l'avantage de 'protected' : les classes enfants ont un accès privilégié.
     */
    public function getIdentiteClient() {
        // Accès direct aux propriétés protected du parent
        return "Client N°" . $this->numeroClient . " : " . $this->prenom . " " . $this->nom;
    }
    
    /**
     * On peut même les modifier directement dans la classe enfant (si on veut!)
     */
    public function modifierNomDeFamille($nouveauNom) {
        $this->nom = $nouveauNom;
    }
}

?>