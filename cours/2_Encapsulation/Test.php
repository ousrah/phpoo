<?php

require_once 'Personne.php';

$personne1 = new Personne('Dupont', 'Jean', '1990-05-15');

// Accès via les getters
echo "Nom : " . $personne1->getNom() . "<br>";

// Modification via les setters
$personne1->setNom('Martin');

echo "Nouveau nom complet : " . $personne1->getNomComplet() . "<br>";

// Cette ligne provoquerait une erreur fatale, car la propriété est privée :
// $personne1->nom = 'Durand';

?>