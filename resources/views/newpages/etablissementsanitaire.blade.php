@extends('layoutsapp.master')
@section('title', 'Outil de supervision')

@section('content')
<!-- Ajout des dépendances Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

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

    .card {
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
    }
</style>



<section class="mb-4">
    <!-- Section Table -->
    <div id="table-section">

        <div class="row mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">Liste des établissements sanitaires</h2>
                    <p class="text-muted mb-0">Aperçu de la vue des établissements sanitaires</p>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-success" onclick="exportToExcel()">
                        <i class="bi bi-file-excel me-2"></i>Exporter en Excel
                    </button>
                    <button type="button" class="btn btn-primary  ripple-surface" onclick="showForm()">
                    <i class="fas fa-plus-circle me-2"></i> Nouvel établissement
                    </button>
                </div>
            </div>
        </div>
        <div class="card">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg-light">
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleAllCheckboxes(this)">
                                    </div>
                                </th>
                                <th>N°</th>
                                <th>Direction Régionale</th>
                                <th>District Sanitaire</th>
                                <th>Établissement</th>
                                <th>Catégorie</th>
                                <th>Code</th>
                                <th>Période</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Responsable</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
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
                    <h2 class="mb-1" id="formTitle">Nouvel Etablissement</h2>
                    <p class="text-muted mb-0" id="formSubtitle">Ajouter un nouvel Etablissement</p>
                </div>
                <button class="btn btn-secondary" id="toggleListButton" onclick="showTable()">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </button>
            </div>
        </div>

        <div class="card shadow-2-strong">


            <div class="card-body p-4">
                <form id="supervisionForm">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="direction_regionale" id="direction_regionale" required>
                                <label class="form-label">Direction Régionale</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="district_sanitaire" id="district_sanitaire" required>
                                <label class="form-label">District Sanitaire</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="etablissement_sanitaire" id="etablissement_sanitaire" required>
                                <label class="form-label">Établissement Sanitaire</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label select-label">Catégorie de l'établissement</label>
                            <select class="select form-control" name="categorie_etablissement" id="categorie_etablissement" required>
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="CHR">CHR</option>
                                <option value="HÔPITAL GENERAL">HÔPITAL GENERAL</option>
                                <option value="CENTRE SANTÉ URBAIN">CENTRE SANTÉ URBAIN</option>
                                <option value="FSU">FSU</option>
                                <option value="FSU COM">FSU COM</option>
                                <option value="CENTRE SANTE RURAL">CENTRE SANTÉ RURAL</option>
                                <option value="DISPENSAIRE RURAL">DISPENSAIRE RURAL</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="code_etablissement" id="code_etablissement" required>
                                <label class="form-label">Code Établissement Sanitaire</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="periode" id="periode" required>
                                <label class="form-label">Période supervisée</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control datepicker" name="date_debut" id="date_debut" required>
                                <label class="form-label">Date/heure de début</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control datepicker" name="date_fin" id="date_fin" required>
                                <label class="form-label">Date/heure de fin</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="responsable" id="responsable" required>
                                <label class="form-label">Nom du Responsable</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-outline">
                                        <input type="tel" class="form-control" name="telephone" id="telephone" required>
                                        <label class="form-label">Téléphone</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-outline">
                                        <input type="email" class="form-control" name="email" id="email" required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary" onclick="showTable()">
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

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
    </div>
</section>

