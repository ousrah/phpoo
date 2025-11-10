<?php
require 'database.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';

    if (!empty($nom) && !empty($email)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO clients (nom, email, telephone) VALUES (:nom, :email, :telephone)");
            $stmt->execute([
                ':nom' => $nom,
                ':email' => $email,
                ':telephone' => $telephone
            ]);

            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            $error_message = "Erreur lors de l'ajout : " . $e->getMessage();
        }
    } else {
        $error_message = "Le nom et l'email sont obligatoires.";
    }
}

// Récupération des clients
try {
    $stmt = $pdo->query("SELECT id, nom, email, telephone FROM clients ORDER BY id DESC");
    $clients = $stmt->fetchAll();
} catch (PDOException $e) {
    $error_message = "Erreur lors de la récupération des clients : " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion Clients (PDO)</title>
  <style>
    body { font-family: Arial; max-width: 600px; margin: 40px auto; }
    input, button { padding: 8px; margin: 4px; }
    li { margin-bottom: 6px; }
    .error { color: red; font-weight: bold; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Gestion des Clients (Version PDO)</h1>

    <?php if (isset($error_message)): ?>
        <p class="error"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>

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
    </ul>
  </div>
</body>
</html>
