@extends('layoutsapp.master')
@section('title', 'Supervision')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(45deg, #1266f1 0%, #0d6efd 100%);
        --secondary-gradient: linear-gradient(45deg, #4a5568 0%, #2d3748 100%);
    }



    .card {
        border: none;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
        /* Ombre très légère */

        border-radius: 15px;
        overflow: hidden;
    }

    .hidden {
        display: none;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .btn-custom {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>



<section class="mb-4">

    <div id="table-section" class="fade-in">


        <div class="card">
            <div class="card-header text-center py-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Liste de la vue d'ensemble</h2>
                    <div>
                        <button id="deleteSelectedBtn" class="btn btn-danger me-2 d-none" onclick="deleteSelectedRows()">
                            <i class="bi bi-trash"></i> Supprimer la sélection
                        </button>
                        <button type="button" class="btn btn-success me-2" onclick="exportToExcel()">
                            <i class="bi bi-file-excel"></i> Exporter en Excel
                        </button>
                        <button type="button" class="btn btn-primary" onclick="showForm()">
                            <i class="bi bi-plus-circle"></i> Ajouter
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)">
                                </th>
                                <th scope="col">#ID</th>
                                <th scope="col">Domaine</th>
                                <th scope="col">Contenu</th>
                                <th scope="col">Question PA</th>
                                <th scope="col">Méthode</th>
                                <th scope="col">Réponse</th>
                                <th scope="col">Note Obtenue</th>
                                <th scope="col">Établissements</th>
                                <th scope="col">Commentaires</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>

                        <tbody id="table-body">
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>




    <!-- Section Formulaire -->
    <div id="form-section" class="hidden">
        <div class="card">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0">Ajouter une nouvelle entrée</h4>
            </div>
            <div class="card-body">
                <form id="data-form" onsubmit="handleSubmit(event)">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <select id="domaine" name="domaine" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez un domaine</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <select id="contenu" name="contenu" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez un contenu</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <select id="question" name="question" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez une question</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <select id="method" name="method" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez une méthode</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="reponse" class="form-label">Réponse Constat</label>
                            <input type="text" id="reponse" name="reponse" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="note" class="form-label">Note Obtenue</label>
                            <select id="note" name="note" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez une note</option>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="commentaire" class="form-label">Commentaires</label>
                            <textarea id="commentaire" name="commentaire" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label class="form-label mb-0">Établissements</label>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-primary me-2" onclick="selectAllEtablissements()">
                                                <i class="bi bi-check2-all"></i> Tout sélectionner
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary" onclick="deselectAllEtablissements()">
                                                <i class="bi bi-x-lg"></i> Tout désélectionner
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input etablissement-checkbox" type="checkbox" id="etabESPC" value="ESPC">
                                            <label class="form-check-label" for="etabESPC">ESPC</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input etablissement-checkbox" type="checkbox" id="etabEHE" value="EHE">
                                            <label class="form-check-label" for="etabEHE">EHE</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input etablissement-checkbox" type="checkbox" id="etabEESP" value="EESP">
                                            <label class="form-check-label" for="etabEESP">EESP</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input etablissement-checkbox" type="checkbox" id="etabHE" value="HE">
                                            <label class="form-check-label" for="etabHE">HE</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" onclick="showTable()">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <!-- Les toasts seront ajoutés ici dynamiquement -->
    </div>
</section>


<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

<script>
    // Constants globales
const STORAGE_KEYS = {
    SUPERVISIONS: 'offline_supervisions',
    DOMAINES: 'cached_domaines',
    CONTENUS: 'cached_contenus',
    QUESTIONS: 'cached_questions',
    METHODES: 'cached_methodes',
    NOTES: 'cached_notes',
    LAST_SYNC: 'last_sync_timestamp'
};

let isOnline = navigator.onLine;

// Écouteurs d'événements pour la connexion
window.addEventListener('online', handleOnlineStatus);
window.addEventListener('offline', handleOnlineStatus);

// Gestionnaire de cache
const DataCache = {
    async set(key, data) {
        try {
            const cacheData = {
                data: data,
                timestamp: new Date().getTime()
            };
            localStorage.setItem(key, JSON.stringify(cacheData));
            console.log(`Données mises en cache pour ${key}:`, data.length, 'éléments');
        } catch (error) {
            console.error(`Erreur lors du stockage de ${key}:`, error);
            this.clearOldCache();
        }
    },

    get(key) {
        try {
            const cached = localStorage.getItem(key);
            if (!cached) return null;
            const parsedCache = JSON.parse(cached);
            console.log(`Données récupérées du cache pour ${key}:`, parsedCache.data.length, 'éléments');
            return parsedCache.data;
        } catch (error) {
            console.error(`Erreur lors de la récupération de ${key}:`, error);
            return null;
        }
    },

    isExpired(key, expirationTime = 3600000) {
        try {
            const cached = localStorage.getItem(key);
            if (!cached) return true;
            const timestamp = JSON.parse(cached).timestamp;
            return (new Date().getTime() - timestamp) > expirationTime;
        } catch {
            return true;
        }
    },

    clearOldCache() {
        try {
            Object.values(STORAGE_KEYS).forEach(key => {
                if (this.isExpired(key, 86400000)) {
                    localStorage.removeItem(key);
                }
            });
        } catch (error) {
            console.error('Erreur lors du nettoyage du cache:', error);
        }
    }
};

// Gestionnaire de connexion
function handleOnlineStatus() {
    isOnline = navigator.onLine;
    if (isOnline) {
        showSuccessAlert('Connexion rétablie - Synchronisation en cours...');
        syncOfflineData();
    } else {
        showWarningAlert('Mode hors ligne activé - Les données seront synchronisées ultérieurement');
    }
    updateConnectionStatus();
}

function updateConnectionStatus() {
    let statusIndicator = document.getElementById('connection-status');
    if (!statusIndicator) {
        statusIndicator = document.createElement('div');
        statusIndicator.id = 'connection-status';
        statusIndicator.className = 'position-fixed bottom-0 end-0 m-3';
        document.body.appendChild(statusIndicator);
    }
    
    statusIndicator.innerHTML = isOnline ? 
        '<div class="alert alert-success">Connecté</div>' : 
        '<div class="alert alert-warning">Mode hors ligne</div>';
}

// Fonctions de chargement des données
async function loadDataWithCache(apiUrl, storageKey) {
    try {
        const cachedData = DataCache.get(storageKey);
        
        if (isOnline) {
            try {
                const response = await fetch(apiUrl);
                const data = await response.json();
                await DataCache.set(storageKey, data);
                return data;
            } catch (error) {
                console.error(`Erreur de chargement depuis l'API ${apiUrl}:`, error);
                if (cachedData) {
                    showWarningAlert('Utilisation des données en cache');
                    return cachedData;
                }
                throw error;
            }
        } else if (cachedData) {
            showWarningAlert('Mode hors ligne - Utilisation des données en cache');
            return cachedData;
        } else {
            throw new Error('Aucune donnée disponible hors ligne');
        }
    } catch (error) {
        console.error(`Erreur lors du chargement des données ${storageKey}:`, error);
        showErrorAlert('Erreur de chargement des données');
        return null;
    }
}

async function loadDomaines() {
    const data = await loadDataWithCache('/api/domaines', STORAGE_KEYS.DOMAINES);
    if (data && data.domaine) {
        const select = document.getElementById('domaine');
        select.innerHTML = '<option value="">Sélectionnez un domaine</option>';
        data.domaine.forEach(item => {
            select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
        });
    }
}

async function loadContenus() {
    const data = await loadDataWithCache('/api/contenus', STORAGE_KEYS.CONTENUS);
    if (data && data.contenus) {
        const select = document.getElementById('contenu');
        select.innerHTML = '<option value="">Sélectionnez un contenu</option>';
        data.contenus.forEach(item => {
            select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
        });
    }
}

async function loadQuestions() {
    const data = await loadDataWithCache('/api/questions', STORAGE_KEYS.QUESTIONS);
    if (data && data.questions) {
        const select = document.getElementById('question');
        select.innerHTML = '<option value="">Sélectionnez une question</option>';
        data.questions.forEach(item => {
            select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
        });
    }
}

async function loadMethodes() {
    const data = await loadDataWithCache('/api/methodes', STORAGE_KEYS.METHODES);
    if (data && data.methodes) {
        const select = document.getElementById('method');
        select.innerHTML = '<option value="">Sélectionnez une méthode</option>';
        data.methodes.forEach(item => {
            select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
        });
    }
}

async function loadNotes() {
    const data = await loadDataWithCache('/api/notes', STORAGE_KEYS.NOTES);
    if (data && data.notes) {
        const select = document.getElementById('note');
        select.innerHTML = '<option value="">Sélectionnez une note</option>';
        data.notes.forEach(item => {
            select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
        });
    }
}

// Gestion des supervisions
async function loadSupervisions() {
    try {
        const tbody = document.getElementById('table-body');
        tbody.innerHTML = '';

        let supervisions = [];

        // Récupérer d'abord les données en cache
        const cachedData = DataCache.get(STORAGE_KEYS.SUPERVISIONS) || [];
        
        if (isOnline) {
            try {
                const response = await fetch('/api/supervisions/getallsup');
                const serverData = await response.json();
                await DataCache.set(STORAGE_KEYS.SUPERVISIONS, serverData);
                supervisions = serverData;
            } catch (error) {
                console.error('Erreur serveur:', error);
                supervisions = cachedData;
                showWarningAlert('Erreur de connexion - Utilisation des données en cache');
            }
        } else {
            supervisions = cachedData;
            if (supervisions.length > 0) {
                showWarningAlert('Mode hors ligne - Utilisation des données en cache');
            } else {
                showWarningAlert('Aucune donnée disponible en mode hors ligne');
            }
        }

        // Afficher les données synchronisées
        if (supervisions && supervisions.length > 0) {
            supervisions.forEach((supervision, key) => {
                addRowToTable(supervision, key, true);
            });
        }

        // Ajouter les données non synchronisées
        const offlineData = JSON.parse(localStorage.getItem(STORAGE_KEYS.SUPERVISIONS) || '[]');
        if (offlineData.length > 0) {
            offlineData.forEach((supervision, key) => {
                addRowToTable(supervision, supervisions.length + key, false);
            });
        }

    } catch (error) {
        console.error('Erreur lors du chargement des supervisions:', error);
        showErrorAlert('Erreur lors du chargement des données');
    }
}

function addRowToTable(supervision, key, isSynced) {
    const tbody = document.getElementById('table-body');
    const row = document.createElement('tr');
    row.setAttribute('data-id', supervision.id);
    row.innerHTML = `
        <td><input type="checkbox" onchange="updateDeleteButton()"></td>
        <td>${key + 1}</td>
        <td>${supervision.domaine_text} ${!isSynced ? '<span class="badge bg-warning">Non synchronisé</span>' : ''}</td>
        <td>${supervision.contenu_text}</td>
        <td>${supervision.question_text}</td>
        <td>${supervision.methode_text}</td>
        <td>${supervision.reponse}</td>
        <td>${supervision.note_text}</td>
        <td>${supervision.etablissements.join(', ')}</td>
        <td>${supervision.commentaire}</td>
        <td>
            <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">
                <i class="bi bi-trash"></i> Supprimer
            </button>
        </td>
    `;
    tbody.appendChild(row);
}

// Gestion du formulaire
async function handleSubmit(event) {
    event.preventDefault();

    const formData = {
        id: Date.now(),
        domaine: document.getElementById('domaine').value,
        domaine_text: document.getElementById('domaine').options[document.getElementById('domaine').selectedIndex].text,
        contenu: document.getElementById('contenu').value,
        contenu_text: document.getElementById('contenu').options[document.getElementById('contenu').selectedIndex].text,
        question: document.getElementById('question').value,
        question_text: document.getElementById('question').options[document.getElementById('question').selectedIndex].text,
        methode: document.getElementById('method').value,
        methode_text: document.getElementById('method').options[document.getElementById('method').selectedIndex].text,
        reponse: document.getElementById('reponse').value,
        note: document.getElementById('note').value,
        note_text: document.getElementById('note').options[document.getElementById('note').selectedIndex].text,
        commentaire: document.getElementById('commentaire').value,
        etablissements: Array.from(document.querySelectorAll('.etablissement-checkbox:checked')).map(cb => cb.value),
        timestamp: new Date().toISOString(),
        synced: false
    };

    if (isOnline) {
        try {
            await saveToServer(formData);
            showSuccessAlert('Données enregistrées avec succès');
        } catch (error) {
            console.error('Erreur serveur:', error);
            saveToLocalStorage(formData);
            showErrorAlert('Erreur de connexion - Données sauvegardées localement');
        }
    } else {
        saveToLocalStorage(formData);
        showSuccessAlert('Données sauvegardées localement - En attente de synchronisation');
    }

    document.getElementById('data-form').reset();
    showTable();
    loadSupervisions();
}

async function saveToServer(data) {
    const response = await fetch('/api/supervisions/AddSup', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    });

    if (!response.ok) {
        throw new Error('Erreur réseau');
    }

    return response.json();
}

function saveToLocalStorage(data) {
    try {
        const offlineData = JSON.parse(localStorage.getItem(STORAGE_KEYS.SUPERVISIONS) || '[]');
        offlineData.push(data);
        localStorage.setItem(STORAGE_KEYS.SUPERVISIONS, JSON.stringify(offlineData));
        addRowToTable(data, document.querySelectorAll('#table-body tr').length, false);
    } catch (error) {
        console.error('Erreur stockage local:', error);
        showErrorAlert('Erreur lors de la sauvegarde locale');
    }
}

// Synchronisation des données
async function syncOfflineData() {
    if (!isOnline) return;

    try {
        const offlineData = JSON.parse(localStorage.getItem(STORAGE_KEYS.SUPERVISIONS) || '[]');
        if (offlineData.length === 0) return;

        const successfulSyncs = [];

        for (const data of offlineData) {
            try {
                await saveToServer(data);
                successfulSyncs.push(data.id);
            } catch (error) {
                console.error('Erreur synchronisation:', error);
            }
        }

        const remainingData = offlineData.filter(data => !successfulSyncs.includes(data.id));
        localStorage.setItem(STORAGE_KEYS.SUPERVISIONS, JSON.stringify(remainingData));

        if (successfulSyncs.length > 0) {
            showSuccessAlert(`${successfulSyncs.length} données synchronisées avec succès`);
            loadSupervisions();
        }
    } catch (error) {
        console.error('Erreur synchronisation globale:', error);
        showErrorAlert('Erreur lors de la synchronisation');
    }
}

async function syncAllData() {
    if (!isOnline) return;

    try {
        await Promise.all([
            loadDomaines(),
            loadContenus(),
            loadQuestions(),
            loadMethodes(),
            loadNotes(),
            loadSupervisions()
        ]);

        showSuccessAlert('Toutes les données ont été synchronisées');
    } catch (error) {
        console.error('Erreur de synchronisation:', error);
        showErrorAlert('Erreur lors de la synchronisation des données');
    }
}

// Export Excel
function exportToExcel() {
    const tableData = [];
    const headers = [];

    document.querySelectorAll('#data-table thead th').forEach((header, index) => {
        if (index !== 0 && index !== document.querySelectorAll('#data-table thead th').length - 1) {
            headers.push(header.textContent.trim());
        }
    });

    tableData.push(headers);

    document.querySelectorAll('#data-table tbody tr').forEach(row => {
        const rowData = [];
        row.querySelectorAll('td').forEach((cell, index) => {
            if (index !== 0 && index !== row.querySelectorAll('td').length - 1) {
                rowData.push(cell.textContent.trim());
            }
        });
        if (rowData.length > 0) {
            tableData.push(rowData);
        }
    });

  // Export Excel (suite)
  const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.aoa_to_sheet(tableData);
    XLSX.utils.book_append_sheet(wb, ws, "Données Supervision");

    const today = new Date();
    const dateStr = today.toISOString().slice(0, 10);
    XLSX.writeFile(wb, `supervision_${dateStr}.xlsx`);

    showSuccessAlert('Fichier Excel généré avec succès');
}

// Gestion des checkboxes
function toggleAllCheckboxes(source) {
    const checkboxes = document.querySelectorAll('#table-body input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
    updateDeleteButton();
}

function updateDeleteButton() {
    const anyChecked = [...document.querySelectorAll('#table-body input[type="checkbox"]')].some(checkbox => checkbox.checked);
    document.getElementById('deleteSelectedBtn').classList.toggle('d-none', !anyChecked);
}

function deleteSelectedRows() {
    if (!confirm('Êtes-vous sûr de vouloir supprimer les éléments sélectionnés ?')) {
        return;
    }

    const selectedRows = document.querySelectorAll('#table-body input[type="checkbox"]:checked');
    const deletedIds = [];

    selectedRows.forEach(checkbox => {
        const row = checkbox.closest('tr');
        const id = row.getAttribute('data-id');
        deletedIds.push(id);
        row.remove();
    });

    // Supprimer du localStorage
    const offlineData = JSON.parse(localStorage.getItem(STORAGE_KEYS.SUPERVISIONS) || '[]');
    const updatedData = offlineData.filter(item => !deletedIds.includes(item.id.toString()));
    localStorage.setItem(STORAGE_KEYS.SUPERVISIONS, JSON.stringify(updatedData));

    // Supprimer du cache
    const cachedData = DataCache.get(STORAGE_KEYS.SUPERVISIONS) || [];
    const updatedCacheData = cachedData.filter(item => !deletedIds.includes(item.id.toString()));
    DataCache.set(STORAGE_KEYS.SUPERVISIONS, updatedCacheData);

    if (isOnline) {
        // Supprimer du serveur
        deletedIds.forEach(async id => {
            try {
                await fetch(`/api/supervisions/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
            } catch (error) {
                console.error('Erreur lors de la suppression sur le serveur:', error);
            }
        });
    }

    updateDeleteButton();
    showSuccessAlert('Éléments supprimés avec succès');
}

// Gestion des établissements
function selectAllEtablissements() {
    document.querySelectorAll('.etablissement-checkbox').forEach(checkbox => {
        checkbox.checked = true;
    });
}

function deselectAllEtablissements() {
    document.querySelectorAll('.etablissement-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
}

// Navigation formulaire/tableau
function showForm() {
    document.getElementById('form-section').classList.remove('hidden');
    document.getElementById('table-section').classList.add('hidden');
}

function showTable() {
    document.getElementById('form-section').classList.add('hidden');
    document.getElementById('table-section').classList.remove('hidden');
}

// Gestion des alertes
function showSuccessAlert(message) {
    showAlert(message, 'success');
}

function showErrorAlert(message) {
    showAlert(message, 'danger');
}

function showWarningAlert(message) {
    showAlert(message, 'warning');
}

function showAlert(message, type) {
    const toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) return;

    const toast = document.createElement('div');
    toast.className = `toast show align-items-center text-white bg-${type} border-0`;
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
    `;

    toastContainer.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

// Vérification du cache
function checkCacheStatus() {
    Object.entries(STORAGE_KEYS).forEach(([key, value]) => {
        const data = DataCache.get(value);
        console.log(`Cache ${key}:`, {
            present: !!data,
            nombreElements: data ? data.length : 0,
            taille: localStorage.getItem(value)?.length || 0
        });
    });
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    updateConnectionStatus();
    checkCacheStatus();
    
    // Chargement initial des données
    if (isOnline) {
        syncAllData();
    } else {
        Promise.all([
            loadDomaines(),
            loadContenus(),
            loadQuestions(),
            loadMethodes(),
            loadNotes(),
            loadSupervisions()
        ]).catch(error => {
            console.error('Erreur chargement initial:', error);
            showErrorAlert('Erreur lors du chargement initial des données');
        });
    }
    
    // Synchronisation périodique
    setInterval(() => {
        if (isOnline) {
            syncAllData();
        }
    }, 3600000); // Toutes les heures
});

// Gestionnaires d'erreurs globaux
window.onerror = function(message, source, lineno, colno, error) {
    console.error('Erreur globale:', {message, source, lineno, colno, error});
    showErrorAlert('Une erreur inattendue est survenue');
    return false;
};

window.onunhandledrejection = function(event) {
    console.error('Promesse rejetée non gérée:', event.reason);
    showErrorAlert('Une erreur inattendue est survenue');
};
</script>

<!-- <script>
    function exportToExcel() {
        // Récupérer les données du tableau
        const tableData = [];
        const headers = [];

        // Récupérer les en-têtes (sauf la première et dernière colonne)
        document.querySelectorAll('#data-table thead th').forEach((header, index) => {
            if (index !== 0 && index !== document.querySelectorAll('#data-table thead th').length - 1) {
                headers.push(header.textContent.trim());
            }
        });

        // Ajouter les en-têtes comme première ligne
        tableData.push(headers);

        // Récupérer les données des lignes
        document.querySelectorAll('#data-table tbody tr').forEach(row => {
            const rowData = [];
            row.querySelectorAll('td').forEach((cell, index) => {
                // Ignorer la première colonne (checkbox) et la dernière colonne (actions)
                if (index !== 0 && index !== row.querySelectorAll('td').length - 1) {
                    rowData.push(cell.textContent.trim());
                }
            });
            if (rowData.length > 0) {
                tableData.push(rowData);
            }
        });

        // Créer un workbook et une worksheet
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(tableData);

        // Ajouter la worksheet au workbook
        XLSX.utils.book_append_sheet(wb, ws, "Données Supervision");

        // Générer le fichier Excel
        const today = new Date();
        const dateStr = today.toISOString().slice(0, 10);
        XLSX.writeFile(wb, `supervision_${dateStr}.xlsx`);

        // Afficher un message de succès
        showSuccessAlert('Fichier Excel généré avec succès');
    }

    document.addEventListener('DOMContentLoaded', function() {
        loadSupervisions();
        loadDomaines();
        loadContenus();
        loadQuestions();
        loadMethodes();
        loadNotes();

        document.querySelectorAll('#table-body input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButton);
        });

        setTimeout(() => {
            document.getElementById('table-section').classList.add('fade-in');
        }, 100);
    });

    function loadSupervisions() {
        fetch('/api/supervisions/getallsup')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('table-body');
                tbody.innerHTML = ''; // Vider le tableau

                data.forEach((supervision, key) => {
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', supervision.id);
                    row.innerHTML = `
                   
                    <td><input type="checkbox" onchange="updateDeleteButton()"></td>
                     <td>${key + 1}</td>
                    <td>${supervision.domaine_text}</td>
                    <td>${supervision.contenu_text}</td>
                    <td>${supervision.question_text}</td>
                    <td>${supervision.methode_text}</td>
                    <td>${supervision.reponse}</td>
                    <td>${supervision.note_text}</td>
                    <td>${supervision.etablissements.join(', ')}</td>
                    <td>${supervision.commentaire}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </td>
                `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Erreur lors du chargement des supervisions:', error);
                showErrorAlert('Erreur lors du chargement des données');
            });
    }

    // Fonctions de chargement des données
    function loadDomaines() {
        fetch('/api/domaines')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('domaine');
                select.innerHTML = '<option value="">Sélectionnez un domaine</option>';

                if (data.domaine && Array.isArray(data.domaine)) {
                    data.domaine.forEach(item => {
                        select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
                    });
                }
            })
            .catch(handleError);
    }

    function loadContenus() {
        fetch('/api/contenus')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('contenu');
                select.innerHTML = '<option value="">Sélectionnez un contenu</option>';

                if (data.contenus && Array.isArray(data.contenus)) {
                    data.contenus.forEach(item => {
                        select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
                    });
                }
            })
            .catch(handleError);
    }

    function loadQuestions() {
        fetch('/api/questions')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('question');
                select.innerHTML = '<option value="">Sélectionnez une question</option>';

                if (data.questions && Array.isArray(data.questions)) {
                    data.questions.forEach(item => {
                        select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
                    });
                }
            })
            .catch(handleError);
    }

    function loadMethodes() {
        fetch('/api/methodes')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('method');
                select.innerHTML = '<option value="">Sélectionnez une méthode</option>';

                if (data.methodes && Array.isArray(data.methodes)) {
                    data.methodes.forEach(item => {
                        select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
                    });
                }
            })
            .catch(handleError);
    }

    function loadNotes() {
        fetch('/api/notes')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('note');
                select.innerHTML = '<option value="">Sélectionnez une note</option>';

                if (data.notes && Array.isArray(data.notes)) {
                    data.notes.forEach(item => {
                        select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
                    });
                }
            })
            .catch(handleError);
    }

    function handleError(error) {
        console.error('Erreur:', error);
        showErrorAlert('Une erreur est survenue lors du chargement des données.');
    }

    function showErrorAlert(message) {
        const toastContainer = document.querySelector('.toast-container');

        const toastElement = document.createElement('div');
        toastElement.className = 'toast align-items-center text-bg-danger border-0';
        toastElement.setAttribute('role', 'alert');
        toastElement.setAttribute('aria-live', 'assertive');
        toastElement.setAttribute('aria-atomic', 'true');

        toastElement.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

        toastContainer.appendChild(toastElement);

        const toast = new mdb.Toast(toastElement, {
            autohide: true,
            delay: 3000
        });

        toast.show();

        toastElement.addEventListener('hidden.bs.toast', () => {
            toastElement.remove();
        });

        setTimeout(() => {
            alert.remove();
        }, 3000);
    }

    function showSuccessAlert(message) {
        const toastContainer = document.querySelector('.toast-container');

        const toastElement = document.createElement('div');
        toastElement.className = 'toast align-items-center text-bg-success border-0';
        toastElement.setAttribute('role', 'alert');
        toastElement.setAttribute('aria-live', 'assertive');
        toastElement.setAttribute('aria-atomic', 'true');

        toastElement.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

        toastContainer.appendChild(toastElement);

        const toast = new mdb.Toast(toastElement, {
            autohide: true,
            delay: 3000
        });

        toast.show();

        toastElement.addEventListener('hidden.bs.toast', () => {
            toastElement.remove();
        });

        setTimeout(() => {
            alert.remove();
        }, 3000);
    }



    function handleSubmit(event) {
        event.preventDefault();

        const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
        if (!csrfTokenElement) {
            showErrorAlert('CSRF token manquant');
            return;
        }

        const domaineElement = document.getElementById('domaine');
        const contenuElement = document.getElementById('contenu');
        const questionElement = document.getElementById('question');
        const methodElement = document.getElementById('method');
        const noteElement = document.getElementById('note');

        // Vérification des éléments requis
        if (!domaineElement || !contenuElement || !questionElement || !methodElement || !noteElement) {
            showErrorAlert('Certains champs obligatoires sont manquants');
            return;
        }

        const formData = {
            domaine: domaineElement.value,
            domaine_text: domaineElement.options[domaineElement.selectedIndex]?.text || '',
            contenu: contenuElement.value,
            contenu_text: contenuElement.options[contenuElement.selectedIndex]?.text || '',
            question: questionElement.value,
            question_text: questionElement.options[questionElement.selectedIndex]?.text || '',
            methode: methodElement.value,
            methode_text: methodElement.options[methodElement.selectedIndex]?.text || '',
            reponse: document.getElementById('reponse')?.value || '',
            note: noteElement.value,
            note_text: noteElement.options[noteElement.selectedIndex]?.text || '',
            commentaire: document.getElementById('commentaire')?.value || '',
            etablissements: Array.from(document.querySelectorAll('.etablissement-checkbox:checked')).map(cb => cb.value)
        };

        fetch('/api/supervisions/AddSup', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfTokenElement.getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {

                document.getElementById('data-form').reset();
                showTable();
                showSuccessAlert('Données enregistrées avec succès');
                loadSupervisions(); // Recharger le tableau

                showTable()
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorAlert('Erreur lors de l\'enregistrement');
            });
    }

    function toggleAllCheckboxes(source) {
        const checkboxes = document.querySelectorAll('#table-body input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
        updateDeleteButton();
    }

    function updateDeleteButton() {
        const anyChecked = [...document.querySelectorAll('#table-body input[type="checkbox"]')].some(checkbox => checkbox.checked);
        document.getElementById('deleteSelectedBtn').classList.toggle('d-none', !anyChecked);
    }

    function deleteSelectedRows() {
        if (confirm('Êtes-vous sûr de vouloir supprimer les éléments sélectionnés ?')) {
            const checkboxes = document.querySelectorAll('#table-body input[type="checkbox"]:checked');
            checkboxes.forEach(checkbox => {
                checkbox.closest('tr').remove();
            });
            updateDeleteButton();
            showSuccessAlert('Éléments supprimés avec succès');
        }
    }

    function selectAllEtablissements() {
        document.querySelectorAll('.etablissement-checkbox').forEach(checkbox => {
            checkbox.checked = true;
        });
    }

    function deselectAllEtablissements() {
        document.querySelectorAll('.etablissement-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
    }

    function showForm() {
        document.getElementById('form-section').classList.remove('hidden');
        document.getElementById('table-section').classList.add('hidden');
    }

    function showTable() {
        document.getElementById('form-section').classList.add('hidden');
        document.getElementById('table-section').classList.remove('hidden');
    }

    function deleteRow(button) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
            button.closest('tr').remove();
            updateDeleteButton();
            showSuccessAlert('Élément supprimé avec succès');
        }
    }
</script> -->
@endsection