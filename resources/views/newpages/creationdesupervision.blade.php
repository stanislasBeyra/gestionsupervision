@extends('layoutsapp.master')
@section('title', 'Supervision')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #2563eb 0%, #5170a2 100%);
        --secondary-gradient: linear-gradient(135deg, #64748b 0%, #94a3b8 100%);
        --success-gradient: linear-gradient(135deg, #059669 0%, #10b981 100%);
        --danger-gradient: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    }

    .card {
        border: none;
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
    }

    .card-header {
        border-bottom: none;
        padding: 2rem;
        background: transparent;
    }

    .btn-custom {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-primary {
        background: var(--primary-gradient);
        border: none;
    }

    .btn-success {
        background: var(--success-gradient);
        border: none;
    }

    .btn-danger {
        background: var(--danger-gradient);
        border: none;
    }

    .etablissement-radio {
        display: none;
    }

    .hidden {
        display: none;
    }

    .etablissement-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.2rem;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 50%;
        position: relative;
        overflow: hidden;
        background: white;
    }

    .etablissement-label:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .etablissement-label:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .etablissement-radio:checked+.etablissement-label {
        border-color: #3b82f6;
        background: var(--primary-gradient);
        color: #fff;
    }

    .etablissement-radio:checked+.etablissement-label:before {
        opacity: 1;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .form-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.75rem;
    }



    .toast {
        border-radius: 12px;
        backdrop-filter: blur(10px);
    }

    .disabled-overlay {
        position: relative;
        pointer-events: none;
        opacity: 0.7;
    }

    .disabled-overlay::after {
        content: "Veuillez d'abord sélectionner un établissement";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #64748b;
        backdrop-filter: blur(4px);
        border-radius: 16px;
        z-index: 10;
    }

    .etablissement-section {
        margin-bottom: 2rem;
        padding: 2rem;

    }

    /* Animations */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: slideIn 0.5s ease-out forwards;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card-header {
            padding: 1.5rem;
        }

        .etablissement-label {
            padding: 1rem;
        }

        .btn-custom {
            padding: 0.5rem 1rem;
        }
    }
