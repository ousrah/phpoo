<?php
// Fichier : PersonneFactory.php
require_once 'Client.php'; 
require_once 'Fournisseur.php'; 

class PersonneFactory {
    /**
     * Crée et retourne une instance d'un enfant de Personne en fonction du type fourni.
     * La méthode est 'statique' car on n'a pas besoin d'instancier la fabrique elle-même.
     * On peut l'appeler directement : PersonneFactory::creerPersonne(...).
     *
     * @param string $type Le type de personne à créer ('client' ou 'fournisseur').
     * @param string $nom Le nom de la personne.
     * @param string $prenom Le prénom de la personne.
     * @param string $detail L'information spécifique.
     * @param string $societe L'information spécifique (societe).

    * @return Personne L'objet créé.
     * @throws InvalidArgumentException Si le type est inconnu.
     */
    public static function creerPersonne(string $type, string $nom, string $prenom, string $detail): Personne {
        switch (strtolower($type)) {
            case 'client':
                return new Client($nom, $prenom, $detail);
            
            case 'fournisseur':
                return new Fournisseur($nom, $prenom, $detail);

            default:
                // C'est une bonne pratique de lever une exception pour un type inconnu.
                throw new InvalidArgumentException("Le type de personne '{$type}' est inconnu.");
        }
    }
}
?>