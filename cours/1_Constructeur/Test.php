<?php

// Inclusion du fichier de la classe
require_once 'Personne.php';

// Création d'une instance (un objet) de la classe Personne
$personne1 = new Personne('Dupont', 'Jean', '1990-05-15');

// Accès direct aux propriétés publiques pour les lire
echo "Nom : " . $personne1->nom . "<br>";
echo "Prénom : " . $personne1->prenom . "<br>";
echo("<br><br><br>");
echo("--------------------------------<br>");
echo("après modificiation du nom<br>");

echo("--------------------------------<br>");
echo("<br>");
// Modification directe d'une propriété publique
$personne1->nom = 'Martin';

// Appel des méthodes de l'objet
echo "Nom complet : " . $personne1->getNomComplet() . "<br>";
echo "Âge : " . $personne1->getAge() . " ans<br>";

?>