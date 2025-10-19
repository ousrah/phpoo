<?php
// Cette ligne provoquerait une ERREUR FATALE car Personne est abstraite.
// $personne = new Personne('Test', 'Test');

require_once 'Client.php';
require_once 'Fournisseur.php';

$client = new Client('Alice', 'Leroy', 'CLT001');
echo $client->getProfilDetails() . "<br>";

$fournisseur = new Fournisseur('Paul', 'Garnier', 'Pièces Auto Pro');
echo $fournisseur->getProfilDetails() . "<br>";

?>