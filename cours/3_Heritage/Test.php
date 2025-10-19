<?php

require_once 'Client.php';

$client1 = new Client('Leroy', 'Alice', '1985-10-20', 'alice.leroy@email.com');

// On peut utiliser les méthodes de la classe parente (Personne)
echo "Nom du client : " . $client1->getNomComplet() . "<br>";
echo "Âge du client : " . $client1->getAge() . " ans<br>";

// Et les méthodes de la classe enfant (Client)
echo "Email du client : " . $client1->getEmail() . "<br>";
echo $client1->getInfos() . "<br>";

?>