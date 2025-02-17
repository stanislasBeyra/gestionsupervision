@extends('layoutsapp.master')
@section('title', 'Problèmes Prioritaires')

@section('content')
<!-- Dépendances -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

<!-- Container des notifications -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <!-- Les toasts seront ajoutés ici dynamiquement -->
</div>

<!-- Indicateur de connexion -->
<div id="connection-status" class="position-fixed bottom-0 end-0 m-3 d-none">
    <div class="alert alert-warning d-flex align-items-center" role="alert">
        <i class="fas fa-wifi-slash me-2"></i>
        Mode hors ligne
    </div>
</div>

<!-- Section Tableau -->
<div id="table-section">
    <div class="card">
        <div class="card-header text-center py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 gap-md-0">
                <h4 class="h4 mb-0 text-primary fw-bold">
                    <i class="fas fa-list-alt me-2"></i>Problèmes prioritaires identifiés
                </h4>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" onclick="showForm()">
                        <i class="fas fa-plus-circle me-2"></i>Ajouter un problème
                    </button>
                    <button id="sync-button" class="btn btn-outline-primary d-none" onclick="syncData()">
                        <i class="fas fa-sync-alt me-2"></i>Synchroniser
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Problèmes prioritaires</th>
                            <th scope="col">Causes</th>
                            <th scope="col">Actions correctrices</th>
                            <th scope="col">Sources vérification</th>
                            <th scope="col">Acteurs</th>
                            <th scope="col">Ressources</th>
                            <th scope="col">Délais</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="problems-table">
                        <!-- Données dynamiques -->
                    </tbody>
                </table>
            </div>

            <div id="empty-message" class="text-center p-4 d-none">
                <i class="fas fa-clipboard fa-3x mb-3 text-muted"></i>
                <p class="text-muted">Aucun problème prioritaire enregistré</p>
            </div>
        </div>
    </div>
</div>

<!-- Section Formulaire -->
<div id="form-section" class="d-none">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0" id="form-title">
                <i class="fas fa-edit me-2"></i>Ajouter un problème prioritaire
            </h4>
        </div>
        <div class="card-body">
            <form id="problemForm" onsubmit="handleSubmit(event)">
                @csrf
                <div class="row g-4">
                    <!-- Problème -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <textarea id="probleme" name="probleme" class="form-control active" rows="3" required></textarea>
                            <label class="form-label" for="probleme">Problème prioritaire</label>
                        </div>
                        <div class="invalid-feedback">Veuillez décrire le problème</div>
                    </div>

                    <!-- Causes -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <textarea id="causes" name="causes" class="form-control active" rows="3" required></textarea>
                            <label class="form-label" for="causes">Causes</label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <textarea id="actions" name="actions" class="form-control active" rows="3" required></textarea>
                            <label class="form-label" for="actions">Actions correctrices</label>
                        </div>
                    </div>

                    <!-- Sources -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <textarea id="sources" name="sources" class="form-control active" rows="3" required></textarea>
                            <label class="form-label" for="sources">Sources de vérification</label>
                        </div>
                    </div>

                    <!-- Acteurs -->
                    <div class="col-md-4">
                        <div class="form-outline">
                            <input type="text" id="acteurs" name="acteurs" class="form-control active" required />
                            <label class="form-label" for="acteurs">Acteurs (Responsables)</label>
                        </div>
                    </div>

                    <!-- Ressources -->
                    <div class="col-md-4">
                        <div class="form-outline">
                            <input type="text" id="ressources" name="ressources" class="form-control active" required />
                            <label class="form-label" for="ressources">Ressources nécessaires</label>
                        </div>
                    </div>

                    <!-- Délai -->
                    <div class="col-md-4">
                        <div class="form-outline">
                            <input type="text" id="delai" name="delai" class="form-control" placeholder="Sélectionner une date" required />
                            <label class="form-label" for="delai">Délai d'exécution</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-light" onclick="showTable()">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .badge-offline {
        background-color: #ffa000;
        color: white;
        padding: 0.2em 0.6em;
        border-radius: 0.25rem;
        font-size: 0.75em;
        margin-left: 0.5em;
    }

    @media (max-width: 768px) {
        .h4 {
            font-size: 1.25rem;
        }

        .btn {
            padding: 0.5rem 1rem;
        }

        .badge-offline {
            font-size: 0.7em;
        }
    }

    #connection-status {
        z-index: 1050;
    }

    .toast-container {
        z-index: 1060;
    }
