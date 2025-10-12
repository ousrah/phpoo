<?php
// Si $client n'est pas défini (cas de l'ajout), on crée un objet vide pour éviter les erreurs.
$client = $client ?? null;
?>
<form id="client-form" data-id="<?= $client ? $client->getId() : '' ?>">
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">Nom</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($client ? $client->getNom() : '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($client ? $client->getEmail() : '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">Téléphone</label>
        <input type="text" name="telephone" value="<?= htmlspecialchars($client ? $client->getTelephone() : '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="solde">Solde</label>
        <input type="number" step="0.01" name="solde" value="<?= $client ? $client->getSolde() : 0 ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
    </div>
    <div class="flex items-center justify-end">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Enregistrer
        </button>
    </div>
</form>```


