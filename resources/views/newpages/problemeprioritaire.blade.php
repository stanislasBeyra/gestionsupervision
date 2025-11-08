@extends('layoutsapp.master')
@section('title', 'Problèmes Prioritaires')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    :root {
        --card-border: #e2e8f0;
        --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        --card-hover: 0 4px 6px rgba(0, 0, 0, 0.1);
        --primary-color: #2563eb;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
    }

    .page-container {
        padding: 32px 24px;
        position: relative;
        min-height: calc(100vh - 58px - 64px);
    }

    @media (max-width: 768px) {
        .page-container {
            padding-top: 40px !important;
            padding: 16px 12px;
        }
    }

    /* Header */
    .page-header {
        margin-bottom: 32px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        display: block;
        visibility: visible;
        opacity: 1;
    }

    .page-subtitle {
        font-size: 15px;
        color: var(--text-secondary);
        margin: 0;
        display: block;
        visibility: visible;
    }

    .header-actions {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: nowrap;
        flex-shrink: 0;
    }

    /* Cards */
    .content-card {
        background: white !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 12px !important;
        padding: 24px !important;
        box-shadow: none !important;
    }

    /* Table */
    .table-wrapper {
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
        position: relative;
    }

    .table {
        margin-bottom: 0 !important;
        width: 100%;
    }

    .table thead th {
        background: #f8fafc !important;
        border-bottom: 2px solid var(--card-border) !important;
        color: var(--text-primary) !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 12px 16px !important;
        white-space: nowrap !important;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table tbody td {
        padding: 16px !important;
        border-bottom: 1px solid #f1f5f9 !important;
        color: var(--text-primary) !important;
        font-size: 14px !important;
        vertical-align: middle !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }

    .table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    /* Search Input */
    .search-container {
        margin-bottom: 24px;
    }

    .search-input-group {
        position: relative;
        max-width: 500px;
        width: 100%;
    }

    .search-input {
        border: 1px solid var(--card-border) !important;
        border-radius: 8px !important;
        padding: 10px 16px !important;
        font-size: 14px !important;
        transition: all 0.2s ease !important;
        width: 100%;
    }

    .search-input:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
        outline: none !important;
    }

    /* Buttons */
    .btn-primary-custom {
        background: var(--primary-color) !important;
        border: none !important;
        color: white !important;
        padding: 10px 20px !important;
        border-radius: 8px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .btn-primary-custom:hover {
        background: #1d4ed8 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2) !important;
    }

    .btn-outline-success-custom {
        border: 1px solid #10b981 !important;
        color: #10b981 !important;
        padding: 10px 20px !important;
        border-radius: 8px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
        background: transparent !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .btn-outline-success-custom:hover {
        background: #10b981 !important;
        color: white !important;
        transform: translateY(-1px);
    }

    .btn-secondary-custom {
        background: #f1f5f9 !important;
        border: 1px solid var(--card-border) !important;
        color: var(--text-primary) !important;
        padding: 10px 20px !important;
        border-radius: 8px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
    }

    .btn-secondary-custom:hover {
        background: #e2e8f0 !important;
    }

    /* Pagination */
    .pagination {
        margin-top: 24px !important;
    }

    .pagination .page-link {
        color: var(--primary-color) !important;
        border: 1px solid var(--card-border) !important;
        padding: 8px 12px !important;
        margin: 0 4px !important;
        border-radius: 6px !important;
        transition: all 0.2s ease !important;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: white !important;
    }

    .pagination .page-link:hover {
        background: #f8fafc !important;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
    }

    .empty-state i {
        font-size: 64px;
        color: var(--text-secondary);
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-state p {
        color: var(--text-secondary);
        font-size: 16px;
        margin: 0;
    }

    /* Mobile Cards */
    .mobile-cards {
        display: none;
    }

    .mobile-card {
        background: white;
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .mobile-card:hover {
        box-shadow: var(--card-hover);
        transform: translateY(-2px);
    }

    .mobile-card-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 12px;
    }

    .mobile-card-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        flex: 1;
    }

    .mobile-card-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        margin-left: 8px;
    }

    .mobile-card-content {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
        font-size: 13px;
    }

    .mobile-card-item {
        display: flex;
        flex-direction: column;
    }

    .mobile-card-label {
        color: var(--text-secondary);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .mobile-card-value {
        color: var(--text-primary);
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .table-wrapper {
            display: none !important;
        }

        .mobile-cards {
            display: block !important;
        }

        .page-header {
            margin-bottom: 24px !important;
        }

        .page-header > div {
            flex-direction: column !important;
        }

        .page-header > div > div:first-child {
            margin-bottom: 16px !important;
            width: 100% !important;
            order: 1 !important;
            flex-shrink: 0 !important;
        }

        .header-actions {
            order: 2 !important;
            flex-direction: row;
            flex-wrap: wrap;
            width: 100%;
            margin-top: 0 !important;
            gap: 8px;
        }

        .page-title {
            font-size: 20px !important;
            margin-bottom: 4px !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
            position: relative !important;
            z-index: 1 !important;
            color: var(--text-primary) !important;
        }

        .page-subtitle {
            font-size: 13px !important;
            display: block !important;
            visibility: visible !important;
            color: var(--text-secondary) !important;
        }

        .header-actions .btn {
            flex: 1;
            padding: 12px 16px !important;
            font-size: 14px;
            justify-content: center !important;
        }

        .content-card {
            padding: 16px !important;
        }

        .drawer {
            max-width: 100%;
        }

        .search-input-group {
            max-width: 100%;
        }

        /* Masquer le tableau et afficher les cartes mobiles */
        .table-wrapper {
            display: none !important;
        }

        .mobile-cards {
            display: block !important;
        }
    }

    @media (max-width: 576px) {
        .page-container {
            padding: 12px 8px;
        }

        .page-title {
            font-size: 18px;
        }

        .content-card {
            padding: 12px !important;
        }

        .mobile-card {
            padding: 12px;
        }

        .mobile-card-content {
            grid-template-columns: 1fr;
            gap: 8px;
        }
    }

    /* Drawer */
    .drawer-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .drawer-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .drawer {
        position: fixed;
        top: 0;
        right: -100%;
        width: 90%;
        max-width: 500px;
        height: 100%;
        background: white;
        box-shadow: -2px 0 8px rgba(0, 0, 0, 0.1);
        z-index: 1050;
        transition: right 0.3s ease;
        overflow-y: auto;
    }

    .drawer.open {
        right: 0;
    }

    .drawer-header {
        padding: 20px;
        border-bottom: 1px solid var(--card-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .drawer-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
    }

    .drawer-close {
        background: none;
        border: none;
        font-size: 24px;
        color: var(--text-secondary);
        cursor: pointer;
        padding: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .drawer-close:hover {
        background: #f1f5f9;
        color: var(--text-primary);
    }

    .drawer-body {
        padding: 20px;
    }

    .drawer-section {
        margin-bottom: 24px;
    }

    .drawer-section-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 12px;
    }

    .drawer-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
        margin-bottom: 16px;
    }

    .drawer-label {
        font-size: 12px;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .drawer-value {
        font-size: 14px;
        color: var(--text-primary);
    }

    /* Form */
    .form-control, .form-outline input, .form-outline textarea {
        border: 1px solid var(--card-border) !important;
        border-radius: 8px !important;
        padding: 10px 16px !important;
        font-size: 14px !important;
        transition: all 0.2s ease !important;
    }

    .form-control:focus, .form-outline input:focus, .form-outline textarea:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
        outline: none !important;
    }

    .form-label {
        color: var(--text-primary) !important;
        font-weight: 500 !important;
        font-size: 14px !important;
    }

    /* Badge */
    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 500;
    }

    .badge.bg-warning {
        background-color: #f59e0b !important;
        color: white !important;
    }

    /* Connection Status */
    #connection-status {
        z-index: 1050;
    }

    .toast-container {
        z-index: 1060;
    }
