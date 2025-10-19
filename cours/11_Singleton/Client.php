<?php

require_once 'Person.php';
require_once 'Adressable.php';
/**
 * La classe Client hérite de la classe Personne.
 * Elle a donc accès à toutes les propriétés et méthodes publiques de Personne.
 */
class Client extends Person {

       // On "injecte" les propriétés (rue, ville, codePostal) et la méthode getAdresseComplete()

    use Adressable;
    
    private $email;
    /**
     * Le constructeur de la classe enfant.
     * Il doit appeler le constructeur de la classe parent avec parent::__construct().
     */
    public function __construct($nom, $prenom, $dateDeNaissance, $email) {
        // Appel du constructeur de la classe parente (Personne)
        parent::__construct($nom, $prenom, $dateDeNaissance);
        $this->setEmail($email);
    }

    // Getter et Setter pour la nouvelle propriété
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    /**
     * On peut aussi surcharger une méthode du parent pour la spécialiser.
     * Ici, on ajoute l'email à la présentation.
     */
    public function getInfos() {
        return "Client : " . $this->getNomComplet() . ", Email : " . $this->email;
    }

    public function getProfilDetails() {
        return "Profil Client : " . $this->getNomComplet() . " (Email: {$this->email})";
    }

}

?>