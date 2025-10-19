<?php
require_once 'Personne.php';
require_once 'Client.php';
// Un objet de la classe parent
$personne = new Personne('Garnier', 'Paul');
echo $personne->getInfosDeBase() . "<br>"; // Affiche: Contact : Paul Garnier

// Un objet de la classe enfant
$client = new Client('Leroy', 'Alice', 'CLT001');
echo $client->getInfosDeBase() . "<br>"; // Affiche: Contact : Alice Leroy [Numéro Client: CLT001]
                                          // C'est bien la méthode de Client qui a été appelée.

?>