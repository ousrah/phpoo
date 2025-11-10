<?php

// =======================================================================
// NOTE PÉDAGOGIQUE : Ceci est une ANCIENNE FAÇON de faire.
// Mettre les identifiants directement dans le code est une MAUVAISE PRATIQUE DE SÉCURITÉ.
// Aujourd'hui, on utilise un fichier .env pour externaliser ces informations.
// =======================================================================

$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '123456'; // Mettez votre mot de passe
$db_name = 'gestionClients';

// On utilise l'extension MySQLi (Improved), qui était le successeur de l'ancienne mysql.
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Toujours vérifier la connexion !
if (!$conn) {
    // die() arrête l'exécution du script et affiche un message.
    // C'est une façon très basique de gérer les erreurs.
    die("Échec de la connexion : " . mysqli_connect_error());
}

// S'assurer que la connexion utilise l'encodage UTF-8
mysqli_set_charset($conn, "utf8");

?>