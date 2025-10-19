<?php
require_once 'Client.php';
require_once 'Fournisseur.php';

$client = new Client('Alice', 'Leroy', 'CLT001');
$client->envoyerInvitation('Vente Privée Annuelle');

echo "<hr>";

$fournisseur = new Fournisseur('Paul', 'Garnier', 'Pièces Auto Pro');
$fournisseur->envoyerInvitation('Salon des Fournisseurs 2025');
$fournisseur->validerCompte();