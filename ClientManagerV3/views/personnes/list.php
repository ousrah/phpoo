<div class="bg-white p-6 rounded-lg shadow-lg">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type (Polymorphisme)</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($personnes as $personne): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($personne->getNom()) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($personne->getEmail()) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php
                            // Appel de la méthode getType(). Le résultat dépend de la classe réelle de l'objet ($personne)
                            $type = $personne->getType();
                            $color = ($type === 'Client') ? 'bg-blue-200 text-blue-800' : 'bg-green-200 text-green-800';
                        ?>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $color ?>">
                            <?= htmlspecialchars($type) ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>