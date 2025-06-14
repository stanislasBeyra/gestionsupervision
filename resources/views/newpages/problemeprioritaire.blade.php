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
    <div class="row mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">Liste des Problèmes prioritaires</h2>
                <p class="text-muted mb-0">Aperçu de la vue des Problèmes prioritaires</p>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-success" onclick="exportToCSV()">
                    <i class="bi bi-file-excel me-2"></i>Exporter en Excel
                </button>
                <button type="button" class="btn btn-primary" onclick="showForm()">
                    <i class="fas fa-plus-circle me-2"></i>Ajouter un problème
                </button>
            </div>
        </div>
    </div>

    <!-- Barre de recherche -->
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" id="search-problemes" class="form-control" placeholder="Rechercher..." onkeyup="searchProblemes()">
                <button class="btn btn-primary" type="button" onclick="searchProblemes()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Date de creation</th>
                            <th scope="col">Problèmes prioritaires</th>
                            <th scope="col">Causes</th>
                            <th scope="col">Actions correctrices</th>
                            <th scope="col">Sources vérification</th>
                            <th scope="col">Acteurs</th>
                            <th scope="col">Ressources</th>
                            <th scope="col">Délais</th>
                            <!-- <th scope="col">Actions</th> -->
                        </tr>
                    </thead>
                    <tbody id="problems-table">
                        <!-- Données dynamiques -->
                    </tbody>
                </table>
            </div>

            <!-- Conteneur de pagination -->


            <div id="empty-message" class="text-center p-4 d-none">
                <i class="fas fa-clipboard fa-3x mb-3 text-muted"></i>
                <p class="text-muted">Aucun problème prioritaire enregistré</p>
            </div>
            <div id="pagination-container" class="mt-3"></div>
        </div>
    </div>
</div>

<!-- Section Formulaire -->
<div id="form-section" class="d-none">
    <div class="row mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <h2 class="mb-1" id="form-title">Nouveau problème</h2>
                <p class="text-muted mb-0" id="form-subtitle">Ajouter un nouveau problème prioritaire</p>
            </div>
            <button class="btn btn-secondary" onclick="showTable()">
                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form id="problemForm" onsubmit="handleSubmit(event)">
                @csrf
                <div class="row g-4">
                    <!-- Problème -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <textarea id="probleme" name="probleme" class="form-control" rows="3" required></textarea>
                            <label class="form-label" for="probleme">Problème prioritaire</label>
                        </div>
                    </div>

                    <!-- Causes -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <textarea id="causes" name="causes" class="form-control" rows="3" required></textarea>
                            <label class="form-label" for="causes">Causes</label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <textarea id="actions" name="actions" class="form-control" rows="3" required></textarea>
                            <label class="form-label" for="actions">Actions correctrices</label>
                        </div>
                    </div>

                    <!-- Sources -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <textarea id="sources" name="sources" class="form-control" rows="3" required></textarea>
                            <label class="form-label" for="sources">Sources de vérification</label>
                        </div>
                    </div>

                    <!-- Acteurs -->
                    <div class="col-md-4">
                        <div class="form-outline">
                            <input type="text" id="acteurs" name="acteurs" class="form-control" required />
                            <label class="form-label" for="acteurs">Acteurs (Responsables)</label>
                        </div>
                    </div>

                    <!-- Ressources -->
                    <div class="col-md-4">
                        <div class="form-outline">
                            <input type="text" id="ressources" name="ressources" class="form-control" required />
                            <label class="form-label" for="ressources">Ressources nécessaires</label>
                        </div>
                    </div>

                    <!-- Délai -->
                    <div class="col-md-4">
                        <div class="form-outline">
                            <input type="text" id="delai" name="delai" class="form-control datepicker" placeholder="Sélectionner une date" required />
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
    /* Styles pour la pagination */
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination .page-link {
        color: #007bff;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: transparent;
        border-color: #dee2e6;
    }

    #pagination-container {
        margin-top: 1rem;
        display: flex;
        justify-content: center;
    }

    /* Autres styles existants */
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

 <!--  a utiliser pour editer et supprimer -->
<!--
<td>
    <div class="btn-group btn-group-sm">
        <button type="button" class="btn btn-link text-warning"
            onclick="ProblemeManager.editProblem('${probleme.id}')"
            title="Modifier">
            <i class="fas fa-edit"></i>
        </button>
        <button type="button" class="btn btn-link text-danger"
            onclick="ProblemeManager.deleteProblem('${probleme.id}')"
            title="Supprimer">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</td> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Scripts -->
