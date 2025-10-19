<?php

require_once 'Client.php';
require_once 'Fournisseur.php';


$client = new Client('Alice', 'Leroy', 'CLT001', 'Alice@yahoo.fr');
// On peut maintenant définir les propriétés du trait directement sur l'objet
$client->rue = "123 Rue de la République";
$client->ville = "Paris";
$client->codePostal = "75001";

$fournisseur = new Fournisseur('Paul', 'Garnier', '01/01/2000','Pièces Auto Pro');
$fournisseur->rue = "45 Avenue de l'Industrie";
$fournisseur->ville = "Lyon";
$fournisseur->codePostal = "69002";

echo "Adresse du client {$client->getNom()} : " . $client->getAdresseComplete() . "<br>";
echo "Adresse du fournisseur {$fournisseur->societe} : " . $fournisseur->getAdresseComplete() . "<br>";

?>