</style>
@endsection

@section('content')
<div class="page-container">
    @include('layoutsapp.partials.loading', ['size' => 'medium', 'overlay' => true, 'id' => 'loadingSpinner'])

<div id="connection-status" class="position-fixed bottom-0 end-0 m-3 d-none">
    <div class="alert alert-warning d-flex align-items-center" role="alert">
        <i class="fas fa-wifi-slash me-2"></i>
        Mode hors ligne
    </div>
</div>

<!-- Section Tableau -->
<div id="table-section">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                <div class="mb-3 mb-md-0" style="width: 100%;">
                    <h1 class="page-title">Liste des Problèmes prioritaires</h1>
                    <p class="page-subtitle">Aperçu de la vue des Problèmes prioritaires</p>
            </div>
                <div class="header-actions">
                    <button type="button" class="btn btn-outline-success-custom" onclick="exportToCSV()">
                        <i class="fas fa-file-excel"></i>
                        <span class="d-none d-md-inline">Exporter en Excel</span>
                        <span class="d-md-none">Exporter</span>
                </button>
                    <button type="button" class="btn btn-primary-custom" onclick="showForm()">
                        <i class="fas fa-plus-circle"></i>
                        <span>Ajouter un problème</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Barre de recherche -->
    <div class="search-container mb-4">
        <div class="search-input-group">
            <input type="text" id="search-problemes" class="form-control search-input" placeholder="Rechercher un problème..." onkeyup="searchProblemes()">
        </div>
    </div>

        <div class="content-card">
            <!-- Desktop Table View -->
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Date de création</th>
                            <th>Problème prioritaire</th>
                            <th class="d-none d-md-table-cell">Causes</th>
                            <th class="d-none d-lg-table-cell">Délais</th>
                            <th style="text-align: center; width: 60px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="problems-table">
                        <!-- Données dynamiques -->
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards View -->
            <div class="mobile-cards" id="mobile-cards">
                <!-- Les cartes mobiles seront ajoutées ici -->
            </div>

            <div id="empty-message" class="empty-state d-none">
                <i class="fas fa-clipboard"></i>
                <p>Aucun problème prioritaire enregistré</p>
            </div>

            <div id="pagination-container" class="mt-3"></div>
    </div>
