<?php

require_once 'Client.php';

$client1 = new Client('Durand', 'Sophie', 'C001');

// 1. Accès via une méthode publique (Personne)
echo $client1->getNomComplet() . "<br>"; // Affiche: Sophie Durand

// 2. Accès via une méthode publique (Client)
echo $client1->getIdentiteClient() . "<br>"; // Affiche: Client N°C001 : Sophie Durand

// 3. Modification via une méthode publique (Client)
$client1->modifierNomDeFamille('Duval');
echo $client1->getIdentiteClient() . "<br>"; // Affiche: Client N°C001 : Sophie Duval



// 4. TENTATIVE D'ACCÈS DIRECT (depuis l'extérieur) : ERREUR !
// Cette ligne provoquerait une erreur fatale/notice car la propriété est protected.
// echo $client1->nom;

?>