</style>

<!-- Scripts -->
<script>
      // Variables globales
let problemCount = 0;
let editingRow = null;
let isOnline = navigator.onLine;

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    try {
        initMDBComponents();
        initFlatpickr();
        initConnectionListeners();
        loadOfflineData();
        checkEmptyTable();
    } catch (error) {
        console.error('Erreur lors de l\'initialisation:', error);
    }
});

// Initialisation des composants MDB
function initMDBComponents() {
    document.querySelectorAll('.form-outline').forEach((formOutline) => {
        new mdb.Input(formOutline).init();
    });
    initTooltips();
}

// Initialisation de Flatpickr
function initFlatpickr() {
    flatpickr("#delai", {
        locale: "fr",
        enableTime: true,
        dateFormat: "d/m/Y H:i",
        time_24hr: true,
        allowInput: true,
        minuteIncrement: 1
    });
}

// Gestion des tooltips
function initTooltips() {
    try {
        const tooltips = document.querySelectorAll('[data-mdb-toggle="tooltip"]');
        tooltips.forEach((el) => {
            if (mdb && mdb.Tooltip) {
                new mdb.Tooltip(el);
            }
        });
    } catch (error) {
        console.error('Erreur lors de l\'initialisation des tooltips:', error);
    }
}

// Gestion de la connexion Internet
function initConnectionListeners() {
    window.addEventListener('online', handleOnline);
    window.addEventListener('offline', handleOffline);
    updateConnectionStatus();
}

function handleOnline() {
    isOnline = true;
    updateConnectionStatus();
    syncData();
    showToast('Connexion Internet rétablie', 'success');
}

function handleOffline() {
    isOnline = false;
    updateConnectionStatus();
    showToast('Mode hors ligne activé', 'warning');
}

function updateConnectionStatus() {
    const statusElement = document.getElementById('connection-status');
    const syncButton = document.getElementById('sync-button');
    
    if (!isOnline) {
        statusElement.classList.remove('d-none');
        syncButton.classList.remove('d-none');
    } else {
        statusElement.classList.add('d-none');
        if (!hasOfflineData()) {
            syncButton.classList.add('d-none');
        }
    }
}

// Gestion des toasts
function showToast(message, type = 'success') {
    const toastContainer = document.querySelector('.toast-container');
    const toastElement = document.createElement('div');
    toastElement.className = `toast align-items-center text-bg-${type} border-0`;
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
    const toast = new mdb.Toast(toastElement);
    toast.show();

    setTimeout(() => {
        toastElement.remove();
    }, 3000);
}

// Gestion du stockage local
function saveLocally(data) {
    try {
        let savedProblems = JSON.parse(localStorage.getItem('offlineProblems') || '[]');
        savedProblems.push(data);
        localStorage.setItem('offlineProblems', JSON.stringify(savedProblems));
        updateConnectionStatus();
    } catch (error) {
        console.error('Erreur lors de la sauvegarde locale:', error);
        showToast('Erreur lors de la sauvegarde locale', 'danger');
    }
}

function hasOfflineData() {
    const offlineProblems = JSON.parse(localStorage.getItem('offlineProblems') || '[]');
    return offlineProblems.length > 0;
}

function loadOfflineData() {
    try {
        const offlineProblems = JSON.parse(localStorage.getItem('offlineProblems') || '[]');
        offlineProblems.forEach(problem => {
            const formData = new FormData();
            for (let key in problem) {
                if (key !== 'offlineCreated' && key !== 'timestamp') {
                    formData.append(key, problem[key]);
                }
            }
            addNewRow(formData, true);
        });
        updateConnectionStatus();
    } catch (error) {
        console.error('Erreur lors du chargement des données locales:', error);
    }
}

// Gestion du formulaire
function showForm() {
    document.getElementById('form-section').classList.remove('d-none');
    document.getElementById('table-section').classList.add('d-none');
    document.getElementById('form-title').innerHTML = 
        `<i class="fas fa-plus-circle me-2"></i>Ajouter un problème prioritaire`;
}

