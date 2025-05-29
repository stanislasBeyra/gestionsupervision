@extends('layoutsapp.master')
@section('title', 'Identification des superviseurs')

@section('content')
<style>
    .card {
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
    }
</style>

<div class="container-fluid mt-4">
    <!-- Section Tableau -->
    <div id="table-section" class="fade-in">
        <div class="row mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">Liste des superviseurs</h2>
                    <p class="text-muted mb-0">Aperçu de la vue des superviseurs</p>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-success" onclick="exportToExcel()">
                        <i class="bi bi-file-excel me-2"></i>Exporter en Excel
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showForm()">
                        <i class="fas fa-plus-circle me-2"></i> Ajouter un superviseur
                    </button>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" id="search-supervises" class="form-control"
                        placeholder="Rechercher un superviseur...">
                    <span class="input-group-text bg-primary">
                        <i class="fas fa-search text-white"></i>
                    </span>
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
                                <th scope="col">Noms/prénoms</th>
                                <th scope="col">Fonction</th>
                                <th scope="col">Service</th>
                                <th scope="col">Profession</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="supervises-table">
                            <!-- Les données seront ajoutées ici -->
                        </tbody>
                    </table>
                </div>

                <div id="empty-message" class="text-center p-4 d-none">
                    <i class="fas fa-users fa-3x mb-3 text-muted"></i>
                    <p class="text-muted">Aucun supervisé enregistré</p>
                </div>
                <div id="pagination-container"></div>
            </div>
        </div>
    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="d-none">

        <div class="row mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" id="formTitle">Nouveau superviseur</h2>
                    <p class="text-muted mb-0" id="formSubtitle">Ajouter un nouveau superviseur</p>
                </div>
                <button class="btn btn-secondary" id="toggleListButton" onclick="showTable()">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </button>
            </div>
        </div>

        <div class="card shadow-sm slide-up">


            <div class="card-body">
                <form id="superviseForm" onsubmit="handleSubmit(event)">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Noms/prénoms</label>
                            <input type="text" class="form-control" name="nom_prenom" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fonction</label>
                            <input type="text" class="form-control" name="fonction" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Service</label>
                            <input type="text" class="form-control" name="service" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Profession</label>
                            <input type="text" class="form-control" name="profession" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" onclick="showTable()">
                            <i class="bi bi-x-circle"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * Configuration principale de l'application
     */
    const CONFIG = {
        ENDPOINTS: {
            GET_SUPERVISES: '/api/superviseurs',
            SAVE_SUPERVISE: '/api/superviseurs/save'
        },
        STORAGE_KEYS: {
            OFFLINE_SUPERVISES: 'offlineSupervises',
            FORM_STATE: 'superviseFormState',
            LAST_SYNC: 'lastSuperviseSync'
        },
        TOAST_DURATION: 3000
    };

    /**
     * Gestionnaire de notifications
     */
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

            setTimeout(() => toastElement.remove(), CONFIG.TOAST_DURATION);
        }
    };

    /**
     * Gestionnaire de stockage local
     */
    const StorageManager = {
        get(key) {
            try {
                const item = localStorage.getItem(CONFIG.STORAGE_KEYS[key]);
                return item ? JSON.parse(item) : null;
            } catch (error) {
                console.error(`Erreur de lecture ${key}:`, error);
                return null;
            }
        },

        set(key, value) {
            try {
                localStorage.setItem(CONFIG.STORAGE_KEYS[key], JSON.stringify(value));
                return true;
            } catch (error) {
                console.error(`Erreur d'écriture ${key}:`, error);
                return false;
            }
        },

        remove(key) {
            try {
                localStorage.removeItem(CONFIG.STORAGE_KEYS[key]);
                return true;
            } catch (error) {
                console.error(`Erreur de suppression ${key}:`, error);
                return false;
            }
        }
    };

    /**
     * Gestionnaire de connexion
     */
    const ConnectionManager = {
        isOnline: navigator.onLine,

        init() {
            window.addEventListener('online', this.handleOnline.bind(this));
            window.addEventListener('offline', this.handleOffline.bind(this));
            this.updateStatus();
        },

        async handleOnline() {
            this.isOnline = true;
            this.updateStatus();
            NotificationManager.show('Connexion rétablie', 'success');
            await SuperviseManager.syncOfflineData();
            await SuperviseManager.loadSupervises();
        },

        handleOffline() {
            this.isOnline = false;
            this.updateStatus();
            NotificationManager.show('Mode hors ligne activé', 'warning');
            SuperviseManager.loadOfflineData();
        },

        updateStatus() {
            const statusElement = document.getElementById('connection-status');
            if (statusElement) {
                statusElement.classList.toggle('d-none', this.isOnline);
            }
        }
    };

    /**
     * Gestionnaire principal des supervisés
     */
    const SuperviseManager = {
        superviseCount: 0,
        editingRow: null,
        searchTerm: '',

        async init() {
            try {
                await this.loadSupervises();
                this.initFormValidation();
                this.initSearchHandler();
            } catch (error) {
                console.error('Erreur d\'initialisation:', error);
                NotificationManager.show('Erreur d\'initialisation', 'danger');
            }
        },

        async loadSupervises(page = 1, search = '') {
            try {
                if (!ConnectionManager.isOnline) {
                    this.loadOfflineData();
                    return;
                }

                const url = new URL(CONFIG.ENDPOINTS.GET_SUPERVISES, window.location.origin);
                url.searchParams.append('page', page);
                if (search) {
                    url.searchParams.append('search', search);
                }

                const response = await fetch(url);
                if (!response.ok) throw new Error('Erreur de chargement');

                const data = await response.json();
                if (!data.success) throw new Error(data.message);

                this.searchTerm = search;
                this.displaySupervises(data.superviseur.data);
                this.renderPagination(data.superviseur);

            } catch (error) {
                console.error('Erreur de chargement:', error);
                NotificationManager.show('Erreur de chargement', 'danger');
                this.loadOfflineData();
            }
        },

        async saveSupervise(formData) {
            if (!ConnectionManager.isOnline) {
                return this.saveLocally(formData);
            }

            try {
                // Conversion des données pour l'API
                const apiData = {
                    firstname: formData.nom_prenom,
                    fonction: formData.fonction,
                    service: formData.service,
                    profession: formData.profession,
                    phone: formData.phone,
                    email: formData.email
                };

                const response = await fetch(CONFIG.ENDPOINTS.SAVE_SUPERVISE, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(apiData)
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Erreur de sauvegarde');
                }

                return {
                    success: true,
                    data: {
                        ...data.data,
                        nom_prenom: data.data.firstname
                    }
                };

            } catch (error) {
                console.error('Erreur de sauvegarde:', error);
                if (!ConnectionManager.isOnline) {
                    return this.saveLocally(formData);
                }
                throw error;
            }
        },

        saveLocally(formData) {
            try {
                const offlineSupervises = StorageManager.get('OFFLINE_SUPERVISES') || [];
                const supervise = {
                    firstname: formData.nom_prenom,
                    fonction: formData.fonction,
                    service: formData.service,
                    profession: formData.profession,
                    phone: formData.phone,
                    email: formData.email,
                    id: Date.now(),
                    offlineCreated: true,
                    timestamp: new Date().toISOString()
                };

                offlineSupervises.push(supervise);
                StorageManager.set('OFFLINE_SUPERVISES', offlineSupervises);

                NotificationManager.show('Données sauvegardées localement', 'info');
                return {
                    success: true,
                    data: {
                        ...supervise,
                        nom_prenom: supervise.firstname
                    },
                    offline: true
                };
            } catch (error) {
                console.error('Erreur de sauvegarde locale:', error);
                NotificationManager.show('Erreur de sauvegarde locale', 'danger');
                return {
                    success: false,
                    error
                };
            }
        },

        loadOfflineData() {
            const offlineSupervises = StorageManager.get('OFFLINE_SUPERVISES') || [];
            this.displaySupervises(offlineSupervises, true);
        },

        async syncOfflineData() {
            const offlineSupervises = StorageManager.get('OFFLINE_SUPERVISES') || [];
            if (offlineSupervises.length === 0) return;

            let syncedCount = 0;
            const syncErrors = [];

            for (const supervise of offlineSupervises) {
                try {
                    const {
                        offlineCreated,
                        timestamp,
                        id,
                        ...superviseData
                    } = supervise;
                    await this.saveSupervise({
                        nom_prenom: superviseData.firstname,
                        ...superviseData
                    });
                    syncedCount++;
                } catch (error) {
                    syncErrors.push(supervise);
                    console.error('Erreur de synchronisation:', error);
                }
            }

            if (syncedCount > 0) {
                StorageManager.set('OFFLINE_SUPERVISES', syncErrors);
                NotificationManager.show(`${syncedCount} supervisé(s) synchronisé(s)`, 'success');
                await this.loadSupervises();
            }
        },

        displaySupervises(supervises, isOffline = false) {
            const tbody = document.getElementById('supervises-table');
            if (!tbody) return;

            tbody.innerHTML = '';

            supervises.forEach((supervise, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${index + 1}</td>
            <td>${supervise.firstname || ''}${isOffline ? ' <span class="badge badge-warning">Hors ligne</span>' : ''}</td>
            <td>${supervise.fonction || ''}</td>
            <td>${supervise.service || ''}</td>
            <td>${supervise.profession || ''}</td>
            <td>${supervise.phone || ''}</td>
            <td>${supervise.email || ''}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-warning" onclick="SuperviseManager.editSupervise(this)">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger" onclick="SuperviseManager.deleteSupervise(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;

                if (isOffline) {
                    row.dataset.offlineId = supervise.id;
                } else {
                    row.dataset.id = supervise.id;
                }

                tbody.appendChild(row);
            });

            this.checkEmptyTable();
        },

        async handleSubmit(event) {
            event.preventDefault();
            const form = event.target;

            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Traitement...';
            }

            try {
                const formData = Object.fromEntries(new FormData(form));

                if (this.editingRow) {
                    const id = this.editingRow.dataset.id;
                    if (id) formData.id = id;
                }

                const result = await this.saveSupervise(formData);

                if (result.success || result.offline) {
                    NotificationManager.show(
                        result.offline ? 'Sauvegardé en mode hors ligne' : 'Supervisé enregistré avec succès',
                        result.offline ? 'warning' : 'success'
                    );

                    this.showTable();
                    form.reset();
                    await this.loadSupervises();
                }

            } catch (error) {
                console.error('Erreur de soumission:', error);
                NotificationManager.show(error.message || 'Erreur lors de l\'enregistrement', 'danger');
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>Enregistrer';
                }
                form.classList.remove('was-validated');
            }
        },

        async deleteSupervise(button) {
            const confirmDelete = confirm('Êtes-vous sûr de vouloir supprimer ce supervisé ?');

            if (confirmDelete) {
                try {
                    const row = button.closest('tr');

                    if (row.dataset.offlineId) {
                        const offlineSupervises = StorageManager.get('OFFLINE_SUPERVISES') || [];
                        const filtered = offlineSupervises.filter(s => s.id.toString() !== row.dataset.offlineId);
                        StorageManager.set('OFFLINE_SUPERVISES', filtered);
                    }

                    row.remove();
                    this.updateNumbers();
                    this.checkEmptyTable();
                    NotificationManager.show('Supervisé supprimé avec succès', 'success');
                } catch (error) {
                    console.error('Erreur lors de la suppression:', error);
                    NotificationManager.show('Erreur lors de la suppression', 'danger');
                }
            }
        },

        showForm() {
            document.getElementById('form-section')?.classList.remove('d-none');
            document.getElementById('table-section')?.classList.add('d-none');
            document.getElementById('formTitle').textContent = this.editingRow ? 'Modifier un superviseur' : 'Nouveau superviseur';
        },

        showTable() {
            document.getElementById('form-section')?.classList.add('d-none');
            document.getElementById('table-section')?.classList.remove('d-none');
            document.getElementById('superviseForm')?.reset();
            this.editingRow = null;
        },

        editSupervise(button) {
            const row = button.closest('tr');
            this.editingRow = row;

            const form = document.getElementById('superviseForm');
            if (!form) return;

            const cells = row.cells;
            form.elements['nom_prenom'].value = cells[1].textContent.replace('Hors ligne', '').trim();
            form.elements['fonction'].value = cells[2].textContent.trim();
            form.elements['phone'].value = cells[3].textContent.trim();
            form.elements['email'].value = cells[4].textContent.trim();
            form.elements['service'].value = cells[5].textContent.trim();
            form.elements['profession'].value = cells[6].textContent.trim();

            if (row.dataset.id) {
                form.dataset.editId = row.dataset.id;
            } else {
                delete form.dataset.editId;
            }

            this.showForm();
        },

        updateNumbers() {
            const rows = document.querySelectorAll('#supervises-table tr');
            rows.forEach((row, index) => {
                row.cells[0].textContent = index + 1;
            });
            this.superviseCount = rows.length;
        },

        checkEmptyTable() {
            const tableBody = document.getElementById('supervises-table');
            const emptyMessage = document.getElementById('empty-message');
            const searchInput = document.getElementById('search-supervises');

            if (tableBody && emptyMessage) {
                const hasRows = tableBody.querySelectorAll('tr').length > 0;
                emptyMessage.classList.toggle('d-none', hasRows);

                if (!hasRows && searchInput && searchInput.value) {
                    emptyMessage.innerHTML = `
                <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                <p class="text-muted">Aucun résultat trouvé pour "${searchInput.value}"</p>
            `;
                } else {
                    emptyMessage.innerHTML = `
                <i class="fas fa-users fa-3x mb-3 text-muted"></i>
<p class="text-muted">Aucun supervisé enregistré</p>
`;
                }
            }
        },

        initFormValidation() {
            const form = document.getElementById('superviseForm');
            if (!form) return;

            // Validation du téléphone
            const phoneInput = form.elements['phone'];
            if (phoneInput) {
                phoneInput.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9+\s-]/g, '');
                    const isValid = /^[+]?[\d\s-]{9,}$/.test(this.value);
                    this.classList.toggle('is-invalid', !isValid && this.value !== '');
                });
            }

            // Validation de l'email
            const emailInput = form.elements['email'];
            if (emailInput) {
                emailInput.addEventListener('input', function() {
                    const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value);
                    this.classList.toggle('is-invalid', !isValid && this.value !== '');
                });
            }

            // Validation des champs obligatoires
            const requiredInputs = form.querySelectorAll('[required]');
            requiredInputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.classList.toggle('is-invalid', !this.value.trim());
                });
            });
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
                <a class="page-link" href="#" onclick="EtablissementManager.loadEtablissements(${currentPage - 1})" ${currentPage === 1 ? 'tabindex="-1" aria-disabled="true"' : ''}>
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
                        <a class="page-link" href="#" onclick="EtablissementManager.loadEtablissements(${pageNum})">
                            ${link.label}
                        </a>
                    </li>
                `;
                }
            });

            // Bouton Next
            paginationHTML += `
            <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="EtablissementManager.loadEtablissements(${currentPage + 1})" ${currentPage === lastPage ? 'tabindex="-1" aria-disabled="true"' : ''}>
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

        initSearchHandler() {
            const searchInput = document.getElementById('search-supervises');
            if (!searchInput) return;

            let debounceTimeout;
            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    const searchTerm = searchInput.value.trim();
                    this.loadSupervises(1, searchTerm);
                }, 300);
            });
        },

        async exportToExcel() {
            try {
                const table = document.getElementById('supervises-table');
                if (!table) return;

                const rows = Array.from(table.getElementsByTagName('tr'));
                let csvContent = "N°,Noms/prénoms,Fonction/Service,Phone,E-mail\n";

                rows.forEach(row => {
                    if (!row.classList.contains('d-none')) {
                        const columns = Array.from(row.cells)
                            .slice(0, -1) // Exclure la dernière colonne (actions)
                            .map(cell => cell.textContent.replace(/Hors ligne/g, '').trim())
                            .map(text => `"${text.replace(/"/g, '""')}"`)
                            .join(',');
                        csvContent += columns + '\n';
                    }
                });

                const blob = new Blob([csvContent], {
                    type: 'text/csv;charset=utf-8;'
                });
                const link = document.createElement('a');
                const timestamp = new Date().toISOString().slice(0, 19).replace(/[:-]/g, '');
                link.href = URL.createObjectURL(blob);
                link.setAttribute('download', `supervisés_${timestamp}.csv`);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                NotificationManager.show('Export réussi', 'success');
            } catch (error) {
                console.error('Erreur lors de l\'export:', error);
                NotificationManager.show('Erreur lors de l\'export', 'danger');
            }
        }
    };
    // Initialisation de l'application
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            // Initialiser les gestionnaires
            NotificationManager.init();
            await SuperviseManager.init();
            ConnectionManager.init();
            // Vérifier s'il y a des données en attente de synchronisation
            if (ConnectionManager.isOnline) {
                await SuperviseManager.syncOfflineData();
            }

            // Restaurer l'état du formulaire si nécessaire
            const savedFormState = StorageManager.get('FORM_STATE');
            if (savedFormState) {
                const form = document.getElementById('superviseForm');
                if (form) {
                    Object.entries(savedFormState).forEach(([key, value]) => {
                        const input = form.elements[key];
                        if (input) input.value = value;
                    });
                }
            }

        } catch (error) {
            console.error('Erreur d\'initialisation:', error);
            NotificationManager.show('Erreur lors de l\'initialisation', 'danger');
        }
    });
    // Exportation des fonctions globales
    window.showForm = () => SuperviseManager.showForm();
    window.showTable = () => SuperviseManager.showTable();
    window.handleSubmit = (event) => SuperviseManager.handleSubmit(event);
    window.exportToExcel = () => SuperviseManager.exportToExcel();
    window.SuperviseManager = SuperviseManager; // Pour l'accès aux fonctions depuis les événements onclick
