<?php

require_once 'Personne.php';

class Client extends Personne {
    private $numeroClient;

    public function __construct($nom, $prenom, $numeroClient) {
        parent::__construct($nom, $prenom); // Appel du constructeur parent
        $this->numeroClient = $numeroClient;
    }

    /**
     * REDÉFINITION de la méthode getInfosDeBase().
     * La signature (nom et arguments) est la même que dans la classe Personne.
     * Le comportement (le corps de la méthode) est différent.
     */
    public function getInfosDeBase() {
        // On peut appeler la méthode originale du parent pour réutiliser son code
        $infosParent = parent::getInfosDeBase();

        // On ajoute ensuite les informations spécifiques au Client
        return $infosParent . " [Numéro Client: {$this->numeroClient}]";
    }
}