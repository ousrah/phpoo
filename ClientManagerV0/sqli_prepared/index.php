<?php
require 'database.php';

$error_message = '';
$clients = [];

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');

    if ($nom === '' || $email === '') {
        $error_message = "Le nom et l'email sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Email invalide.";
    } else {
        // Requête préparée INSERT (protection contre SQLi)
        $stmt = $conn->prepare("INSERT INTO clients (nom, email, telephone) VALUES (?, ?, ?)");
        if ($stmt === false) {
            $error_message = "Préparation impossible : " . $conn->error;
        } else {
            $stmt->bind_param("sss", $nom, $email, $telephone);
            if ($stmt->execute()) {
                $stmt->close();
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Erreur lors de l'ajout : " . $stmt->error;
                $stmt->close();
            }
        }
    }
}

// Récupération sécurisée des clients avec requête préparée
$stmt = $conn->prepare("SELECT id, nom, email, telephone FROM clients ORDER BY id DESC");
if ($stmt) {
    $stmt->execute();

    // utilisation de get_result (mysqlnd) :
    $result = $stmt->get_result();
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $clients[] = $row;
        }
        $result->free();
    } else {
        // fallback si get_result non disponible : bind_result + fetch
        $stmt->bind_result($id, $nom_r, $email_r, $tel_r);
        while ($stmt->fetch()) {
            $clients[] = ['id' => $id, 'nom' => $nom_r, 'email' => $email_r, 'telephone' => $tel_r];
        }
    }

    $stmt->close();
} else {
    $error_message = "Erreur lors de la récupération des clients : " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion Clients (mysqli préparé)</title>
  <style>
    body { font-family: Arial; max-width: 600px; margin: 40px auto; }
    input, button { padding: 8px; margin: 4px; }
    li { margin-bottom: 6px; }
    .error { color: red; font-weight: bold; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Gestion des Clients (mysqli préparé)</h1>

    <?php if ($error_message): ?>
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
