<?php

require_once 'Client.php';
require_once 'Fournisseur.php';

$client = new Client('Leroy', 'Alice', '1985-10-20', 'alice.leroy@email.com');
$fournisseur = new Fournisseur('Garnier', 'Paul', '1978-03-12', 'Pièces Auto Pro');

$personnes = [$client, $fournisseur];

foreach ($personnes as $personne) {
    // On appelle la même méthode getInfos() sur des objets de types différents.
    // PHP exécute la bonne version de la méthode en fonction de la classe de l'objet.
    echo $personne->getInfos() . "<br>";
}

?>