</script>
<!--
<script>
    let superviseCount = 0;
    let editingRow = null;

    function showForm() {
        document.getElementById('form-section').classList.remove('d-none');
        document.getElementById('table-section').classList.add('d-none');
    }

    function showTable() {
        document.getElementById('form-section').classList.add('d-none');
        document.getElementById('table-section').classList.remove('d-none');
        document.getElementById('superviseForm').reset();
        editingRow = null;
    }

    function handleSubmit(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        if (editingRow) {
            // Mode édition
            updateRow(editingRow, formData);
        } else {
            // Mode ajout
            superviseCount++;
            const tbody = document.getElementById('supervises-table');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
            <td class="text-center">${superviseCount}</td>
            <td>${formData.get('nom_prenom')}</td>
            <td>${formData.get('fonction')}</td>
            <td>${formData.get('phone')}</td>
            <td>${formData.get('email')}</td>
            <td>
                <button class="btn btn-sm btn-warning me-1" onclick="editSupervise(this)">
                    <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteSupervise(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;

            tbody.appendChild(newRow);
        }

        showTable();
    }

    function updateRow(row, formData) {
        row.cells[1].textContent = formData.get('nom_prenom');
        row.cells[2].textContent = formData.get('fonction');
        row.cells[3].textContent = formData.get('phone');
        row.cells[4].textContent = formData.get('email');
    }

    function editSupervise(button) {
        const row = button.closest('tr');
        editingRow = row;

        const form = document.getElementById('superviseForm');
        form.elements['nom_prenom'].value = row.cells[1].textContent;
        form.elements['fonction'].value = row.cells[2].textContent;
        form.elements['phone'].value = row.cells[3].textContent;
        form.elements['email'].value = row.cells[4].textContent;

        showForm();
    }

    function deleteSupervise(button) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce supervisé ?')) {
            const row = button.closest('tr');
            row.remove();
            updateNumbers();
        }
    }

    function updateNumbers() {
        const rows = document.querySelectorAll('#supervises-table tr');
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
        superviseCount = rows.length;
    }
</script> -->
@endsection