function showTable() {
    document.getElementById('form-section').classList.add('d-none');
    document.getElementById('table-section').classList.remove('d-none');
    document.getElementById('problemForm').reset();
    editingRow = null;
}

async function handleSubmit(event) {
    event.preventDefault();
    const form = event.target;

    if (!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }

    const submitBtn = form.querySelector('button[type="submit"]');
    if (!submitBtn) return;

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Traitement...';

    try {
        const formData = new FormData(form);
        const isOnline = checkInternetConnection();
        
        // Créer l'objet de données
        const problemData = {
            probleme: formData.get('probleme'),
            causes: formData.get('causes'),
            actions: formData.get('actions'),
            sources: formData.get('sources'),
            acteurs: formData.get('acteurs'),
            ressources: formData.get('ressources'),
            delai: formData.get('delai'),
            offlineCreated: !isOnline,
            timestamp: new Date().getTime()
        };

        if (isOnline) {
            try {
                await saveToServer(problemData);
                showToast('Problème ajouté avec succès', 'success');
            } catch (error) {
                saveLocally(problemData);
                showToast('Erreur de connexion - Enregistré localement', 'warning');
            }
        } else {
            saveLocally(problemData);
            showToast('Enregistré localement - En attente de connexion', 'warning');
        }

        if (editingRow) {
            updateRow(editingRow, formData, !isOnline);
        } else {
            addNewRow(formData, !isOnline);
        }
        
        showTable();
        checkEmptyTable();
    } catch (error) {
        console.error('Erreur lors de la soumission:', error);
        showToast('Une erreur est survenue', 'danger');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>Enregistrer';
        form.classList.remove('was-validated');
    }
}

// Synchronisation des données
async function syncData() {
    if (!isOnline) {
        showToast('Pas de connexion Internet', 'warning');
        return;
    }

    try {
        const offlineProblems = JSON.parse(localStorage.getItem('offlineProblems') || '[]');
        if (offlineProblems.length === 0) return;

        for (const problem of offlineProblems) {
            try {
                await saveToServer(problem);
                updateRowVisual(problem.timestamp);
            } catch (error) {
                console.error('Erreur de synchronisation:', error);
                continue;
            }
        }

        localStorage.removeItem('offlineProblems');
        updateConnectionStatus();
        showToast('Données synchronisées avec succès', 'success');
    } catch (error) {
        console.error('Erreur lors de la synchronisation:', error);
        showToast('Erreur de synchronisation', 'danger');
    }
}