<script>
    // Points d'accès de l'API
    const API_ENDPOINTS = {
        GET_ETABLISSEMENTS: '/api/etablissements',
        SAVE_ETABLISSEMENT: '/api/etablissements/save'
    };

    // Clés de stockage local
    const STORAGE_KEYS = {
        ETABLISSEMENTS: 'cached_etablissements',
        PENDING_ETABLISSEMENTS: 'pending_etablissements'
    };

    // Fonctions de navigation
    function showForm() {
        document.getElementById('table-section').classList.add('d-none');
        document.getElementById('form-section').classList.remove('d-none');
        document.getElementById('supervisionForm').reset();
    }

    function showTable() {
        document.getElementById('form-section').classList.add('d-none');
        document.getElementById('table-section').classList.remove('d-none');
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

    // Gestionnaire des alertes
    class AlertManager {
        static showAlert(message, type) {
            const toastContainer = document.querySelector('.toast-container');
            if (!toastContainer) return;

            const toast = document.createElement('div');
            toast.className = `toast show align-items-center text-white bg-${type} border-0`;
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;

            toastContainer.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        static showSuccess(message) {
            this.showAlert(message, 'success');
        }
        static showError(message) {
            this.showAlert(message, 'danger');
        }
        static showWarning(message) {
            this.showAlert(message, 'warning');
        }
    }

    // Gestionnaire du cache
    class CacheManager {
        static set(key, data) {
            try {
                localStorage.setItem(key, JSON.stringify(data));
            } catch (error) {
                console.error(`Erreur lors de la mise en cache pour ${key}:`, error);
            }
        }

        static get(key) {
            try {
                const data = localStorage.getItem(key);
                return data ? JSON.parse(data) : null;
            } catch (error) {
                console.error(`Erreur lors de la récupération du cache pour ${key}:`, error);
                return null;
            }
        }

        static getPendingEtablissements() {
            return this.get(STORAGE_KEYS.PENDING_ETABLISSEMENTS) || [];
        }

        static addPendingEtablissement(etablissement) {
            const pending = this.getPendingEtablissements();
            pending.push(etablissement);
            this.set(STORAGE_KEYS.PENDING_ETABLISSEMENTS, pending);
        }

        static removePendingEtablissement(id) {
            const pending = this.getPendingEtablissements();
            const updated = pending.filter(item => item.id !== id);
            this.set(STORAGE_KEYS.PENDING_ETABLISSEMENTS, updated);
        }
    }

    // Gestionnaire des établissements
    class EtablissementManager {
        static currentPage = 1;
        static totalPages = 0;

        static formatDate(dateStr) {
            if (!dateStr) return '';
            try {
                const date = new Date(dateStr);
                return date.toLocaleString('fr-FR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            } catch (e) {
                return dateStr;
            }
        }

        static isCodeEtablissementUnique(code) {
            // Vérifier dans les données en cache
            const cachedEtablissements = CacheManager.get(STORAGE_KEYS.ETABLISSEMENTS) || [];
            const pendingEtablissements = CacheManager.getPendingEtablissements();

            // Vérifier dans toutes les données (cache + en attente)
            const allEtablissements = [...cachedEtablissements, ...pendingEtablissements];

            return !allEtablissements.some(etab =>
                etab.code_etablissement.toLowerCase() === code.toLowerCase()
            );
        }

        static async loadEtablissements(page = 1) {
            try {
                const tbody = document.getElementById('table-body');
                const paginationContainer = document.getElementById('pagination-container');
                if (!tbody || !paginationContainer) return;

                tbody.innerHTML = '';
                paginationContainer.innerHTML = '';

                let etablissements = [];
                const pendingEtablissements = CacheManager.getPendingEtablissements();

                if (navigator.onLine) {
                    try {
                        const response = await fetch(`${API_ENDPOINTS.GET_ETABLISSEMENTS}?page=${page}`);
                        const data = await response.json();
                        if (data.success) {
                            etablissements = data.data.data;
                            this.currentPage = data.data.current_page;
                            this.totalPages = data.data.last_page;

                            // Update cache with fetched data
                            CacheManager.set(STORAGE_KEYS.ETABLISSEMENTS, etablissements);

                            // Render pagination
                            this.renderPagination(data.data);
                        }
                    } catch (error) {
                        console.error('Erreur serveur:', error);
                        const cachedData = CacheManager.get(STORAGE_KEYS.ETABLISSEMENTS);
                        if (cachedData) {
                            etablissements = cachedData;
                            AlertManager.showWarning('Utilisation des données en cache');
                        }
                    }
                } else {
                    const cachedData = CacheManager.get(STORAGE_KEYS.ETABLISSEMENTS);
                    if (cachedData) {
                        etablissements = cachedData;
                    }
                }

                // Merge pending establishments
                const allEtablissements = [...etablissements, ...pendingEtablissements];

                // Display data
                allEtablissements.forEach((etablissement, index) => {
                    this.addRowToTable(etablissement, index, pendingEtablissements);
                });

                if (!navigator.onLine && pendingEtablissements.length > 0) {
                    AlertManager.showWarning(`${pendingEtablissements.length} établissement(s) en attente de synchronisation`);
                }
            } catch (error) {
                console.error('Erreur:', error);
                AlertManager.showError('Erreur lors du chargement des établissements');
            }
        }

        static renderPagination(paginationData) {
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
        }

        static addRowToTable(etablissement, index, pendingEtablissements) {
            const tbody = document.getElementById('table-body');
            if (!tbody || !etablissement) return;

            const row = document.createElement('tr');
            const isPending = pendingEtablissements?.some(p => p.id === etablissement.id);

            row.innerHTML = `
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" onchange="updateDeleteButton()">
                </div>
            </td>
            <td>${index + 1}</td>
            <td>${etablissement.direction_regionale}</td>
            <td>${etablissement.district_sanitaire}</td>
            <td>${etablissement.etablissement_sanitaire}</td>
            <td>${etablissement.categorie_etablissement}</td>
            <td>${etablissement.code_etablissement}</td>
            <td>${etablissement.periode}</td>
            <td>${this.formatDate(etablissement.date_debut)}</td>
            <td>${this.formatDate(etablissement.date_fin)}</td>
            <td>${etablissement.responsable}</td>
            <td>${etablissement.telephone}</td>
            <td>${etablissement.email}</td>
            <td>
                ${isPending ? '<span class="badge bg-warning me-2">En attente de sync</span>' : ''}
                <button class="btn btn-danger btn-sm" onclick="EtablissementManager.deleteRow(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;

            tbody.appendChild(row);
        }

        static async handleSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            const codeEtablissement = formData.get('code_etablissement');

            // Vérifier si le code existe déjà
            if (!this.isCodeEtablissementUnique(codeEtablissement)) {
                AlertManager.showError('Ce code d\'établissement existe déjà');
                return;
            }

            const etablissement = {
                direction_regionale: formData.get('direction_regionale'),
                district_sanitaire: formData.get('district_sanitaire'),
                etablissement_sanitaire: formData.get('etablissement_sanitaire'),
                categorie_etablissement: formData.get('categorie_etablissement'),
                code_etablissement: codeEtablissement,
                periode: formData.get('periode'),
                date_debut: formData.get('date_debut'),
                date_fin: formData.get('date_fin'),
                responsable: formData.get('responsable'),
                telephone: formData.get('telephone'),
                email: formData.get('email')
            };

            try {
                if (navigator.onLine) {
                    const response = await fetch(API_ENDPOINTS.SAVE_ETABLISSEMENT, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(etablissement)
                    });

                    const responseData = await response.json();

                    if (!response.ok) {
                        if (responseData.errors) {
                            const errorMessages = Object.values(responseData.errors).flat().join('\n');
                            throw new Error(errorMessages);
                        }
                        throw new Error(responseData.message || 'Erreur lors de l\'enregistrement');
                    }

                    AlertManager.showSuccess('Établissement enregistré avec succès');
                } else {
                    etablissement.id = Date.now();
                    etablissement.timestamp = new Date().toISOString();
                    CacheManager.addPendingEtablissement(etablissement);
                    AlertManager.showSuccess('Établissement sauvegardé localement - En attente de synchronisation');
                }

                form.reset();
                showTable();
                await this.loadEtablissements();

            } catch (error) {
                console.error('Erreur:', error);
                AlertManager.showError(error.message || 'Erreur lors de l\'enregistrement');
            }
        }

        static async syncPendingEtablissements() {
            const pending = CacheManager.getPendingEtablissements();
            if (!pending.length) return;

            let successfulSyncs = [];
            let errors = [];

            for (const etablissement of pending) {
                try {
                    // Enlever l'ID temporaire et le timestamp pour l'enregistrement en base de données
                    const {
                        id,
                        timestamp,
                        ...etablissementData
                    } = etablissement;

                    const response = await fetch(API_ENDPOINTS.SAVE_ETABLISSEMENT, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(etablissementData)
                    });

                    const responseData = await response.json();

                    if (response.ok && responseData.success) {
                        successfulSyncs.push(etablissement.id);
                    } else {
                        errors.push({
                            id: etablissement.id,
                            error: responseData.message || 'Erreur serveur'
                        });
                    }
                } catch (error) {
                    console.error('Erreur de synchronisation:', error);
                    errors.push({
                        id: etablissement.id,
                        error: error.message
                    });
                }
            }

            if (successfulSyncs.length > 0) {
                let remainingPending = CacheManager.getPendingEtablissements().filter(
                    etablissement => !successfulSyncs.includes(etablissement.id)
                );
                CacheManager.set(STORAGE_KEYS.PENDING_ETABLISSEMENTS, remainingPending);

                try {
                    const response = await fetch(API_ENDPOINTS.GET_ETABLISSEMENTS);
                    const data = await response.json();
                    if (data.success) {
                        CacheManager.set(STORAGE_KEYS.ETABLISSEMENTS, data.data.data);
                    }
                } catch (error) {
                    console.error('Erreur lors du rechargement des données:', error);
                }

                AlertManager.showSuccess(
                    successfulSyncs.length === pending.length ?
                    'Tous les établissements ont été synchronisés' :
                    `${successfulSyncs.length} établissement(s) synchronisé(s)`
                );
            }

            if (errors.length > 0) {
                AlertManager.showWarning(`${errors.length} établissement(s) n'ont pas pu être synchronisés`);
                console.error('Erreurs de synchronisation:', errors);
            }

            await this.loadEtablissements();
        }

        static deleteRow(button) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet établissement ?')) return;

            const row = button.closest('tr');
            row.remove();
            updateDeleteButton();
        }
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            // Initialisation des composants MDB
            document.querySelectorAll('.form-outline').forEach((formOutline) => {
                new mdb.Input(formOutline).init();
            });

            // Initialisation de Flatpickr
            flatpickr(".datepicker", {
                locale: "fr",
                enableTime: true,
                dateFormat: "Y-m-d H:i:s",
                time_24hr: true,
                allowInput: true,
                minuteIncrement: 1,
            });

            // Bind des événements
            const form = document.getElementById('supervisionForm');
            if (form) {
                form.removeAttribute('onsubmit');
                form.addEventListener('submit', (event) => EtablissementManager.handleSubmit(event));
            }

            // Chargement initial des données
            await EtablissementManager.loadEtablissements();

            // Gestion de la connexion
            window.addEventListener('online', async () => {
                AlertManager.showSuccess('Connexion rétablie');
                try {
                    const pending = CacheManager.getPendingEtablissements();
                    if (pending.length > 0) {
                        await EtablissementManager.syncPendingEtablissements();
                    }
                    await EtablissementManager.loadEtablissements();
                } catch (error) {
                    console.error('Erreur lors de la synchronisation:', error);
                    AlertManager.showError('Erreur lors de la synchronisation des données');
                }
            });

            window.addEventListener('offline', () => {
                AlertManager.showWarning('Mode hors ligne activé - Les données seront synchronisées automatiquement');
            });

        } catch (error) {
            console.error('Erreur lors de l\'initialisation:', error);
            AlertManager.showError('Erreur lors du chargement initial des données');
        }
    });
</script>


@endsection
