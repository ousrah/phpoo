<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Clients</title>
  <style>
    body { font-family: Arial; max-width: 600px; margin: 40px auto; }
    input, button { padding: 8px; margin: 4px; }
    li { margin-bottom: 6px; }
    .error { color: red; font-weight: bold; }
  </style>
</head>
<body>
  <h1>Gestion des Clients</h1>

  <?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="POST">
    <input type="text" name="nom" placeholder="Nom complet" required>
    <input type="email" name="email" placeholder="Adresse email" required>
    <input type="text" name="telephone" placeholder="Téléphone">
    <button type="submit">Ajouter</button>
  </form>

  <hr>

  <ul>
  <?php foreach ($clients as $c): ?>
    <li><?= htmlspecialchars($c->nom) ?> — <?= htmlspecialchars($c->email) ?></li>
  <?php endforeach; ?>
  </ul>
</body>
</html>