// Gestion du tableau
function addNewRow(formData, isOffline = false) {
    try {
        problemCount++;
        const tbody = document.getElementById('problems-table');
        if (!tbody) return;

        const row = document.createElement('tr');
        const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';

        row.innerHTML = `
            <td>${problemCount}</td>
            <td class="text-wrap">
                ${safeText(formData.get('probleme'))}
                ${isOffline ? '<span class="badge badge-offline">Hors ligne</span>' : ''}
            </td>
            <td class="text-wrap">${safeText(formData.get('causes'))}</td>
            <td class="text-wrap">${safeText(formData.get('actions'))}</td>
            <td class="text-wrap">${safeText(formData.get('sources'))}</td>
            <td>${safeText(formData.get('acteurs'))}</td>
            <td>${safeText(formData.get('ressources'))}</td>
            <td>${safeText(formData.get('delai'))}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-link text-warning" 
                            onclick="editProblem(this)" 
                            title="Modifier">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-link text-danger" 
                            onclick="deleteProblem(this)" 
                            title="Supprimer">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;

        if (isOffline) {
            row.dataset.timestamp = new Date().getTime();
        }

        tbody.appendChild(row);
        initTooltips();
    } catch (error) {
        console.error('Erreur lors de l\'ajout de ligne:', error);
        throw error;
    }
}

function updateRow(row, formData, isOffline = false) {
    if (!row) return;

    const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';

    row.cells[1].innerHTML = `
        ${safeText(formData.get('probleme'))}
        ${isOffline ? '<span class="badge badge-offline">Hors ligne</span>' : ''}
    `;
    row.cells[2].textContent = formData.get('causes');
    row.cells[3].textContent = formData.get('actions');
    row.cells[4].textContent = formData.get('sources');
    row.cells[5].textContent = formData.get('acteurs');
    row.cells[6].textContent = formData.get('ressources');
    row.cells[7].textContent = formData.get('delai');

    if (isOffline) {
        row.dataset.timestamp = new Date().getTime();
    }
}

function updateRowVisual(timestamp) {
    const rows = document.querySelectorAll('#problems-table tr');
    rows.forEach(row => {
        if (row.dataset.timestamp === timestamp.toString()) {
            const badge = row.querySelector('.badge-offline');
            if (badge) {
                badge.remove();
            }
            delete row.dataset.timestamp;
        }
    });
}

function editProblem(button) {
    try {
        const row = button.closest('tr');
        if (!row) return;

        editingRow = row;
        const form = document.getElementById('problemForm');
        if (!form) return;

        // Remplir le formulaire
        const fields = ['probleme', 'causes', 'actions', 'sources', 'acteurs', 'ressources'];
        fields.forEach((field, index) => {
            if (form.elements[field]) {
                form.elements[field].value = row.cells[index + 1].textContent.replace(/Hors ligne/g, '').trim();
            }
        });

        // Mettre à jour le datepicker
        const datepicker = document.querySelector("#delai")?._flatpickr;
        if (datepicker) {
            datepicker.setDate(row.cells[7].textContent, true);
        }

        // Activer les labels
        document.querySelectorAll('.form-outline').forEach((formOutline) => {
            formOutline.classList.add('active');
        });

        document.getElementById('form-title').innerHTML =
            `<i class="fas fa-edit me-2"></i>Modifier un problème prioritaire`;

        showForm();
    } catch (error) {
        console.error('Erreur lors de l\'édition:', error);
        showToast('Erreur lors de l\'édition', 'danger');
    }
}

function deleteProblem(button) {
    try {
        const row = button.closest('tr');
        if (!row) return;

        if (confirm('Êtes-vous sûr de vouloir supprimer ce problème ?')) {
            if (row.dataset.timestamp) {
                removeFromLocalStorage(row.dataset.timestamp);
            }
            row.remove();
            updateNumbers();
            checkEmptyTable();
            showToast('Problème supprimé avec succès');
        }
    } catch (error) {
        console.error('Erreur lors de la suppression:', error);
        showToast('Erreur lors de la suppression', 'danger');
    }
}

function removeFromLocalStorage(timestamp) {
    try {
        let savedProblems = JSON.parse(localStorage.getItem('offlineProblems') || '[]');
        savedProblems = savedProblems.filter(problem => problem.timestamp.toString() !== timestamp);
        localStorage.setItem('offlineProblems', JSON.stringify(savedProblems));
        updateConnectionStatus();
    } catch (error) {
        console.error('Erreur lors de la suppression du stockage local:', error);
    }
}

function updateNumbers() {
    const rows = document.querySelectorAll('#problems-table tr');
    rows.forEach((row, index) => {
        row.cells[0].textContent = index + 1;
    });
    problemCount = rows.length;
}

function checkEmptyTable() {
    const emptyMessage = document.getElementById('empty-message');
    const tableBody = document.getElementById('problems-table');

    if (emptyMessage && tableBody) {
        const hasRows = tableBody.querySelectorAll('tr').length > 0;
        emptyMessage.classList.toggle('d-none', hasRows);
    }
}

// Communication avec le serveur
// Suite du code précédent...

async function saveToServer(data) {
    try {
        // const response = await fetch('/api/problemes', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        //         'Accept': 'application/json'
        //     },
        //     body: JSON.stringify(data)
        // });

        // if (!response.ok) {
        //     throw new Error(`Erreur HTTP: ${response.status}`);
        // }

        // return await response.json();
    } catch (error) {
        console.error('Erreur lors de la sauvegarde sur le serveur:', error);
        throw error;
    }
}

// Fonction utilitaire pour vérifier la connexion Internet
function checkInternetConnection() {
    return navigator.onLine;
}

// Fonction pour formater la date
function formatDate(date) {
    if (!date) return '';
    
    const d = new Date(date);
    const day = String(d.getDate()).padStart(2, '0');
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const year = d.getFullYear();
    const hours = String(d.getHours()).padStart(2, '0');
    const minutes = String(d.getMinutes()).padStart(2, '0');
    
    return `${day}/${month}/${year} ${hours}:${minutes}`;
}

// Fonction pour détecter les changements de formulaire
function detectFormChanges() {
    const form = document.getElementById('problemForm');
    const formElements = form.elements;
    let hasChanges = false;

    for (let element of formElements) {
        element.addEventListener('change', () => {
            hasChanges = true;
        });
        element.addEventListener('input', () => {
            hasChanges = true;
        });
    }

    window.addEventListener('beforeunload', (e) => {
        if (hasChanges && !document.getElementById('form-section').classList.contains('d-none')) {
            e.preventDefault();
            e.returnValue = 'Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?';
        }
    });
}

// Fonction pour vérifier périodiquement la connexion et synchroniser
function initPeriodicSync() {
    setInterval(() => {
        if (checkInternetConnection() && hasOfflineData()) {
            syncData();
        }
    }, 300000); // Vérifie toutes les 5 minutes
}

// Fonction pour sauvegarder l'état du tableau
function saveTableState() {
    const table = document.getElementById('problems-table');
    const rows = Array.from(table.getElementsByTagName('tr'));
    const tableState = rows.map(row => ({
        probleme: row.cells[1].textContent.replace(/Hors ligne/g, '').trim(),
        causes: row.cells[2].textContent,
        actions: row.cells[3].textContent,
        sources: row.cells[4].textContent,
        acteurs: row.cells[5].textContent,
        ressources: row.cells[6].textContent,
        delai: row.cells[7].textContent,
        isOffline: row.querySelector('.badge-offline') !== null,
        timestamp: row.dataset.timestamp
    }));

    sessionStorage.setItem('tableState', JSON.stringify(tableState));
}

// Fonction pour restaurer l'état du tableau
function restoreTableState() {
    const savedState = sessionStorage.getItem('tableState');
    if (savedState) {
        const tableState = JSON.parse(savedState);
        const tbody = document.getElementById('problems-table');
        tbody.innerHTML = '';

        tableState.forEach((rowData, index) => {
            const formData = new FormData();
            Object.keys(rowData).forEach(key => {
                if (key !== 'isOffline' && key !== 'timestamp') {
                    formData.append(key, rowData[key]);
                }
            });

            addNewRow(formData, rowData.isOffline);
            
            if (rowData.timestamp) {
                const lastRow = tbody.lastElementChild;
                lastRow.dataset.timestamp = rowData.timestamp;
            }
        });

        updateNumbers();
        checkEmptyTable();
    }
}

// Fonction pour exporter les données en CSV
function exportToCSV() {
    const table = document.getElementById('problems-table');
    const rows = Array.from(table.getElementsByTagName('tr'));
    
    let csvContent = "N°,Problème,Causes,Actions,Sources,Acteurs,Ressources,Délai\n";
    
    rows.forEach((row, index) => {
        const rowData = Array.from(row.cells)
            .map(cell => cell.textContent.replace(/Hors ligne/g, '').trim())
            .map(text => `"${text.replace(/"/g, '""')}"`)
            .join(',');
        csvContent += rowData + '\n';
    });

    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.setAttribute('download', 'problemes_prioritaires.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Initialisation des fonctionnalités supplémentaires
document.addEventListener('DOMContentLoaded', function() {
    detectFormChanges();
    initPeriodicSync();
    restoreTableState();

    // Sauvegarde de l'état du tableau avant de quitter la page
    window.addEventListener('beforeunload', () => {
        saveTableState();
    });

    // Ajout du bouton d'export si nécessaire
    const headerButtons = document.querySelector('.card-header .d-flex');
    if (headerButtons) {
        const exportButton = document.createElement('button');
        exportButton.className = 'btn btn-outline-primary';
        exportButton.innerHTML = '<i class="fas fa-download me-2"></i>Exporter';
        exportButton.onclick = exportToCSV;
        headerButtons.appendChild(exportButton);
    }
});
    

</script>
@endsection