</div>

<!-- Section Formulaire -->
<div id="form-section" class="d-none">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                <div class="mb-3 mb-md-0">
                    <h1 class="page-title" id="form-title">Nouveau problème</h1>
                    <p class="page-subtitle" id="form-subtitle">Ajouter un nouveau problème prioritaire</p>
            </div>
                <button class="btn btn-secondary-custom" onclick="showTable()">
                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </button>
        </div>
    </div>

        <div class="content-card">
            <form id="problemForm" onsubmit="handleSubmit(event)">
                @csrf
                <div class="row g-4">
                    <!-- Problème -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <input type="text" id="probleme" name="probleme" class="form-control" required />
                            <label class="form-label" for="probleme">Problème prioritaire</label>
                        </div>
                    </div>

                    <!-- Causes -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <input type="text" id="causes" name="causes" class="form-control" required />
                            <label class="form-label" for="causes">Causes</label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <input type="text" id="actions" name="actions" class="form-control" required />
                            <label class="form-label" for="actions">Actions correctrices</label>
                        </div>
                    </div>

                    <!-- Sources -->
                    <div class="col-md-6">
                        <div class="form-outline">
                            <input type="text" id="sources" name="sources" class="form-control" required />
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
                    <button type="button" class="btn btn-secondary-custom" onclick="showTable()">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </form>
    </div>
</div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer ce problème prioritaire ? Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
                </div>
        </div>
    </div>
