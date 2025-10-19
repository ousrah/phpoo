<?php
require_once 'Client.php';
require_once 'Fournisseur.php';
require_once 'CarnetAdresses.php';


// On crée nos objets Personne (via leurs classes enfants)
$client = new Client('Alice', 'Leroy', 'CLT001', 'Alice@yahoo.fr');
$fournisseur = new Fournisseur('Paul', 'Garnier', '01/01/2000','Pièces Auto Pro');


echo "Accès au carnet depuis le service facturation...<br>";
// On récupère l'instance du carnet
$carnetFacturation = CarnetAdresses::getInstance();
$carnetFacturation->ajouterContact($client);

echo "<hr>";

echo "Accès au carnet depuis le service logistique...<br>";
// On récupère à nouveau l'instance. Le message d'initialisation n'apparaît pas.
$carnetLogistique = CarnetAdresses::getInstance();
$carnetLogistique->ajouterContact($fournisseur);

echo "<hr>";

// On utilise la première variable pour afficher la liste.
// On verra bien les deux contacts, prouvant que les deux variables
// pointent vers le MÊME et UNIQUE objet carnet.
$carnetFacturation->listerContacts();

// Vérification finale
if ($carnetFacturation === $carnetLogistique) {
    echo "Les deux variables accèdent bien à la même et unique instance du carnet d'adresses.";
}
?>