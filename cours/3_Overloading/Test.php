<?php
require_once 'Personne.php';

$alice = new Personne('Leroy', 'Alice');
$paul = new Personne('Garnier', 'Paul');

// Appel de la méthode sans argument (Cas 1)
$alice->sePresenter(); // Affiche: Bonjour, je m'appelle Alice Leroy.

// Appel de la méthode avec un argument (Cas 2)
$alice->sePresenter($paul); // Affiche: Alice Leroy : Bonjour Paul Garnier, enchanté(e) !
?>