</div>

    <!-- Drawer pour les détails -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
    <div class="drawer" id="detailDrawer">
        <div class="drawer-header">
            <h2 class="drawer-title">Détails du problème</h2>
            <button class="drawer-close" onclick="closeDrawer()">
                <i class="fas fa-times"></i>
        </button>
    </div>
        <div class="drawer-body" id="drawerBody">
            <!-- Le contenu sera ajouté dynamiquement -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // ID de l'utilisateur connecté
    const CURRENT_USER_ID = {{ auth()->id() }};
    
    // Configuration globale
    const CONFIG = {
        ENDPOINTS: {
            GET_PROBLEMES: '/api/problemes',
            SAVE_PROBLEME: '/api/problemes/save',
            DELETE_PROBLEME: '/api/problemes/delete'
        },
        STORAGE_KEYS: {
            OFFLINE_PROBLEMS: `offlineProblems_${CURRENT_USER_ID}`,
            LAST_SYNC: `lastSync_${CURRENT_USER_ID}`,
            FORM_STATE: `formState_${CURRENT_USER_ID}`
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
            this.init();
            const toastContainer = document.querySelector('.toast-container');
            if (!toastContainer) {
                alert(message);
                return;
            }

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
            
            if (typeof mdb !== 'undefined' && mdb.Toast) {
            const toast = new mdb.Toast(toastElement);
            toast.show();
            } else {
                toastElement.classList.add('show');
            }

            setTimeout(() => toastElement.remove(), 5000);
        }
    };

    // Gestionnaire de stockage
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

    // Gestionnaire de connexion
    const ConnectionManager = {
        isOnline: navigator.onLine,

        handleOnline() {
            this.isOnline = true;
            this.updateStatus();
            NotificationManager.show('Connexion rétablie', 'success');
            ProblemeManager.syncPendingProblems();
            ProblemeManager.loadProblemes();
        },

        handleOffline() {
            this.isOnline = false;
            this.updateStatus();
            NotificationManager.show('Mode hors ligne activé', 'warning');
            ProblemeManager.loadOfflineData();
        },

        updateStatus() {
            const statusElement = document.getElementById('connection-status');
            if (statusElement) {
                statusElement.classList.toggle('d-none', this.isOnline);
            }
        }
    };

    // Gestionnaire des problèmes
    const ProblemeManager = {
        currentPage: 1,
        editingId: null,
        isOnline: navigator.onLine,
        isSyncing: false,
        isSubmitting: false,
        searchTerm: '',

        init() {
            try {
            NotificationManager.init();
            this.initMDBComponents();
            this.initFlatpickr();
            this.setupEventListeners();
            this.initStorageManager();
            this.loadProblemes();
            if (this.isOnline) {
                this.checkPendingSync();
                }
            } catch (error) {
                console.error('Erreur d\'initialisation:', error);
                NotificationManager.show('Erreur d\'initialisation', 'danger');
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

            const form = document.getElementById('problemForm');
            if (form) {
                form.addEventListener('submit', (e) => this.handleSubmit(e));
            }
        },

        initStorageManager() {
            window.addEventListener('online', () => ConnectionManager.handleOnline());
            window.addEventListener('offline', () => ConnectionManager.handleOffline());
            ConnectionManager.updateStatus();
            this.checkOfflineData();
        },

        async checkPendingSync() {
            const pendingData = StorageManager.get('OFFLINE_PROBLEMS');
            if (pendingData) {
                const lastSync = localStorage.getItem(CONFIG.STORAGE_KEYS.LAST_SYNC);
                const now = new Date().getTime();
                if (!lastSync || (now - new Date(lastSync).getTime()) > 5 * 60 * 1000) {
                    await this.syncPendingProblems();
                }
            }
        },

        async syncPendingProblems() {
            if (!this.isOnline || this.isSyncing) return;

            try {
                this.isSyncing = true;
                const pendingData = StorageManager.get('OFFLINE_PROBLEMS');
                if (!pendingData) {
                    this.isSyncing = false;
                    return;
                }

                const problems = pendingData;
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
                        }
                    } catch (error) {
                        failedCount++;
                    }
                }

                if (syncedCount > 0) {
                    StorageManager.remove('OFFLINE_PROBLEMS');
                    NotificationManager.show(
                        `${syncedCount} problème(s) synchronisé(s) avec succès${failedCount > 0 ? `, ${failedCount} échec(s)` : ''}`,
                        failedCount > 0 ? 'warning' : 'success'
                    );
                    this.loadProblemes(this.currentPage);
                }

                localStorage.setItem(CONFIG.STORAGE_KEYS.LAST_SYNC, new Date().toISOString());
            } catch (error) {
                console.error('Erreur globale de synchronisation:', error);
                NotificationManager.show('Erreur lors de la synchronisation', 'danger');
            } finally {
                this.isSyncing = false;
            }
        },

        async loadProblemes(page = 1, search = '') {
            if (typeof window.showLoadingWithTimeout === 'function') {
                window.showLoadingWithTimeout();
            }

            const tableBody = document.getElementById('problems-table');
            const mobileCards = document.getElementById('mobile-cards');
            if (!tableBody || !mobileCards) return;

            tableBody.innerHTML = `
            <tr>
                <td colspan="9" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </td>
            </tr>
        `;
            mobileCards.innerHTML = '';

            if (!this.isOnline) {
                this.loadOfflineData();
                if (typeof window.hideLoadingWithTimeout === 'function') {
                    window.hideLoadingWithTimeout();
                }
                return;
            }

            try {
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 8000);

                const response = await fetch(`${CONFIG.ENDPOINTS.GET_PROBLEMES}?page=${page}&search=${search}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    signal: controller.signal
                });

                clearTimeout(timeoutId);

                if (!response.ok) throw new Error('Erreur de chargement');

                const data = await response.json();
                if (!data.success) throw new Error(data.message);

                this.searchTerm = search;
                        this.currentPage = page;
                this.displayProblemes(data.problemes.data);
                this.renderPagination(data.problemes);

            } catch (error) {
                    console.error('Erreur de chargement:', error);
                if (error.name === 'AbortError') {
                    NotificationManager.show('Délai d\'attente dépassé', 'warning');
                } else {
                    NotificationManager.show('Erreur de chargement', 'danger');
                }
                    this.loadOfflineData();
            } finally {
                if (typeof window.hideLoadingWithTimeout === 'function') {
                    window.hideLoadingWithTimeout();
                } else if (typeof window.hideLoading === 'function') {
                    window.hideLoading();
                }
            }
        },

        async handleSubmit(event) {
            event.preventDefault();

            const form = event.target;
            if (!form.checkValidity()) {
                event.stopPropagation();
                form.classList.add('was-validated');
                return;
            }

            if (this.isSubmitting) return;
            this.isSubmitting = true;

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnContent = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Traitement...';

            try {
                const formData = new FormData(form);
                if (this.editingId) {
                    formData.append('id', this.editingId);
                }

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
                this.isSubmitting = false;
                submitBtn.disabled = false;
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

                let offlineProblems = StorageManager.get('OFFLINE_PROBLEMS') || [];

                if (this.editingId) {
                    offlineProblems = offlineProblems.map(p =>
                        p.id.toString() === this.editingId.toString() ? data : p
                    );
                } else {
                    offlineProblems.push(data);
                }

                StorageManager.set('OFFLINE_PROBLEMS', offlineProblems);
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

        loadOfflineData() {
            try {
                const offlineData = StorageManager.get('OFFLINE_PROBLEMS');
                if (offlineData) {
                    this.displayProblemes(offlineData, true);
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
            const mobileCards = document.getElementById('mobile-cards');
            if (!tableBody || !mobileCards) return;

            tableBody.innerHTML = '';
            mobileCards.innerHTML = '';

            if (problemes.length === 0) {
                tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <i class="fas fa-folder-open fa-2x mb-3 text-muted"></i>
                        <p class="text-muted mb-0">Aucun problème prioritaire trouvé</p>
                    </td>
                </tr>
            `;
                document.getElementById('empty-message').classList.remove('d-none');
                return;
            }

            document.getElementById('empty-message').classList.add('d-none');

            problemes.forEach((probleme, index) => {
                const row = this.createRow(probleme, index + 1, isOffline);
                tableBody.insertAdjacentHTML('beforeend', row);
                this.addMobileCard(probleme, index + 1, isOffline);
            });
        },

        createRow(probleme, index, isOffline = false) {
            const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
            const problemeData = JSON.stringify(probleme).replace(/"/g, '&quot;');

            return `
            <tr data-id="${probleme.id}" data-probleme='${JSON.stringify(probleme)}' ${isOffline ? 'data-offline="true"' : ''}>
                <td>${index}</td>
                <td>${this.formatDatecreated(probleme.created_at)}</td>
                <td class="text-wrap" style="cursor: pointer; color: var(--primary-color);" onclick="ProblemeManager.openDrawerFromRow(this.closest('tr'))">
                    ${safeText(probleme.probleme)}
                    ${isOffline ? '<span class="badge bg-warning text-dark">Hors ligne</span>' : ''}
                </td>
                <td class="d-none d-md-table-cell text-wrap">${safeText(probleme.causes)}</td>
                <td class="d-none d-lg-table-cell">${this.formatDate(probleme.delai)}</td>
                <td onclick="event.stopPropagation()">
                    <button class="btn btn-primary btn-sm" onclick="ProblemeManager.openDrawerFromRow(this.closest('tr'))" title="Voir détails">
                        <i class="fas fa-eye"></i>
                    </button>
                </td>
            </tr>
        `;
        },

        addMobileCard(probleme, index, isOffline = false) {
            const mobileCards = document.getElementById('mobile-cards');
            if (!mobileCards) return;

            const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
            const card = document.createElement('div');
            card.className = 'mobile-card';
            card.onclick = () => this.openDrawer(probleme);
            card.setAttribute('data-probleme', JSON.stringify(probleme));
            if (isOffline) {
                card.dataset.offlineId = probleme.id;
            } else {
                card.dataset.id = probleme.id;
            }

            card.innerHTML = `
                <div class="mobile-card-header">
                    <h3 class="mobile-card-title">Problème #${index}</h3>
                    ${isOffline ? '<span class="mobile-card-badge bg-warning text-white">Hors ligne</span>' : ''}
                </div>
                <div class="mobile-card-content">
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Problème</span>
                        <span class="mobile-card-value">${safeText(probleme.probleme) || 'N/A'}</span>
                    </div>
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Date de création</span>
                        <span class="mobile-card-value">${this.formatDatecreated(probleme.created_at)}</span>
                    </div>
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Délai</span>
                        <span class="mobile-card-value">${this.formatDate(probleme.delai)}</span>
                    </div>
                </div>
            `;
            mobileCards.appendChild(card);
        },

        openDrawerFromRow(row) {
            const problemeData = row.getAttribute('data-probleme');
            if (problemeData) {
                try {
                    const probleme = JSON.parse(problemeData);
                    this.openDrawer(probleme);
                } catch (e) {
                    console.error('Erreur parsing:', e);
                }
            }
        },

        openDrawer(probleme) {
            const drawer = document.getElementById('detailDrawer');
            const overlay = document.getElementById('drawerOverlay');
            const drawerBody = document.getElementById('drawerBody');

            if (!drawer || !overlay || !drawerBody) return;

            const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';

            drawerBody.innerHTML = `
                <div class="drawer-section">
                    <h3 class="drawer-section-title">Informations générales</h3>
                    <div class="drawer-item">
                        <span class="drawer-label">Date de création</span>
                        <span class="drawer-value">${this.formatDatecreated(probleme.created_at)}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Délai d'exécution</span>
                        <span class="drawer-value">${this.formatDate(probleme.delai)}</span>
                    </div>
                </div>

                <div class="drawer-section">
                    <h3 class="drawer-section-title">Problème prioritaire</h3>
                    <div class="drawer-item">
                        <span class="drawer-value">${safeText(probleme.probleme) || 'N/A'}</span>
                    </div>
                </div>

                <div class="drawer-section">
                    <h3 class="drawer-section-title">Causes</h3>
                    <div class="drawer-item">
                        <span class="drawer-value">${safeText(probleme.causes) || 'N/A'}</span>
                    </div>
                </div>

                <div class="drawer-section">
                    <h3 class="drawer-section-title">Actions correctrices</h3>
                    <div class="drawer-item">
                        <span class="drawer-value">${safeText(probleme.actions) || 'N/A'}</span>
                    </div>
                </div>

                <div class="drawer-section">
                    <h3 class="drawer-section-title">Sources de vérification</h3>
                    <div class="drawer-item">
                        <span class="drawer-value">${safeText(probleme.sources) || 'N/A'}</span>
                    </div>
                </div>

                <div class="drawer-section">
                    <h3 class="drawer-section-title">Acteurs (Responsables)</h3>
                    <div class="drawer-item">
                        <span class="drawer-value">${safeText(probleme.acteurs) || 'N/A'}</span>
                    </div>
                </div>

                <div class="drawer-section">
                    <h3 class="drawer-section-title">Ressources nécessaires</h3>
                    <div class="drawer-item">
                        <span class="drawer-value">${safeText(probleme.ressources) || 'N/A'}</span>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-danger" onclick="ProblemeManager.showDeleteModalFromDrawer('${probleme.id}')">
                        <i class="fas fa-trash me-2"></i>Supprimer
                    </button>
                </div>
            `;

            drawer.classList.add('open');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
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

                return `${day} ${month} ${year} à ${hours}:${minutes}`;
            } catch (error) {
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

                return `${day} ${month} ${year} à ${hours}:${minutes}:${seconds}`;
            } catch (error) {
                return date || '';
            }
        },

        renderPagination(paginationData) {
            const paginationContainer = document.getElementById('pagination-container');
            if (!paginationContainer) return;

            const currentPage = paginationData.current_page;
            const lastPage = paginationData.last_page;

            let paginationHTML = `
            <nav aria-label="Pagination des problèmes">
                <ul class="pagination pagination-circle justify-content-center">
        `;

            paginationHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="ProblemeManager.loadProblemes(${currentPage - 1}, '${this.searchTerm}')" ${currentPage === 1 ? 'tabindex="-1" aria-disabled="true"' : ''}>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        `;

            paginationData.links.forEach(link => {
                if (link.url && !link.label.includes('Previous') && !link.label.includes('Next')) {
                    const pageNum = parseInt(link.label);
                    paginationHTML += `
                    <li class="page-item ${link.active ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="ProblemeManager.loadProblemes(${pageNum}, '${this.searchTerm}')">
                            ${link.label}
                        </a>
                    </li>
                `;
                }
            });

            paginationHTML += `
            <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="ProblemeManager.loadProblemes(${currentPage + 1}, '${this.searchTerm}')" ${currentPage === lastPage ? 'tabindex="-1" aria-disabled="true"' : ''}>
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
                formSection.classList.remove('d-none');
                tableSection.classList.add('d-none');

                if (formTitle) {
                    formTitle.innerHTML = this.editingId ?
                        'Modifier un problème' :
                        'Nouveau problème';
                }

                this.initMDBComponents();
                this.initFlatpickr();
            }
        },

        showTable() {
            const formSection = document.getElementById('form-section');
            const tableSection = document.getElementById('table-section');
            const form = document.getElementById('problemForm');

            if (formSection && tableSection) {
                formSection.classList.add('d-none');
                tableSection.classList.remove('d-none');

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

        checkOfflineData() {
            const offlineData = StorageManager.get('OFFLINE_PROBLEMS');
            if (offlineData) {
                if (offlineData.length > 0) {
                    NotificationManager.show(`${offlineData.length} problème(s) en attente de synchronisation`, 'info');
                }
            }
        },

        showDeleteModalFromDrawer(identifier) {
            closeDrawer();
            const modalElement = document.getElementById('deleteModal');
            if (!modalElement) return;
            
            // Réutiliser l'instance existante ou en créer une nouvelle
            let modal;
            if (modalElement._mdbModal) {
                modal = modalElement._mdbModal;
            } else {
                modal = new mdb.Modal(modalElement);
                modalElement._mdbModal = modal;
            }
            
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            if (!confirmBtn) return;
            
            // Supprimer l'ancien gestionnaire d'événement
            const newConfirmBtn = confirmBtn.cloneNode(true);
            confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
            
            // Ajouter le nouveau gestionnaire
            newConfirmBtn.onclick = async () => {
                await this.deleteProbleme(identifier);
                modal.hide();
            };
            
            modal.show();
        },

        async deleteProbleme(id) {
            try {
                const response = await fetch(`${CONFIG.API_ENDPOINTS.DELETE_PROBLEME}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    NotificationManager.show('Problème supprimé avec succès', 'success');
                    
                    // Supprimer du DOM
                    const rows = document.querySelectorAll('#problems-table tr');
                    const cards = document.querySelectorAll('.mobile-card');
                    
                    rows.forEach(row => {
                        const rowId = row.getAttribute('data-id');
                        if (rowId && rowId.toString() === id.toString()) {
                            row.remove();
                        }
                    });
                    
                    cards.forEach(card => {
                        const cardId = card.getAttribute('data-id') || card.getAttribute('data-offline-id');
                        if (cardId && cardId.toString() === id.toString()) {
                            card.remove();
                        }
                    });
                    
                    // Recharger les problèmes
                    await this.loadProblemes(this.currentPage);
                } else {
                    NotificationManager.show(data.message || 'Erreur lors de la suppression', 'danger');
                }
            } catch (error) {
                console.error('Erreur lors de la suppression:', error);
                NotificationManager.show('Erreur lors de la suppression', 'danger');
            }
        },

        exportToCSV() {
            const table = document.getElementById('problems-table');
            if (!table) return;

            const headers = [
                "N°", "Date de création", "Problème", "Causes", "Actions", "Sources",
                "Acteurs", "Ressources", "Délai"
            ];

            const rows = Array.from(table.getElementsByTagName('tr'));
            const csvContent = [
                headers.join(','),
                ...rows.map(row =>
                    Array.from(row.cells)
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

    // Fonction globale pour fermer le drawer
    function closeDrawer() {
        const drawer = document.getElementById('detailDrawer');
        const overlay = document.getElementById('drawerOverlay');
        
        if (drawer) {
            drawer.classList.remove('open');
        }
        if (overlay) {
            overlay.classList.remove('show');
        }
        document.body.style.overflow = '';
    }

    // Fonctions globales de chargement
    window.showLoading = function() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            spinner.style.display = 'flex';
            spinner.classList.remove('hidden');
        }
    };

    window.hideLoading = function() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            spinner.style.display = 'none';
            spinner.classList.add('hidden');
        }
    };

    window.showLoadingWithTimeout = function() {
        window.showLoading();
        setTimeout(() => {
            window.hideLoading();
        }, 10000);
    };

    window.hideLoadingWithTimeout = function() {
        window.hideLoading();
    };

    // Exposition des fonctions globales
    window.ProblemeManager = ProblemeManager;
    window.showForm = () => ProblemeManager.showForm();
    window.showTable = () => ProblemeManager.showTable();
    window.exportToCSV = () => ProblemeManager.exportToCSV();
    window.searchProblemes = () => {
        const searchInput = document.getElementById('search-problemes');
        if (searchInput) {
            ProblemeManager.loadProblemes(1, searchInput.value.trim());
        }
    };
    window.handleSubmit = (e) => ProblemeManager.handleSubmit(e);

    // Initialisation au chargement de la page
    document.addEventListener('DOMContentLoaded', () => {
        ProblemeManager.init();
    });
</script>

@endsection
