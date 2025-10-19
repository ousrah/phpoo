<?php

 require_once 'PersonneFactory.php'; 


echo "Traitement des données via la Factory...<br>";



 $personne = PersonneFactory::creerPersonne('client','Leroy','Alice','Alice@yahoo.fr');
 $personnes[] = $personne;
$personne = PersonneFactory::creerPersonne('fournisseur','Martin','Bob','Menuiserie Bob');
 $personnes[] = $personne;

try{
 $personne = PersonneFactory::creerPersonne('admin','super','man','Planet');
 $personnes[] = $personne;
}
catch(Exception  $ex )
{
echo "<span style='color:red'>Erreur : " .$ex->getMessage().'</span>';
}
echo "<hr>Affichage des profils des personnes créées :<br>";

// Grâce au polymorphisme, on peut appeler getProfilDetails() sur n'importe quel objet
// créé par la fabrique, car on sait qu'ils héritent tous de Personne.
foreach ($personnes as $p) {
    echo $p->getProfilDetails() . "<br>";
}

?>