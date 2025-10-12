// Fonction "usine" qui crée un gestionnaire de CRUD pour une entité donnée.
function createCrudHandler(config) {
    const { entityName, addBtnId, tableBodyId, searchInputId, formId, basePath } = config;

    const modal = document.getElementById('form-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const addBtn = document.getElementById(addBtnId);
    const tableBody = document.getElementById(tableBodyId);
    const searchInput = document.getElementById(searchInputId);

    if (!addBtn || !tableBody) return; // Ne fait rien si les éléments ne sont pas sur la page

    const showModal = () => modal.classList.remove('hidden');
    const hideModal = () => modal.classList.add('hidden');
    const reloadPage = () => window.location.reload();

    // Ouvre la modale pour l'ajout
    addBtn.addEventListener('click', async () => {
        modalTitle.textContent = `Ajouter un ${entityName}`;
        const response = await fetch(`${basePath}/${entityName}s/form`);
        modalBody.innerHTML = await response.text();
        showModal();
    });

    // Gère les clics sur "Modifier" et "Supprimer"
    tableBody.addEventListener('click', async (e) => {
        const target = e.target;
        const row = target.closest('tr');
        if (!row) return;
        const id = row.dataset.id;

        if (target.classList.contains('edit-btn')) {
            modalTitle.textContent = `Modifier le ${entityName}`;
            const response = await fetch(`${basePath}/${entityName}s/${id}/form`);
            modalBody.innerHTML = await response.text();
            showModal();
        }

        if (target.classList.contains('delete-btn')) {
            if (confirm(`Voulez-vous vraiment supprimer ce ${entityName} ?`)) {
                const response = await fetch(`${basePath}/${entityName}s/${id}/delete`, { method: 'POST' });
                const result = await response.json();
                if (result.success) {
                    row.remove();
                } else {
                    alert('Erreur: ' + result.message);
                }
            }
        }
    });

    // Gère la soumission du formulaire (ajout ou modification)
    modalBody.addEventListener('submit', async (e) => {
        if (e.target.id === `${formId}`) {
            e.preventDefault();
            const form = e.target;
            const id = form.dataset.id;
            const formData = new FormData(form);
            const url = id ? `${basePath}/${entityName}s/${id}` : `${basePath}/${entityName}s`;
            
            const response = await fetch(url, { method: 'POST', body: formData });
            const result = await response.json();

            if (response.ok && result.success) {
                hideModal();
                reloadPage();
            } else {
                alert('Erreur: ' + result.message);
            }
        }
    });

    // Gère la recherche
    if (searchInput) {
        searchInput.addEventListener('keyup', () => {
            const filter = searchInput.value.toLowerCase();
            tableBody.querySelectorAll('tr').forEach(row => {
                const textContent = Array.from(row.cells).slice(0, -1).map(cell => cell.textContent).join(' ').toLowerCase();
                row.style.display = textContent.includes(filter) ? '' : 'none';
            });
        });
    }

    // Gère la fermeture de la modale (un seul écouteur pour toute l'app)
    closeModalBtn.addEventListener('click', hideModal);
}