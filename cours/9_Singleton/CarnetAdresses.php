<?php
// On suppose que les classes Personne, Client et Fournisseur existent.

class CarnetAdresses {
    // 1. Stocke l'unique instance de la classe
    private static $instance = null;

    // Le tableau qui contiendra nos contacts (Personne)
    private $contacts = [];

    // 2. Le constructeur est privé, on ne peut pas faire "new CarnetAdresses()"
    private function __construct() {
        // Initialisation (ex: charger les contacts depuis un fichier)
        echo "Initialisation du Carnet d'Adresses (ne doit apparaître qu'une fois).<br>";
    }
    
    // 3. La méthode statique qui est le seul moyen d'obtenir l'objet
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new CarnetAdresses();
        }
        return self::$instance;
    }

    // Méthodes métier du carnet d'adresses
    public function ajouterContact(Personne $personne) {
        $this->contacts[] = $personne;
        echo "Contact '{$personne->getNomComplet()}' ajouté au carnet.<br>";
    }

    public function listerContacts() {
        echo "--- Liste des Contacts ---<br>";
        foreach ($this->contacts as $contact) {
            echo "- " . $contact->getProfilDetails() . "<br>";
        }
        echo "--------------------------<br>";
    }
    
    // Empêcher le clonage et la désérialisation
    private function __clone() {}
    public function __wakeup() {}
}
