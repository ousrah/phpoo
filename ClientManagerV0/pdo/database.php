<?php
// Connexion PDO


$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '123456'; // Mettez votre mot de passe
$db = 'gestionClients';

$charset = 'utf8mb4';


$dsn = "mysql:host=$db_host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Erreurs sous forme d'exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retourne des tableaux associatifs
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Utilise les vraies requêtes préparées
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    exit("Erreur de connexion : " . $e->getMessage());
}
