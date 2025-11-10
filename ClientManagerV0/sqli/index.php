<?php
// =======================================================================
// "VERSION ZÉRO" - STYLE PHP 5.6
// Ce fichier illustre la méthode "historique" de construction d'une page web dynamique.
// Notez le mélange de la logique PHP, des requêtes SQL et du code HTML.
// =======================================================================

// ETAPE 1 : INCLUSION MANUELLE DES DÉPENDANCES
// Pas de Composer, donc on doit inclure manuellement notre fichier de connexion.
require 'database.php';


// ETAPE 2 : LOGIQUE DE TRAITEMENT (Le "Contrôleur")
// On vérifie si le formulaire a été soumis en regardant la méthode de la requête HTTP.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Récupération des données du formulaire
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';

    // VALIDATION (très basique ici)
    if (!empty($nom) && !empty($email)) {

        // SÉCURITÉ : Protection contre les injections SQL
        // NOTE PÉDAGOGIQUE : C'est l'ancienne méthode. On "échappe" les caractères spéciaux
        // pour qu'ils ne soient pas interprétés comme du code SQL.
        // C'est moins sûr et plus fastidieux que les requêtes préparées modernes avec PDO.
        $nom_safe = mysqli_real_escape_string($conn, $nom);
        $email_safe = mysqli_real_escape_string($conn, $email);
        $telephone_safe = mysqli_real_escape_string($conn, $telephone);

        // Création de la requête SQL en concaténant les chaînes de caractères.
        $sql_insert = "INSERT INTO clients (nom, email, telephone) VALUES ('$nom_safe', '$email_safe', '$telephone_safe')";
        
        // Exécution de la requête
        if (mysqli_query($conn, $sql_insert)) {
            // SUCCÈS : On redirige pour éviter le re-soumission du formulaire si l'utilisateur rafraîchit la page.
            // C'est le pattern "Post-Redirect-Get" (PRG).
            header("Location: index.php");
            exit(); // Toujours appeler exit() après une redirection.
        } else {
            // ERREUR
            $error_message = "Erreur lors de l'ajout : " . mysqli_error($conn);
        }
    } else {
        $error_message = "Le nom et l'email sont obligatoires.";
    }
}


// ETAPE 3 : RÉCUPÉRATION DES DONNÉES (Le "Modèle")
// On prépare la récupération de tous les clients pour les afficher.
$clients = [];
$sql_select = "SELECT id, nom, email, telephone FROM clients ORDER BY id DESC";
$result = mysqli_query($conn, $sql_select);

if ($result) {
    // On boucle sur les résultats pour les stocker dans un tableau PHP.
    while ($row = mysqli_fetch_assoc($result)) {
        $clients[] = $row;
    }
} else {
    $error_message = "Erreur lors de la récupération des clients : " . mysqli_error($conn);
}

// On ferme la connexion à la base de données à la fin de la partie PHP.
mysqli_close($conn);

?>

<!-- ETAPE 4 : AFFICHAGE (La "Vue") -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion Clients (Style Ancien)</title>
  <style>
    body { font-family: Arial; max-width: 600px; margin: 40px auto; }
    input, button { padding: 8px; margin: 4px; }
    li { margin-bottom: 6px; }
    .error { color: red; font-weight: bold; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Gestion des Clients (Version de Base)</h1>

    <?php if (isset($error_message)): ?>
        <p class="error"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>

    <!-- Formulaire d'ajout qui poste sur la même page (index.php) -->
    <form action="index.php" method="POST">
        <input type="text" name="nom" placeholder="Nom complet" required>
        <input type="email" name="email" placeholder="Adresse email" required>
        <input type="text" name="telephone" placeholder="Téléphone">
        <button type="submit">Ajouter</button>
    </form>

    <hr style="margin: 20px 0;">

   <ul>
            <?php foreach ($clients as $c): ?>
                 <li><?= htmlspecialchars($c["nom"]) ?> — <?= htmlspecialchars($c["email"]) ?></li>

            <?php endforeach; ?>

      </ul
  </div>
</body>
</html>