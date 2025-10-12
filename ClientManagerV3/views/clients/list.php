<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <div>
            <input type="text" id="search-input" placeholder="Rechercher un client..." class="p-2 border rounded border-gray-300">
        </div>
        <button id="add-client-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Ajouter un Client
        </button>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Téléphone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Solde</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody id="clients-table-body" class="bg-white divide-y divide-gray-200">
            <?php foreach ($clients as $client): ?>
                <tr data-id="<?= $client->getId() ?>">
                    <td class="px-6 py-4"><?= htmlspecialchars($client->getNom()) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($client->getEmail()) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($client->getTelephone() ?? 'N/A') ?></td>
                    <td class="px-6 py-4"><?= number_format($client->getSolde(), 2, ',', ' ') ?> €</td>
                    <td class="px-6 py-4">
                        <button class="edit-btn text-blue-500 hover:text-blue-700">Modifier</button>
                        <button class="delete-btn text-red-500 hover:text-red-700 ml-2">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="<?= $_ENV['APP_BASEPATH'] ?>/js/crud-handler.js"></script>
<script>
    // On l'initialise avec la configuration spécifique aux clients
    document.addEventListener('DOMContentLoaded', () => {
        createCrudHandler({
            entityName: 'client',
            addBtnId: 'add-client-btn',
            tableBodyId: 'clients-table-body',
            searchInputId: 'search-input',
            formId: 'client-form',
            basePath: '<?= $_ENV['APP_BASEPATH'] ?>'
        });
    });
</script>