<script>
    // Configuration globale
    const CONFIG = {
        ENDPOINTS: {
            GET_PROBLEMES: '/api/problemes',
            SAVE_PROBLEME: '/api/problemes/save',
            DELETE_PROBLEME: '/api/problemes/delete'
        },
        STORAGE_KEYS: {
            OFFLINE_PROBLEMS: 'offlineProblems',
            LAST_SYNC: 'lastSync',
            FORM_STATE: 'formState'
        }
    };

    // Gestionnaire de notifications
    const NotificationManager = {
        init() {
            if (!document.querySelector('.toast-container')) {
                const container = document.createElement('div');
                container.className = 'toast-container position-fixed top-0 end-0 p-3';
                document.body.appendChild(container);
            }
        },

        show(message, type = 'success') {
            const toastContainer = document.querySelector('.toast-container');
            if (!toastContainer) return;

            const toastElement = document.createElement('div');
            toastElement.className = `toast align-items-center text-white bg-${type} border-0`;
            toastElement.setAttribute('role', 'alert');
            toastElement.setAttribute('aria-live', 'assertive');
            toastElement.setAttribute('aria-atomic', 'true');
            toastElement.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-mdb-dismiss="toast"></button>
            </div>
        `;

            toastContainer.appendChild(toastElement);
            const toast = new mdb.Toast(toastElement);
            toast.show();

            setTimeout(() => toastElement.remove(), 3000);
        }
    };

    // Gestionnaire des problèmes
    const ProblemeManager = {
        currentPage: 1,
        editingId: null,
        isOnline: navigator.onLine,
        isSyncing: false,
        isSubmitting: false, // Ajouté pour éviter les doubles soumissions

        init() {
            NotificationManager.init();
            this.initMDBComponents();
            this.initFlatpickr();
            this.setupEventListeners();
            this.initStorageManager();
            this.loadProblemes();

            // Vérifie s'il y a des données à synchroniser au démarrage
            if (this.isOnline) {
                this.checkPendingSync();
            }
        },

        initMDBComponents() {
            document.querySelectorAll('.form-outline').forEach((formOutline) => {
                new mdb.Input(formOutline).init();
            });
        },

        initFlatpickr() {
            const dateInput = document.getElementById('delai');
            if (dateInput && window.flatpickr) {
                flatpickr(dateInput, {
                    locale: "fr",
                    enableTime: true,
                    dateFormat: "Y-m-d H:i:s",
                    time_24hr: true,
                    allowInput: true,
                    altInput: true,
                    altFormat: "d/m/Y H:i",
                    defaultHour: new Date().getHours(),
                    defaultMinute: new Date().getMinutes()
                });
            }
        },

        setupEventListeners() {
            // Gestion de la recherche
            const searchInput = document.getElementById('search-problemes');
            if (searchInput) {
                let debounceTimer;
                searchInput.addEventListener('input', () => {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        this.loadProblemes(1, searchInput.value.trim());
                    }, 300);
                });
            }

            // Gestion du formulaire
            const form = document.getElementById('problemForm');
            if (form) {
                form.addEventListener('submit', (e) => this.handleSubmit(e));
            }

            // Gestion des boutons
            document.querySelectorAll('[data-action]').forEach(button => {
                button.addEventListener('click', (e) => {
                    const action = e.currentTarget.dataset.action;
                    if (action === 'showForm') this.showForm();
                    if (action === 'showTable') this.showTable();
                    if (action === 'exportCsv') this.exportToCSV();
                });
            });
        },

        initStorageManager() {
            window.addEventListener('online', () => this.handleOnline());
            window.addEventListener('offline', () => this.handleOffline());
            this.updateConnectionStatus();
            this.checkOfflineData();
        },

        async checkPendingSync() {
            const pendingData = localStorage.getItem(CONFIG.STORAGE_KEYS.OFFLINE_PROBLEMS);
            if (pendingData) {
                const problems = JSON.parse(pendingData);
                const lastSync = localStorage.getItem(CONFIG.STORAGE_KEYS.LAST_SYNC);
                const now = new Date().getTime();

                // Synchroniser si pas de dernière sync ou si > 5 minutes
                if (!lastSync || (now - new Date(lastSync).getTime()) > 5 * 60 * 1000) {
                    await this.syncPendingProblems();
                }
            }
        },

        async syncPendingProblems() {
            if (!this.isOnline || this.isSyncing) return;

            try {
                this.isSyncing = true;
                this.updateSyncStatus(true);

                const pendingData = localStorage.getItem(CONFIG.STORAGE_KEYS.OFFLINE_PROBLEMS);
                if (!pendingData) {
                    this.isSyncing = false;
                    this.updateSyncStatus(false);
                    return;
                }

                const problems = JSON.parse(pendingData);
                let syncedCount = 0;
                let failedCount = 0;

                NotificationManager.show(`Synchronisation de ${problems.length} problème(s) en cours...`, 'info');

                for (const problem of problems) {
                    try {
                        const formData = new FormData();
                        for (let [key, value] of Object.entries(problem)) {
                            if (key === 'delai') {
                                const date = new Date(value);
                                if (!isNaN(date)) {
                                    formData.append(key, date.toISOString().slice(0, 19).replace('T', ' '));
                                } else {
                                    formData.append(key, value);
                                }
                            } else if (key !== 'timestamp' && key !== 'offline') {
                                formData.append(key, value);
                            }
                        }

                        const response = await fetch(CONFIG.ENDPOINTS.SAVE_PROBLEME, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();
                        if (data.success) {
                            syncedCount++;
                        } else {
                            failedCount++;
                            console.error('Erreur de synchronisation:', data.message);
                        }
                    } catch (error) {
                        failedCount++;
                        console.error('Erreur lors de la synchronisation:', error);
                    }
                }

                if (syncedCount > 0) {
                    localStorage.removeItem(CONFIG.STORAGE_KEYS.OFFLINE_PROBLEMS);
                    NotificationManager.show(
                        `${syncedCount} problème(s) synchronisé(s) avec succès${failedCount > 0 ? `, ${failedCount} échec(s)` : ''}`,
                        failedCount > 0 ? 'warning' : 'success'
                    );
                    this.loadProblemes(this.currentPage);
                } else if (failedCount > 0) {
                    NotificationManager.show(
                        `Échec de la synchronisation pour ${failedCount} problème(s)`,
                        'danger'
                    );
                }

                localStorage.setItem(CONFIG.STORAGE_KEYS.LAST_SYNC, new Date().toISOString());

            } catch (error) {
                console.error('Erreur globale de synchronisation:', error);
                NotificationManager.show('Erreur lors de la synchronisation', 'danger');
            } finally {
                this.isSyncing = false;
                this.updateSyncStatus(false);
            }
        },

        updateSyncStatus(isSyncing) {
            const statusElement = document.getElementById('sync-status');
            if (statusElement) {
                statusElement.classList.toggle('d-none', !isSyncing);
            }
        },

        loadProblemes(page = 1, search = '') {
            const tableBody = document.getElementById('problems-table');
            if (!tableBody) return;

            tableBody.innerHTML = `
            <tr>
                <td colspan="9" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </td>
            </tr>
        `;

            if (!this.isOnline) {
                this.loadOfflineData();
                return;
            }

            fetch(`${CONFIG.ENDPOINTS.GET_PROBLEMES}?page=${page}&search=${search}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(response => {
                    if (response.success) {
                        this.displayProblemes(response.problemes.data);
                        this.renderPagination(response.problemes);
                        this.currentPage = page;
                    }
                })
                .catch(error => {
                    console.error('Erreur de chargement:', error);
                    NotificationManager.show('Erreur lors du chargement des données', 'danger');
                    this.loadOfflineData();
                });
        },

        async handleSubmit(event) {
            event.preventDefault();

            const form = event.target;
            if (!form.checkValidity()) {
                event.stopPropagation();
                form.classList.add('was-validated');
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnContent = submitBtn.innerHTML;

            // Empêcher double soumission
            if (this.isSubmitting) {
                return;
            }
            this.isSubmitting = true;

            submitBtn.disabled = true; // Désactiver le bouton immédiatement
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Traitement...';

            try {
                const formData = new FormData(form);
                if (this.editingId) {
                    formData.append('id', this.editingId);
                }

                // Formater la date pour MySQL
                const delaiInput = form.querySelector('#delai');
                if (delaiInput?._flatpickr) {
                    const selectedDate = delaiInput._flatpickr.selectedDates[0];
                    if (selectedDate) {
                        formData.set('delai', selectedDate.toISOString().slice(0, 19).replace('T', ' '));
                    }
                }

                if (!this.isOnline) {
                    this.saveOffline(formData);
                    this.showTable();
                    return;
                }

                const response = await fetch(CONFIG.ENDPOINTS.SAVE_PROBLEME, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                if (data.success) {
                    NotificationManager.show(
                        this.editingId ? 'Problème modifié avec succès' : 'Problème ajouté avec succès',
                        'success'
                    );
                    this.showTable();
                    this.loadProblemes(this.currentPage);
                } else {
                    throw new Error(data.message || 'Erreur lors de l\'enregistrement');
                }
            } catch (error) {
                console.error('Erreur:', error);
                NotificationManager.show(error.message || 'Erreur lors de l\'enregistrement', 'danger');
            } finally {
                this.isSubmitting = false; // Réinitialiser le drapeau
                submitBtn.disabled = false; // Réactiver le bouton
                submitBtn.innerHTML = originalBtnContent;
                form.classList.remove('was-validated');
            }
        },

        saveOffline(formData) {
            try {
                const data = {};
                for (let [key, value] of formData.entries()) {
                    data[key] = value;
                }
                data.id = this.editingId || Date.now();
                data.timestamp = new Date().toISOString();
                data.offline = true;

                let offlineProblems = JSON.parse(localStorage.getItem(CONFIG.STORAGE_KEYS.OFFLINE_PROBLEMS) || '[]');

                if (this.editingId) {
                    offlineProblems = offlineProblems.map(p =>
                        p.id.toString() === this.editingId.toString() ? data : p
                    );
                } else {
                    offlineProblems.push(data);
                }

                localStorage.setItem(CONFIG.STORAGE_KEYS.OFFLINE_PROBLEMS, JSON.stringify(offlineProblems));
                this.loadOfflineData();

                NotificationManager.show(
                    'Données sauvegardées localement. Synchronisation automatique à la reconnexion.',
                    'info'
                );
            } catch (error) {
                console.error('Erreur sauvegarde hors ligne:', error);
                NotificationManager.show('Erreur lors de la sauvegarde locale', 'danger');
            }
        },

        editOfflineProblem(id) {
            try {
                const offlineData = localStorage.getItem(CONFIG.STORAGE_KEYS.OFFLINE_PROBLEMS);
                if (!offlineData) return;

                const problems = JSON.parse(offlineData);
                const problem = problems.find(p => p.id.toString() === id.toString());

                if (problem) {
                    this.fillForm(problem);
                    this.editingId = id;
                    this.showForm();
                }
            } catch (error) {
                console.error('Erreur édition hors ligne:', error);
                NotificationManager.show('Erreur lors de l\'édition', 'danger');
            }
        },

        deleteOfflineProblem(id) {
            try {
                const offlineData = localStorage.getItem(CONFIG.STORAGE_KEYS.OFFLINE_PROBLEMS);
                if (!offlineData) return;

                let problems = JSON.parse(offlineData);
                problems = problems.filter(p => p.id.toString() !== id.toString());

                localStorage.setItem(CONFIG.STORAGE_KEYS.OFFLINE_PROBLEMS, JSON.stringify(problems));
                const row = document.querySelector(`tr[data-id="${id}"]`);
                if (row) row.remove();
                this.updateRowNumbers();
                NotificationManager.show('Problème supprimé avec succès', 'success');
            } catch (error) {
                console.error('Erreur suppression hors ligne:', error);
                NotificationManager.show('Erreur lors de la suppression', 'danger');
            }
        },

        loadOfflineData() {
            try {
                const offlineData = localStorage.getItem(CONFIG.STORAGE_KEYS.OFFLINE_PROBLEMS);
                if (offlineData) {
                    const problems = JSON.parse(offlineData);
                    this.displayProblemes(problems, true);
                    NotificationManager.show('Affichage des données hors ligne', 'info');
                } else {
                    this.displayProblemes([]);
                }
            } catch (error) {
                console.error('Erreur de chargement hors ligne:', error);
                this.displayProblemes([]);
            }
        },

        displayProblemes(problemes, isOffline = false) {
            const tableBody = document.getElementById('problems-table');
            if (!tableBody) return;

            tableBody.innerHTML = '';

            if (problemes.length === 0) {
                tableBody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center py-4">
                        <i class="fas fa-folder-open fa-2x mb-3 text-muted"></i>
                        <p class="text-muted mb-0">Aucun problème prioritaire trouvé</p>
                    </td>
                </tr>
            `;
                return;
            }
            problemes.forEach((probleme, index) => {
                const row = this.createRow(probleme, index + 1, isOffline);
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        },

        createRow(probleme, index, isOffline = false) {
            const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';

            return `
            <tr data-id="${probleme.id}" ${isOffline ? 'data-offline="true"' : ''}>
                <td>${index}</td>
                <td>${this.formatDatecreated(probleme.created_at)}</td>
                <td class="text-wrap">
                    ${safeText(probleme.probleme)}
                    ${isOffline ? '<span class="badge bg-warning text-dark">Hors ligne</span>' : ''}
                </td>
                <td class="text-wrap">${safeText(probleme.causes)}</td>
                <td class="text-wrap">${safeText(probleme.actions)}</td>
                <td class="text-wrap">${safeText(probleme.sources)}</td>
                <td>${safeText(probleme.acteurs)}</td>
                <td>${safeText(probleme.ressources)}</td>
                <td>${this.formatDate(probleme.delai)}</td>

            </tr>
        `;
        },

        formatDate(date) {
            if (!date) return '';

            try {
                const d = new Date(date);
                if (isNaN(d.getTime())) return date;

                const day = d.getDate().toString().padStart(2, '0');
                const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
                const month = months[d.getMonth()];
                const year = d.getFullYear();
                const hours = d.getHours().toString().padStart(2, '0');
                const minutes = d.getMinutes().toString().padStart(2, '0');
                const seconds = d.getSeconds().toString().padStart(2, '0');

                return `${day} ${month} ${year} `;
            } catch (error) {
                console.error('Erreur de formatage de date:', error);
                return date || '';
            }
        },

        formatDatecreated(date) {
            if (!date) return '';

            try {
                const d = new Date(date);
                if (isNaN(d.getTime())) return date;

                const day = d.getDate().toString().padStart(2, '0');
                const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
                const month = months[d.getMonth()];
                const year = d.getFullYear();
                const hours = d.getHours().toString().padStart(2, '0');
                const minutes = d.getMinutes().toString().padStart(2, '0');
                const seconds = d.getSeconds().toString().padStart(2, '0');

                return `${day} ${month} ${year} à ${hours}:${minutes}:${seconds} `;
            } catch (error) {
                console.error('Erreur de formatage de date:', error);
                return date || '';
            }
        },

        renderPagination(paginationData) {
            const paginationContainer = document.getElementById('pagination-container');
            if (!paginationContainer) return;

            const currentPage = paginationData.current_page;
            const lastPage = paginationData.last_page;

            let paginationHTML = `
            <nav aria-label="Pagination des établissements">
                <ul class="pagination pagination-circle justify-content-center">
        `;

            // Bouton Previous
            paginationHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="ProblemeManager.loadProblemes(${currentPage - 1})" ${currentPage === 1 ? 'tabindex="-1" aria-disabled="true"' : ''}>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        `;

            // Pages
            paginationData.links.forEach(link => {
                if (link.url && !link.label.includes('Previous') && !link.label.includes('Next')) {
                    const pageNum = parseInt(link.label);
                    paginationHTML += `
                    <li class="page-item ${link.active ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="ProblemeManager.loadProblemes(${pageNum})">
                            ${link.label}
                        </a>
                    </li>
                `;
                }
            });

            // Bouton Next
            paginationHTML += `
            <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="ProblemeManager.loadProblemes(${currentPage + 1})" ${currentPage === lastPage ? 'tabindex="-1" aria-disabled="true"' : ''}>
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        `;

            paginationHTML += `
                </ul>
            </nav>
        `;

            paginationContainer.innerHTML = paginationHTML;
        },

        showForm() {
            const formSection = document.getElementById('form-section');
            const tableSection = document.getElementById('table-section');
            const formTitle = document.getElementById('form-title');

            if (formSection && tableSection) {
                // Sauvegarder l'état du tableau
                const tableState = {
                    page: this.currentPage,
                    editingId: this.editingId,
                    timestamp: new Date().toISOString()
                };
                localStorage.setItem(CONFIG.STORAGE_KEYS.FORM_STATE, JSON.stringify(tableState));

                // Afficher le formulaire
                formSection.classList.remove('d-none');
                tableSection.classList.add('d-none');

                // Mettre à jour le titre
                if (formTitle) {
                    formTitle.innerHTML = this.editingId ?
                        '<i class="fas fa-edit me-2"></i>Modifier un problème' :
                        '<i class="fas fa-plus-circle me-2"></i>Nouveau problème';
                }

                // Réinitialiser les composants MDB
                this.initMDBComponents();
            }
        },

        showTable() {
            const formSection = document.getElementById('form-section');
            const tableSection = document.getElementById('table-section');
            const form = document.getElementById('problemForm');

            if (formSection && tableSection) {
                // Vérifier les modifications non sauvegardées
                if (form && this.hasUnsavedChanges(form)) {
                    if (!confirm('Vous avez des modifications non sauvegardées. Voulez-vous vraiment quitter ?')) {
                        return;
                    }
                }

                // Afficher le tableau
                formSection.classList.add('d-none');
                tableSection.classList.remove('d-none');

                // Réinitialiser le formulaire
                if (form) {
                    form.reset();
                    form.classList.remove('was-validated');
                    form.querySelectorAll('.form-outline').forEach(outline => {
                        outline.classList.remove('active');
                    });
                }

                this.editingId = null;
                this.loadProblemes(this.currentPage);
            }
        },

        updateRowNumbers() {
            const rows = document.querySelectorAll('#problems-table tr');
            rows.forEach((row, index) => {
                const numberCell = row.cells[0];
                if (numberCell) {
                    numberCell.textContent = index + 1;
                }
            });
        },

        hasUnsavedChanges(form) {
            if (!form || !this.editingId) return false;

            const formData = new FormData(form);
            const currentState = Object.fromEntries(formData.entries());
            const savedState = localStorage.getItem(`${CONFIG.STORAGE_KEYS.FORM_STATE}_${this.editingId}`);

            if (!savedState) return false;

            const previousState = JSON.parse(savedState);
            return Object.keys(currentState).some(key =>
                currentState[key] !== previousState[key]
            );
        },

        handleOnline() {
            this.isOnline = true;
            this.updateConnectionStatus();
            NotificationManager.show('Connexion rétablie', 'success');
            this.syncPendingProblems(); // Correction : appel syncPendingProblems au lieu de syncOfflineData qui n'existe pas
        },

        handleOffline() {
            this.isOnline = false;
            this.updateConnectionStatus();
            NotificationManager.show('Mode hors ligne activé', 'warning');
        },

        updateConnectionStatus() {
            const statusElement = document.getElementById('connection-status');
            if (statusElement) {
                statusElement.classList.toggle('d-none', this.isOnline);
            }
        },

        checkOfflineData() {
            const offlineData = localStorage.getItem(CONFIG.STORAGE_KEYS.OFFLINE_PROBLEMS);
            if (offlineData) {
                const problems = JSON.parse(offlineData);
                if (problems.length > 0) {
                    NotificationManager.show(`${problems.length} problème(s) en attente de synchronisation`, 'info');
                }
            }
        },

        exportToCSV() {
            const table = document.getElementById('problems-table');
            if (!table) return;

            const headers = [
                "N°", "Problème", "Causes", "Actions", "Sources",
                "Acteurs", "Ressources", "Délai"
            ];

            const rows = Array.from(table.getElementsByTagName('tr'));
            const csvContent = [
                headers.join(','),
                ...rows.map(row =>
                    Array.from(row.cells)
                    .slice(0, 8) // Exclure la colonne des actions
                    .map(cell => `"${cell.textContent.replace(/Hors ligne/g, '').trim().replace(/"/g, '""')}"`)
                    .join(',')
                )
            ].join('\n');

            const blob = new Blob([csvContent], {
                type: 'text/csv;charset=utf-8;'
            });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `problemes_prioritaires_${new Date().toISOString().slice(0,10)}.csv`;
            link.click();
            URL.revokeObjectURL(link.href);

            NotificationManager.show('Export CSV réussi', 'success');
        }
    };

    // Exposition des fonctions globales
    window.ProblemeManager = ProblemeManager;
    window.showForm = () => ProblemeManager.showForm();
    window.showTable = () => ProblemeManager.showTable();
    window.exportToCSV = () => ProblemeManager.exportToCSV();

    // Initialisation au chargement de la page
    document.addEventListener('DOMContentLoaded', () => {
        ProblemeManager.init();
    });
</script>



@endsection