</style>
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
    <div id="table-section" class="fade-in">



        <div class="row mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">Liste des Supervisions</h2>
                    <p class="text-muted mb-0">Aperçu de la vue des Supervisions</p>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-success" onclick="exportToExcel()">
                        <i class="bi bi-file-excel me-2"></i>Exporter en Excel
                    </button>

                    <button type="button" class="btn btn-primary" id="toggleFormButton" onclick="showForm()">
                    <i class="fas fa-plus-circle me-2"></i>Nouvelle Suppervision
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
                                <th>
                                    <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)">
                                </th>
                                <th scope="col">#ID</th>
                                <th scope="col">Date d'ajout</th>
                                <th scope="col">Établissement</th>
                                <th scope="col">Domaine</th>
                                <th scope="col">Contenu</th>
                                <th scope="col">Question PA</th>
                                <th scope="col">Méthode</th>
                                <th scope="col">Réponse</th>
                                <th scope="col">Note Obtenue</th>
                                <th scope="col">Commentaires</th>
                                <th scope="col">Actions</th>
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
    <div id="form-section" class="hidden">

        <div class="row mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" id="formTitle">Nouvelle Supervision</h2>
                    <p class="text-muted mb-0" id="formSubtitle">Ajouter un nouvelle Supervision</p>
                </div>
                <button class="btn btn-secondary" id="toggleListButton" onclick="showTable()">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </button>
            </div>
        </div>

        <div class="card">

            <div class="card-body">
                <form id="data-form" onsubmit="handleSubmit(event)">
                    <!-- Section Établissement -->
                    <div class="etablissement-section">
                        <h5 class="mb-4 fs-4">Sélection de l'établissement</h5>
                        <div class="row g-3">
                            <div class="col-md-2">
                                <input type="radio" name="etablissement" id="etabHGMTN" value="Hotital General MTN" class="etablissement-radio" data-type="1" onchange="handleEtablissementChange()">
                                <label for="etabHGMTN" class="etablissement-label">
                                    <span class="fw-bold">Hôpital Général MTN</span>
                                </label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="etablissement" id="etabECD" value="ECD" class="etablissement-radio" data-type="2" onchange="handleEtablissementChange()">
                                <label for="etabECD" class="etablissement-label">
                                    <span class="fw-bold">ECD</span>
                                </label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="etablissement" id="etabCHR" value="CHR" class="etablissement-radio" data-type="3" onchange="handleEtablissementChange()">
                                <label for="etabCHR" class="etablissement-label">
                                    <span class="fw-bold">CHR</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" name="etablissement" id="etabESPC" value="ESPC" class="etablissement-radio" data-type="4" onchange="handleEtablissementChange()">
                                <label for="etabESPC" class="etablissement-label">
                                    <span class="fw-bold">ESPC</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" name="etablissement" id="etabHG" value="Hotipal General" class="etablissement-radio" data-type="5" onchange="handleEtablissementChange()">
                                <label for="etabHG" class="etablissement-label">
                                    <span class="fw-bold">Hôpital Général</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Autres champs du formulaire -->
                    <div id="form-fields" class="disabled-overlay">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Domaine</label>
                                <select id="domaine" name="domaine" class="form-select" required disabled>
                                    <option value="">Sélectionnez un domaine</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contenu</label>
                                <select id="contenu" name="contenu" class="form-select" required disabled>
                                    <option value="">Sélectionnez un contenu</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Question</label>
                                <select id="question" name="question" class="form-select" required disabled>
                                    <option value="">Sélectionnez une question</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Méthode</label>
                                <select id="method" name="method" class="form-select" required disabled>
                                    <option value="">Sélectionnez une méthode</option>
                                </select>
                            </div>



                            <div class="col-md-6 mb-3">
                                <label class="form-label">Note Obtenue</label>
                                <select id="note" name="note" class="form-select" required disabled>
                                    <option value="">Sélectionnez une note</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">type</label>
                                <select id="type" name="note" class="form-select" required disabled>
                                <option value="">Sélectionnez une note</option>
                                    <option value="1">Element d'environnement</option>
                                    <option value="2">Element de compétance</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Réponse Constat</label>
                                <input type="text" id="reponse" name="reponse"  class="form-control" required disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Commentaires</label>
                                <textarea id="commentaire" name="commentaire" class="form-control" rows="3" required disabled></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" onclick="showTable()">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
    </div>
</section>


