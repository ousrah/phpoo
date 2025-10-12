<?php
$fournisseur = $fournisseur ?? null;
?>
<form id="fournisseur-form" data-id="<?= $fournisseur ? $fournisseur->getId() : '' ?>">
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">Nom</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($fournisseur ? $fournisseur->getNom() : '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($fournisseur ? $fournisseur->getEmail() : '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">Téléphone</label>
        <input type="text" name="telephone" value="<?= htmlspecialchars($fournisseur ? $fournisseur->getTelephone() : '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="societe">Société</label>
        <input type="text" name="societe" value="<?= htmlspecialchars($fournisseur ? $fournisseur->getSociete() : '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
    </div>
    <div class="flex items-center justify-end">
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Enregistrer
        </button>
    </div>
</form>