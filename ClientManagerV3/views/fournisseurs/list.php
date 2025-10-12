<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <div>
            <input type="text" id="search-input-fournisseur" placeholder="Rechercher un fournisseur..." class="p-2 border rounded border-gray-300">
        </div>
        <button id="add-fournisseur-btn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Ajouter un Fournisseur
        </button>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Téléphone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Société</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody id="fournisseurs-table-body" class="bg-white divide-y divide-gray-200">
            <?php foreach ($fournisseurs as $fournisseur): ?>
                <tr data-id="<?= $fournisseur->getId() ?>">
                    <td class="px-6 py-4"><?= htmlspecialchars($fournisseur->getNom()) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($fournisseur->getEmail()) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($fournisseur->getTelephone() ?? 'N/A') ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($fournisseur->getSociete() ?? 'N/A') ?></td>
                    <td class="px-6 py-4">
                        <button class="edit-btn text-blue-500 hover:text-blue-700">Modifier</button>
                        <button class="delete-btn text-red-500 hover:text-red-700 ml-2">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- On inclut le MÊME script générique -->
<script src="<?= $_ENV['APP_BASEPATH'] ?>/js/crud-handler.js"></script>
<script>
    // On l'initialise avec la configuration spécifique aux fournisseurs
    document.addEventListener('DOMContentLoaded', () => {
        createCrudHandler({
            entityName: 'fournisseur',
            addBtnId: 'add-fournisseur-btn',
            tableBodyId: 'fournisseurs-table-body',
            searchInputId: 'search-input-fournisseur',
            formId: 'fournisseur-form',
            basePath: '<?= $_ENV['APP_BASEPATH'] ?>'
        });
    });
</script>