<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script>
    // Points d'accès de l'API
    const API_ENDPOINTS = {
        DOMAINES: '/api/domaine',
        CONTENUS: '/api/contenu',
        QUESTIONS: '/api/allquestion',
        METHODES: '/api/methodes',
        NOTES: '/api/note',
        SUPERVISIONS: '/api/supervision',
        SAVESUPERVISONS: '/api/supervision/save'
    };

    // Clés de stockage local
    const STORAGE_KEYS = {
        SUPERVISIONS: 'offline_supervisions',
        PENDING_SUPERVISIONS: 'pending_supervisions',
        DOMAINES: 'cached_domaines',
        CONTENUS: 'cached_contenus',
        QUESTIONS: 'cached_questions',
        METHODES: 'cached_methodes',
        NOTES: 'cached_notes',
        LAST_SYNC: 'last_sync_timestamp'
    };

    // Types d'établissements
    const ETABLISSEMENT_TYPES = {
        'Hotital General MTN': 1,
        'ECD': 2,
        'CHR': 3,
        'ESPC': 4,
        'Hotipal General': 5
    };

    // Cache global pour les questions
    let cachedQuestions = [];

    function formatDate(date) {
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
        static set(key, data, expirationInHours = 24) {
            try {
                const cacheData = {
                    data: data,
                    timestamp: new Date().getTime(),
                    expiration: new Date().getTime() + (expirationInHours * 60 * 60 * 1000)
                };
                localStorage.setItem(key, JSON.stringify(cacheData));
            } catch (error) {
                console.error(`Erreur lors de la mise en cache pour ${key}:`, error);
                this.clearExpiredCache();
            }
        }

        static get(key) {
            try {
                const cached = localStorage.getItem(key);
                if (!cached) return null;

                const parsedCache = JSON.parse(cached);
                if (new Date().getTime() > parsedCache.expiration) {
                    localStorage.removeItem(key);
                    return null;
                }

                return parsedCache.data;
            } catch (error) {
                console.error(`Erreur lors de la récupération du cache pour ${key}:`, error);
                return null;
            }
        }

        static getPendingSupervisions() {
            return this.get(STORAGE_KEYS.PENDING_SUPERVISIONS) || [];
        }

        static addPendingSupervision(supervision) {
            const pending = this.getPendingSupervisions();
            pending.push(supervision);
            this.set(STORAGE_KEYS.PENDING_SUPERVISIONS, pending);
        }

        static clearPendingSupervisions() {
            localStorage.removeItem(STORAGE_KEYS.PENDING_SUPERVISIONS);
        }

        static clearExpiredCache() {
            Object.values(STORAGE_KEYS).forEach(key => {
                try {
                    const cached = localStorage.getItem(key);
                    if (cached) {
                        const parsedCache = JSON.parse(cached);
                        if (new Date().getTime() > parsedCache.expiration) {
                            localStorage.removeItem(key);
                        }
                    }
                } catch (error) {
                    localStorage.removeItem(key);
                }
            });
        }
    }

    // Gestionnaire des données
    class DataManager {
        static async fetchData(endpoint) {
            try {
                const response = await fetch(endpoint);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return await response.json();
            } catch (error) {
                console.error(`Erreur lors de la récupération des données depuis ${endpoint}:`, error);
                throw error;
            }
        }

        static async loadSelectData(endpoint, selectId, defaultText = "Sélectionnez une option", etablissementType = null) {
            try {
                const select = document.getElementById(selectId);
                if (!select) throw new Error(`Élément select avec l'ID ${selectId} non trouvé`);

                const response = await this.fetchData(endpoint);
                select.innerHTML = `<option value="">${defaultText}</option>`;

                let items = [];

                switch (selectId) {
                    case 'domaine':
                        items = response.domaine || [];
                        items.forEach(item => {
                            select.innerHTML += `<option value="${item.id}">${item.name_domaine}</option>`;
                        });
                        break;

                    case 'contenu':
                        items = response.contenu || [];
                        items.forEach(item => {
                            select.innerHTML += `<option value="${item.id}">${item.name_contenu}</option>`;
                        });
                        break;

                    case 'question':
                        items = response.questions || [];
                        cachedQuestions = items;
                        if (etablissementType) {
                            items = items.filter(item => item.type === etablissementType);
                        }
                        items.forEach(item => {
                            select.innerHTML += `<option value="${item.id}">${item.name_question}</option>`;
                        });
                        break;

                    case 'method':
                        items = response.data || [];
                        items.forEach(item => {
                            select.innerHTML += `<option value="${item.id}">${item.methode_name}</option>`;
                        });
                        break;

                    case 'note':
                        items = response.data || [];
                        items.forEach(item => {
                            select.innerHTML += `<option value="${item.id}">${item.note_name}</option>`;
                        });
                        break;

                    default:
                        console.warn(`Type de select non géré: ${selectId}`);
                }
            } catch (error) {
                AlertManager.showError(`Erreur lors du chargement des données pour ${selectId}`);
                console.error(error);
            }
        }
    }

    // Gestionnaire de navigation
    class NavigationManager {
        static async handleEtablissementChange() {
            const etablissement = document.querySelector('input[name="etablissement"]:checked');
            const formFields = document.getElementById('form-fields');
            const formInputs = formFields.querySelectorAll('select, input, textarea');
            const questionSelect = document.getElementById('question');

            if (etablissement) {
                formFields.classList.remove('disabled-overlay');
                formInputs.forEach(input => {
                    input.disabled = false;
                });

                const etablissementType = parseInt(etablissement.getAttribute('data-type'));

                try {
                    await DataManager.loadSelectData(API_ENDPOINTS.QUESTIONS, 'question', 'Sélectionnez une question', etablissementType);
                } catch (error) {
                    console.error('Erreur lors du chargement des questions filtrées:', error);
                    AlertManager.showError('Erreur lors du chargement des questions');
                }
            } else {
                formFields.classList.add('disabled-overlay');
                formInputs.forEach(input => {
                    input.disabled = true;
                });

                if (questionSelect) {
                    questionSelect.innerHTML = '<option value="">Sélectionnez une question</option>';
                }
            }
        }

        static showForm() {
            document.getElementById('form-section').classList.remove('hidden');
            document.getElementById('table-section').classList.add('hidden');
            document.getElementById('data-form').reset();
            this.handleEtablissementChange();
        }

        static showTable() {
            document.getElementById('form-section').classList.add('hidden');
            document.getElementById('table-section').classList.remove('hidden');
        }

        static toggleAllCheckboxes(source) {
            const checkboxes = document.querySelectorAll('#table-body input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
            SupervisionManager.updateDeleteButton();
        }
    }

    // Gestionnaire de supervision
    class SupervisionManager {
        static currentPage = 1;
        static paginationInfo = null;



        static async loadSupervisions(page = 1) {
            try {
                const tbody = document.getElementById('table-body');
                if (!tbody) throw new Error('Élément table-body non trouvé');

                tbody.innerHTML = '';
                let supervisions = [];
                const pendingSupervisions = CacheManager.getPendingSupervisions();

                if (navigator.onLine) {
                    try {
                        const response = await DataManager.fetchData(`${API_ENDPOINTS.SUPERVISIONS}?page=${page}`);
                        if (response && response.data) {
                            supervisions = response.data.data;
                            this.paginationInfo = {
                                currentPage: response.data.current_page,
                                lastPage: response.data.last_page,
                                total: response.data.total,
                                perPage: response.data.per_page,
                                links: response.data.links
                            };
                            this.currentPage = page;
                            this.renderPagination();
                        }

                        // Ajouter les supervisions en attente seulement à la première page
                        if (page === 1) {
                            supervisions = [...supervisions, ...pendingSupervisions];
                        }
                    } catch (error) {
                        console.error('Erreur serveur:', error);
                        AlertManager.showWarning('Utilisation des données en cache');
                        supervisions = [...CacheManager.get(STORAGE_KEYS.SUPERVISIONS) || [], ...pendingSupervisions];
                    }
                } else {
                    supervisions = [...CacheManager.get(STORAGE_KEYS.SUPERVISIONS) || [], ...pendingSupervisions];
                    if (supervisions.length > 0) {
                        AlertManager.showWarning('Mode hors ligne - Utilisation des données en cache');
                    }
                }

                // Afficher les supervisions
                supervisions.forEach((supervision, index) => {
                    if (supervision && typeof supervision === 'object') {
                        this.addRowToTable(supervision, index);
                    }
                });

            } catch (error) {
                console.error('Erreur lors du chargement des supervisions:', error);
                AlertManager.showError('Erreur lors du chargement des données');
            }
        }

        static renderPagination() {
            const paginationContainer = document.getElementById('pagination-container');
            if (!paginationContainer || !this.paginationInfo) return;

            const {
                currentPage,
                lastPage,
                links
            } = this.paginationInfo;

            let paginationHTML = `
            <nav aria-label="Pagination des supervisions">
                <ul class="pagination pagination-circle justify-content-center">
        `;

            // Bouton Previous
            paginationHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="SupervisionManager.loadSupervisions(${currentPage - 1})" ${currentPage === 1 ? 'tabindex="-1" aria-disabled="true"' : ''}>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        `;

            // Pages
            links.forEach(link => {
                if (link.url && !link.label.includes('Previous') && !link.label.includes('Next')) {
                    paginationHTML += `
                    <li class="page-item ${link.active ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="SupervisionManager.loadSupervisions(${link.label})">
                            ${link.label}
                        </a>
                    </li>
                `;
                }
            });

            // Bouton Next
            paginationHTML += `
            <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="SupervisionManager.loadSupervisions(${currentPage + 1})" ${currentPage === lastPage ? 'tabindex="-1" aria-disabled="true"' : ''}>
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




        static addRowToTable(supervision, index) {
            const tbody = document.getElementById('table-body');
            if (!tbody || !supervision) return;

            const row = document.createElement('tr');
            row.setAttribute('data-id', supervision.id);

            const getSelectText = (selectId, value) => {
                const select = document.getElementById(selectId);
                if (select) {
                    const option = select.querySelector(`option[value="${value}"]`);
                    return option ? option.textContent : value;
                }
                return value;
            };

            row.innerHTML = `
            <td><input type="checkbox" onchange="SupervisionManager.updateDeleteButton()"></td>
            <td>${index + 1}</td>
            <td>${formatDate(supervision.created_at)}</td>
            <td>${supervision.etablissements || ''}</td>
            <td>${getSelectText('domaine', supervision.domaine) || supervision.domaine || ''}</td>
            <td>${getSelectText('contenu', supervision.contenu) || supervision.contenu || ''}</td>
            <td>${getSelectText('question', supervision.question) || supervision.question || ''}</td>
            <td>${getSelectText('method', supervision.methode) || supervision.methode || ''}</td>
            <td>${supervision.reponse || ''}</td>
            <td>${getSelectText('note', supervision.note) || supervision.note || ''}</td>
            <td>${supervision.commentaire || ''}</td>
            <td>
                <button class="btn btn-sm btn-danger" onclick="SupervisionManager.deleteRow(this)">
                    <i class="bi bi-trash"></i> Supprimer
                </button>
            </td>
        `;
            tbody.appendChild(row);
        }



        static async handleSubmit(event) {
            event.preventDefault();

            const etablissement = document.querySelector('input[name="etablissement"]:checked');
            if (!etablissement) {
                AlertManager.showError('Veuillez sélectionner un établissement');
                return;
            }

            const formData = {
                id: Date.now(),
                etablissements: etablissement.value,
                type:document.getElementById('type').value,
                domaine: document.getElementById('domaine').value,
                contenu: document.getElementById('contenu').value,
                question: document.getElementById('question').value,
                methode: document.getElementById('method').value,
                reponse: document.getElementById('reponse').value,
                note: document.getElementById('note').value,
                commentaire: document.getElementById('commentaire').value,
                timestamp: new Date().toISOString()
            };

            try {
                if (navigator.onLine) {
                    const response = await fetch(API_ENDPOINTS.SAVESUPERVISONS, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(formData)
                    });

                    if (!response.ok) throw new Error('Erreur lors de l\'enregistrement');
                    AlertManager.showSuccess('Données enregistrées avec succès');
                } else {

                    CacheManager.addPendingSupervision(formData);



                    AlertManager.showSuccess('Données sauvegardées localement - En attente de synchronisation');
                }

                document.getElementById('data-form').reset();
                NavigationManager.showTable();
                await this.loadSupervisions();

            } catch (error) {
                console.error('Erreur lors de l\'enregistrement:', error);
                AlertManager.showError('Erreur lors de l\'enregistrement');
            }
        }

        static async syncPendingSupervisions() {
            const pendingSupervisions = CacheManager.getPendingSupervisions();
            if (!pendingSupervisions.length) return;

            const successfulSyncs = [];
            const errors = [];

            for (const supervision of pendingSupervisions) {
                try {
                    const response = await fetch(API_ENDPOINTS.SAVESUPERVISONS, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(supervision)
                    });

                    if (response.ok) {
                        successfulSyncs.push(supervision.id);
                    } else {
                        errors.push({
                            id: supervision.id,
                            error: 'Erreur de réponse serveur'
                        });
                    }
                } catch (error) {
                    errors.push({
                        id: supervision.id,
                        error: error.message
                    });
                }
            }

            // Mettre à jour les supervisions en attente
            if (successfulSyncs.length > 0) {
                const remainingPending = pendingSupervisions.filter(
                    sup => !successfulSyncs.includes(sup.id)
                );
                CacheManager.set(STORAGE_KEYS.PENDING_SUPERVISIONS, remainingPending);

                if (successfulSyncs.length === pendingSupervisions.length) {
                    AlertManager.showSuccess('Toutes les données ont été synchronisées avec succès');
                } else {
                    AlertManager.showSuccess(`${successfulSyncs.length} supervision(s) synchronisée(s)`);
                }
            }

            if (errors.length > 0) {
                AlertManager.showWarning(`${errors.length} supervision(s) n'ont pas pu être synchronisée(s)`);
            }

            return {
                successfulSyncs,
                errors
            };
        }

        static updateDeleteButton() {
            const deleteBtn = document.getElementById('deleteSelectedBtn');
            const anyChecked = document.querySelectorAll('#table-body input[type="checkbox"]:checked').length > 0;
            deleteBtn?.classList.toggle('d-none', !anyChecked);
        }

        static async deleteRow(button) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) return;

            const row = button.closest('tr');
            const id = row.getAttribute('data-id');

            try {
                if (navigator.onLine) {
                    const response = await fetch(`${API_ENDPOINTS.SUPERVISIONS}/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                        }
                    });

                    if (!response.ok) throw new Error('Erreur lors de la suppression');
                }

                // Supprimer des supervisions en attente si présent
                const pendingSupervisions = CacheManager.getPendingSupervisions();
                const updatedPending = pendingSupervisions.filter(sup => sup.id !== parseInt(id));
                CacheManager.set(STORAGE_KEYS.PENDING_SUPERVISIONS, updatedPending);

                // Supprimer du cache principal
                const cachedData = CacheManager.get(STORAGE_KEYS.SUPERVISIONS) || [];
                const updatedCache = cachedData.filter(sup => sup.id !== parseInt(id));
                CacheManager.set(STORAGE_KEYS.SUPERVISIONS, updatedCache);

                row.remove();
                this.updateDeleteButton();
                AlertManager.showSuccess('Élément supprimé avec succès');

            } catch (error) {
                console.error('Erreur lors de la suppression:', error);
                AlertManager.showError('Erreur lors de la suppression');
            }
        }

        static async deleteSelectedRows() {
            if (!confirm('Êtes-vous sûr de vouloir supprimer les éléments sélectionnés ?')) return;

            const selectedRows = document.querySelectorAll('#table-body input[type="checkbox"]:checked');
            for (const checkbox of selectedRows) {
                const row = checkbox.closest('tr');
                await this.deleteRow(row.querySelector('.btn-danger'));
            }
        }
    }

    // Export Excel
    function exportToExcel() {
        try {
            const table = document.querySelector('table');
            if (!table) throw new Error('Table non trouvée');

            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.table_to_sheet(table, {
                raw: true,
                display: false,
                skipHidden: true
            });

            ws['!cols'] = Array(table.rows[0].cells.length).fill({
                wch: 15
            });

            XLSX.utils.book_append_sheet(wb, ws, "Supervision");
            XLSX.writeFile(wb, `supervision_${new Date().toISOString().split('T')[0]}.xlsx`);

            AlertManager.showSuccess('Export Excel réussi');
        } catch (error) {
            console.error('Erreur lors de l\'export Excel:', error);
            AlertManager.showError('Erreur lors de l\'export Excel');
        }
    }

    // Configuration globale
    function setupGlobalHandlers() {
        window.showForm = NavigationManager.showForm.bind(NavigationManager);
        window.showTable = NavigationManager.showTable.bind(NavigationManager);
        window.handleEtablissementChange = NavigationManager.handleEtablissementChange.bind(NavigationManager);
        window.handleSubmit = SupervisionManager.handleSubmit.bind(SupervisionManager);
        window.deleteSelectedRows = SupervisionManager.deleteSelectedRows.bind(SupervisionManager);
        window.toggleAllCheckboxes = NavigationManager.toggleAllCheckboxes.bind(NavigationManager);
        window.exportToExcel = exportToExcel;
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            setupGlobalHandlers();

            // Chargement initial des données
            await Promise.all([
                DataManager.loadSelectData(API_ENDPOINTS.DOMAINES, 'domaine', 'Sélectionnez un domaine'),
                DataManager.loadSelectData(API_ENDPOINTS.CONTENUS, 'contenu', 'Sélectionnez un contenu'),
                DataManager.loadSelectData(API_ENDPOINTS.QUESTIONS, 'question', 'Sélectionnez une question'),
                DataManager.loadSelectData(API_ENDPOINTS.METHODES, 'method', 'Sélectionnez une méthode'),
                DataManager.loadSelectData(API_ENDPOINTS.NOTES, 'note', 'Sélectionnez une note'),
                SupervisionManager.loadSupervisions()
            ]);

            // Écouteurs d'événements pour la connexion
            window.addEventListener('online', async () => {
                AlertManager.showSuccess('Connexion rétablie');
                await SupervisionManager.syncPendingSupervisions();
                await SupervisionManager.loadSupervisions();
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
