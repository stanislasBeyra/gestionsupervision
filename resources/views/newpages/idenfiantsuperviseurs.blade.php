@extends('layoutsapp.master')
@section('title', 'Identification des superviseurs')

@section('styles')
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
    }

    .header-actions {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
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
        padding: 14px 16px !important;
        border-bottom: 1px solid #f1f5f9 !important;
        color: var(--text-primary) !important;
        font-size: 14px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        vertical-align: middle !important;
        max-width: 200px !important;
    }

    .table tbody td:first-child {
        max-width: 50px !important;
    }

    .table tbody td:nth-child(2) {
        max-width: 180px !important;
    }

    .table tbody td:last-child {
        max-width: 120px !important;
        text-align: center !important;
    }

    .table tbody tr:hover {
        background: #f8fafc !important;
    }

    .table tbody tr:last-child td {
        border-bottom: none !important;
    }

    /* Search */
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
        background: white !important;
        box-sizing: border-box !important;
    }

    .search-input:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
        outline: none !important;
    }

    .search-input::placeholder {
        color: var(--text-secondary);
        opacity: 0.7;
    }

    /* Toast Container */
    .toast-container {
        z-index: 9999 !important;
    }

    .toast {
        min-width: 300px;
        max-width: 500px;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        z-index: 1;
        pointer-events: none;
        font-size: 14px;
        line-height: 1;
        display: inline-block;
    }

    /* Buttons */
    .btn-primary-custom {
        background: var(--primary-color) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 10px 20px !important;
        font-weight: 500 !important;
        font-size: 14px !important;
        color: white !important;
        transition: all 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
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
        background: transparent !important;
        border-radius: 8px !important;
        padding: 10px 20px !important;
        font-weight: 500 !important;
        font-size: 14px !important;
        transition: all 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
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
        border-radius: 8px !important;
        padding: 10px 20px !important;
        font-weight: 500 !important;
        font-size: 14px !important;
        transition: all 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .btn-secondary-custom:hover {
        background: #e2e8f0 !important;
    }

    /* Action buttons */
    .action-btn {
        width: 32px !important;
        height: 32px !important;
        padding: 0 !important;
        border: none !important;
        border-radius: 6px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        background: transparent !important;
    }

    .action-btn-edit {
        color: #f59e0b !important;
    }

    .action-btn-edit:hover {
        background: rgba(245, 158, 11, 0.1) !important;
        color: #d97706 !important;
    }

    .action-btn-delete {
        color: #ef4444 !important;
    }

    .action-btn-delete:hover {
        background: rgba(239, 68, 68, 0.1) !important;
        color: #dc2626 !important;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 64px;
        color: #cbd5e1;
        margin-bottom: 16px;
    }

    .empty-state p {
        color: var(--text-secondary);
        font-size: 16px;
        margin: 0;
    }

    /* Form */
    .form-label {
        font-weight: 500 !important;
        color: var(--text-primary) !important;
        margin-bottom: 8px !important;
        font-size: 14px !important;
    }

    .form-control {
        border: 1px solid var(--card-border) !important;
        border-radius: 8px !important;
        padding: 10px 16px !important;
        font-size: 14px !important;
        transition: all 0.2s ease !important;
    }

    .form-control:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
        outline: none !important;
    }

    /* Pagination */
    .pagination {
        margin-top: 24px;
        justify-content: center;
    }

    .page-link {
        border: 1px solid var(--card-border) !important;
        color: var(--text-primary) !important;
        padding: 8px 16px !important;
        margin: 0 4px !important;
        border-radius: 6px !important;
        transition: all 0.2s ease !important;
    }

    .page-link:hover {
        background: #f8fafc !important;
        border-color: var(--primary-color) !important;
        color: var(--primary-color) !important;
    }

    .page-item.active .page-link {
        background: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: white !important;
    }

    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Mobile Cards View */
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

    /* Drawer */
    .drawer {
        position: fixed;
        top: 0;
        right: -100%;
        width: 100%;
        max-width: 500px;
        height: 100vh;
        background: white;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1050;
        transition: right 0.3s ease;
        overflow-y: auto;
    }

    .drawer.open {
        right: 0;
    }

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

    .drawer-header {
        padding: 20px;
        border-bottom: 1px solid var(--card-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        background: white;
        z-index: 10;
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
        border-radius: 50%;
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
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .drawer-item {
        display: flex;
        flex-direction: column;
        margin-bottom: 16px;
    }

    .drawer-label {
        font-size: 12px;
        color: var(--text-secondary);
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .drawer-value {
        font-size: 14px;
        color: var(--text-primary);
        font-weight: 500;
    }

    /* Hide columns on mobile */
    @media (max-width: 768px) {
        .table-wrapper {
            display: none;
        }

        .mobile-cards {
            display: block;
        }
    }

    /* Responsive */
    @media (max-width: 992px) {
        .page-container {
            padding: 24px 16px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 24px;
        }

        .header-actions {
            margin-top: 16px;
        }
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 16px 12px;
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
            flex-direction: column;
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
            width: 100%;
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
</style>
@endsection

@section('content')
<div class="page-container">
    @include('layoutsapp.partials.loading', ['size' => 'medium', 'overlay' => true, 'id' => 'loadingSpinner'])

    <!-- Section Tableau -->
    <div id="table-section">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                <div class="mb-3 mb-md-0" style="width: 100%;">
                    <h1 class="page-title">Liste des superviseurs</h1>
                    <p class="page-subtitle">Aperçu de la vue des superviseurs</p>
                </div>
                <div class="header-actions">
                    <button type="button" class="btn btn-outline-success-custom" onclick="exportToExcel()">
                        <i class="fas fa-file-excel"></i>
                        <span class="d-none d-md-inline">Exporter en Excel</span>
                        <span class="d-md-none">Exporter</span>
                    </button>
                    <button type="button" class="btn btn-primary-custom" onclick="showForm()">
                        <i class="fas fa-plus-circle"></i>
                        <span>Ajouter un superviseur</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="search-container">
            <div class="search-input-group">
                <input type="text" id="search-supervises" class="form-control search-input"
                    placeholder="Rechercher un superviseur...">
            </div>
        </div>

        <div class="content-card">
            <!-- Desktop Table View -->
            <div class="table-wrapper">
                <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Noms/prénoms</th>
                                <th scope="col">Fonction</th>
                            <th scope="col" class="d-none d-lg-table-cell">Service</th>
                            <th scope="col" class="d-none d-xl-table-cell">Profession</th>
                            <th scope="col" class="d-none d-xl-table-cell">Téléphone</th>
                            <th scope="col" class="d-none d-xl-table-cell">E-mail</th>
                            <th scope="col" style="text-align: center; width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="supervises-table">
                            <!-- Les données seront ajoutées ici -->
                        </tbody>
                    </table>
                </div>

            <!-- Mobile Cards View -->
            <div class="mobile-cards" id="mobile-cards">
                </div>

            <div id="empty-message" class="empty-state d-none">
                <i class="fas fa-users"></i>
                <p>Aucun superviseur enregistré</p>
            </div>

                <div id="pagination-container"></div>
        </div>
    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="d-none">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                <div class="mb-3 mb-md-0">
                    <h1 class="page-title" id="formTitle">Nouveau superviseur</h1>
                    <p class="page-subtitle" id="formSubtitle">Ajouter un nouveau superviseur</p>
                </div>
                <button class="btn btn-secondary-custom" onclick="showTable()">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour à la liste</span>
                </button>
            </div>
        </div>

        <div class="content-card">
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

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary-custom" onclick="showTable()">
                        <i class="fas fa-times"></i>
                        <span>Annuler</span>
                        </button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save"></i>
                        <span>Enregistrer</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    <!-- Drawer pour les détails -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
    <div class="drawer" id="detailDrawer">
        <div class="drawer-header">
            <h2 class="drawer-title">Détails du superviseur</h2>
            <button class="drawer-close" onclick="closeDrawer()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="drawer-body" id="drawerBody">
            <!-- Le contenu sera ajouté dynamiquement -->
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
            // S'assurer que le conteneur existe
            this.init();
            
            const toastContainer = document.querySelector('.toast-container');
            if (!toastContainer) {
                console.error('Toast container not found');
                // Fallback vers alert si le conteneur n'existe pas
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
            
            // Vérifier que MDB est disponible
            if (typeof mdb !== 'undefined' && mdb.Toast) {
                const toast = new mdb.Toast(toastElement);
                toast.show();
            } else {
                // Fallback si MDB n'est pas disponible
                toastElement.classList.add('show');
            }

            // Nettoyer après la durée définie
            const duration = (typeof CONFIG !== 'undefined' && CONFIG.TOAST_DURATION) ? CONFIG.TOAST_DURATION : 5000;
            setTimeout(() => {
                toastElement.remove();
            }, duration);
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
     * Gestionnaire principal des superviseurs
     */
    const SuperviseManager = {
        superviseCount: 0,
        editingRow: null,
        searchTerm: '',
        currentPage: 1,

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
                if (typeof window.showLoadingWithTimeout === 'function') {
                    window.showLoadingWithTimeout();
                } else if (typeof window.showLoading === 'function') {
                    window.showLoading();
                }

                if (!ConnectionManager.isOnline) {
                    this.loadOfflineData();
                    if (typeof window.hideLoadingWithTimeout === 'function') {
                        window.hideLoadingWithTimeout();
                    } else if (typeof window.hideLoading === 'function') {
                        window.hideLoading();
                    }
                    return;
                }

                const url = new URL(CONFIG.ENDPOINTS.GET_SUPERVISES, window.location.origin);
                url.searchParams.append('page', page);
                if (search) {
                    url.searchParams.append('search', search);
                }

                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 8000);

                const response = await fetch(url, {
                    signal: controller.signal
                });

                clearTimeout(timeoutId);

                if (!response.ok) throw new Error('Erreur de chargement');

                const data = await response.json();
                if (!data.success) throw new Error(data.message);

                this.searchTerm = search;
                this.currentPage = page;
                this.displaySupervises(data.superviseur.data);
                this.renderPagination(data.superviseur);

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

        async saveSupervise(formData) {
            if (!ConnectionManager.isOnline) {
                return this.saveLocally(formData);
            }

            try {
                const apiData = {
                    firstname: formData.nom_prenom,
                    fonction: formData.fonction,
                    service: formData.service,
                    profession: formData.profession,
                    phone: formData.phone,
                    email: formData.email
                };

                // Ajouter l'ID si c'est une modification
                if (formData.id) {
                    apiData.id = formData.id;
                }

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
                    // Le contrôleur gère déjà la traduction des messages
                    // On utilise simplement le message retourné par le serveur
                    const errorMessage = data.message || data.error || 'Erreur de sauvegarde';
                    throw new Error(errorMessage);
                }

                // Vérifier si la réponse contient success: true ou si c'est un succès (200)
                if (data.success !== false && (data.success === true || response.status === 200)) {
                    return {
                        success: true,
                        data: {
                            ...data.data,
                            nom_prenom: data.data.firstname
                        }
                    };
                } else {
                    throw new Error(data.message || 'Erreur de sauvegarde');
                }

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
                NotificationManager.show(`${syncedCount} superviseur(s) synchronisé(s)`, 'success');
                await this.loadSupervises();
            }
        },

        displaySupervises(supervises, isOffline = false) {
            const tbody = document.getElementById('supervises-table');
            const mobileCards = document.getElementById('mobile-cards');
            if (!tbody || !mobileCards) return;

            tbody.innerHTML = '';
            mobileCards.innerHTML = '';

            if (supervises.length === 0) {
                this.checkEmptyTable();
                return;
            }

            supervises.forEach((supervise, index) => {
                const rowNumber = (this.currentPage - 1) * 10 + index + 1;
                
                // Stocker les données dans l'attribut data
                const superviseData = JSON.stringify(supervise);
                
                // Créer la ligne de table
                const row = document.createElement('tr');
                row.setAttribute('data-supervise', superviseData);
                row.innerHTML = `
            <td>${rowNumber}</td>
            <td style="cursor: pointer; color: var(--primary-color);" onclick="SuperviseManager.openDrawerFromRow(this.closest('tr'))">${supervise.firstname || ''}${isOffline ? ' <span class="badge bg-warning">Hors ligne</span>' : ''}</td>
            <td>${supervise.fonction || ''}</td>
            <td class="d-none d-lg-table-cell">${supervise.service || ''}</td>
            <td class="d-none d-xl-table-cell">${supervise.profession || ''}</td>
            <td class="d-none d-xl-table-cell">${supervise.phone || ''}</td>
            <td class="d-none d-xl-table-cell">${supervise.email || ''}</td>
            <td style="text-align: center;">
                <button type="button" class="action-btn action-btn-edit" onclick="SuperviseManager.editSupervise(this)" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </button>
                <button type="button" class="action-btn action-btn-delete" onclick="SuperviseManager.deleteSupervise(this)" title="Supprimer">
                        <i class="fas fa-trash"></i>
                    </button>
            </td>
        `;

                if (isOffline) {
                    row.dataset.offlineId = supervise.id;
                } else {
                    row.dataset.id = supervise.id;
                }

                tbody.appendChild(row);

                // Créer la carte mobile
                this.addMobileCard(supervise, rowNumber, isOffline);
            });

            this.checkEmptyTable();
        },

        addMobileCard(supervise, index, isOffline = false) {
            const mobileCards = document.getElementById('mobile-cards');
            if (!mobileCards) return;

            const card = document.createElement('div');
            card.className = 'mobile-card';
            card.onclick = () => this.openDrawer(supervise);
            card.setAttribute('data-supervise', JSON.stringify(supervise));
            if (isOffline) {
                card.dataset.offlineId = supervise.id;
            } else {
                card.dataset.id = supervise.id;
            }

            card.innerHTML = `
                <div class="mobile-card-header">
                    <h3 class="mobile-card-title">${supervise.firstname || 'N/A'}</h3>
                    ${isOffline ? '<span class="mobile-card-badge bg-warning text-white">Hors ligne</span>' : ''}
                </div>
                <div class="mobile-card-content">
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Fonction</span>
                        <span class="mobile-card-value">${supervise.fonction || 'N/A'}</span>
                    </div>
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Service</span>
                        <span class="mobile-card-value">${supervise.service || 'N/A'}</span>
                    </div>
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Téléphone</span>
                        <span class="mobile-card-value">${supervise.phone || 'N/A'}</span>
                    </div>
                </div>
                <div style="display: flex; gap: 8px; margin-top: 12px; justify-content: flex-end;">
                    <button type="button" class="action-btn action-btn-edit" onclick="event.stopPropagation(); SuperviseManager.editSuperviseFromCard(this)" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="action-btn action-btn-delete" onclick="event.stopPropagation(); SuperviseManager.deleteSupervise(this)" title="Supprimer">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            mobileCards.appendChild(card);
        },

        openDrawerFromRow(row) {
            const superviseData = row.getAttribute('data-supervise');
            if (superviseData) {
                try {
                    const supervise = JSON.parse(superviseData);
                    this.openDrawer(supervise);
                } catch (e) {
                    console.error('Erreur parsing:', e);
                }
            }
        },

        openDrawer(supervise) {
            const drawer = document.getElementById('detailDrawer');
            const overlay = document.getElementById('drawerOverlay');
            const drawerBody = document.getElementById('drawerBody');

            if (!drawer || !overlay || !drawerBody) return;

            drawerBody.innerHTML = `
                <div class="drawer-section">
                    <h3 class="drawer-section-title">Informations personnelles</h3>
                    <div class="drawer-item">
                        <span class="drawer-label">Noms/prénoms</span>
                        <span class="drawer-value">${supervise.firstname || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Fonction</span>
                        <span class="drawer-value">${supervise.fonction || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Service</span>
                        <span class="drawer-value">${supervise.service || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Profession</span>
                        <span class="drawer-value">${supervise.profession || 'N/A'}</span>
                    </div>
                </div>

                <div class="drawer-section">
                    <h3 class="drawer-section-title">Coordonnées</h3>
                    <div class="drawer-item">
                        <span class="drawer-label">Téléphone</span>
                        <span class="drawer-value">${supervise.phone || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">E-mail</span>
                        <span class="drawer-value">${supervise.email || 'N/A'}</span>
                    </div>
                </div>
            `;

            drawer.classList.add('open');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
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
                    const id = this.editingRow.dataset.id || this.editingRow.dataset.offlineId;
                    if (id) formData.id = id;
                } else if (form.dataset.editId) {
                    // Récupérer l'ID depuis le formulaire si défini
                    formData.id = form.dataset.editId;
                }

                const result = await this.saveSupervise(formData);

                if (result.success || result.offline) {
                    NotificationManager.show(
                        result.offline ? 'Sauvegardé en mode hors ligne' : 'Superviseur enregistré avec succès',
                        result.offline ? 'warning' : 'success'
                    );

                    this.showTable();
                    form.reset();
                    await this.loadSupervises(this.currentPage);
                }

            } catch (error) {
                console.error('Erreur de soumission:', error);
                // S'assurer que NotificationManager est initialisé
                if (typeof NotificationManager !== 'undefined' && NotificationManager.show) {
                    const errorMessage = error.message || 'Erreur lors de l\'enregistrement';
                    NotificationManager.show(errorMessage, 'danger');
                } else {
                    // Fallback si NotificationManager n'est pas disponible
                    alert(error.message || 'Erreur lors de l\'enregistrement');
                }
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>Enregistrer';
                }
                form.classList.remove('was-validated');
            }
        },

        async deleteSupervise(button) {
                    const row = button.closest('tr');
            const card = button.closest('.mobile-card');
            
            let superviseName = '';
            let superviseId = null;
            let isOffline = false;

            if (row) {
                superviseName = row.cells[1].textContent.trim().replace('Hors ligne', '').trim();
                    if (row.dataset.offlineId) {
                    superviseId = row.dataset.offlineId;
                    isOffline = true;
                } else if (row.dataset.id) {
                    superviseId = row.dataset.id;
                }
            } else if (card) {
                superviseName = card.querySelector('.mobile-card-title')?.textContent.trim() || '';
                if (card.dataset.offlineId) {
                    superviseId = card.dataset.offlineId;
                    isOffline = true;
                } else if (card.dataset.id) {
                    superviseId = card.dataset.id;
                }
            }

            if (!confirm(`Êtes-vous sûr de vouloir supprimer le superviseur "${superviseName}" ?`)) {
                return;
            }

            try {
                if (isOffline) {
                    const offlineSupervises = StorageManager.get('OFFLINE_SUPERVISES') || [];
                    const filtered = offlineSupervises.filter(s => s.id.toString() !== superviseId);
                    StorageManager.set('OFFLINE_SUPERVISES', filtered);
                    if (row) row.remove();
                    if (card) card.remove();
                    this.updateNumbers();
                    this.checkEmptyTable();
                    NotificationManager.show('Superviseur supprimé avec succès', 'success');
                } else {
                    // TODO: Implémenter la suppression via API si nécessaire
                    if (row) row.remove();
                    if (card) card.remove();
                    this.updateNumbers();
                    this.checkEmptyTable();
                    NotificationManager.show('Superviseur supprimé avec succès', 'success');
                }
                } catch (error) {
                    console.error('Erreur lors de la suppression:', error);
                    NotificationManager.show('Erreur lors de la suppression', 'danger');
            }
        },

        showForm() {
            document.getElementById('form-section')?.classList.remove('d-none');
            document.getElementById('table-section')?.classList.add('d-none');
            document.getElementById('formTitle').textContent = this.editingRow ? 'Modifier un superviseur' : 'Nouveau superviseur';
            document.getElementById('formSubtitle').textContent = this.editingRow ? 'Modifier les informations du superviseur' : 'Ajouter un nouveau superviseur';
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

            const superviseData = row.getAttribute('data-supervise');
            if (superviseData) {
                try {
                    const supervise = JSON.parse(superviseData);
                    form.elements['nom_prenom'].value = supervise.firstname || '';
                    form.elements['fonction'].value = supervise.fonction || '';
                    form.elements['service'].value = supervise.service || '';
                    form.elements['profession'].value = supervise.profession || '';
                    form.elements['phone'].value = supervise.phone || '';
                    form.elements['email'].value = supervise.email || '';

            if (row.dataset.id) {
                form.dataset.editId = row.dataset.id;
                    } else if (row.dataset.offlineId) {
                        form.dataset.editId = row.dataset.offlineId;
            } else {
                delete form.dataset.editId;
                    }
                } catch (e) {
                    console.error('Erreur parsing:', e);
                }
            }

            this.showForm();
        },

        editSuperviseFromCard(button) {
            const card = button.closest('.mobile-card');
            if (!card) return;

            const superviseData = card.getAttribute('data-supervise');
            if (!superviseData) {
                // Récupérer depuis les données stockées dans la row correspondante
                const superviseId = card.dataset.id || card.dataset.offlineId;
                const allRows = document.querySelectorAll('#supervises-table tr');
                for (const row of allRows) {
                    if ((row.dataset.id === superviseId) || (row.dataset.offlineId === superviseId)) {
                        this.editingRow = row;
                        const rowData = row.getAttribute('data-supervise');
                        if (rowData) {
                            try {
                                const supervise = JSON.parse(rowData);
                                const form = document.getElementById('superviseForm');
                                if (form) {
                                    form.elements['nom_prenom'].value = supervise.firstname || '';
                                    form.elements['fonction'].value = supervise.fonction || '';
                                    form.elements['service'].value = supervise.service || '';
                                    form.elements['profession'].value = supervise.profession || '';
                                    form.elements['phone'].value = supervise.phone || '';
                                    form.elements['email'].value = supervise.email || '';

                                    if (row.dataset.id) {
                                        form.dataset.editId = row.dataset.id;
                                    } else if (row.dataset.offlineId) {
                                        form.dataset.editId = row.dataset.offlineId;
                                    }
                                }
                            } catch (e) {
                                console.error('Erreur parsing:', e);
                            }
                        }
                        break;
                    }
                }
            } else {
                try {
                    const supervise = JSON.parse(superviseData);
                    const form = document.getElementById('superviseForm');
                    if (form) {
                        form.elements['nom_prenom'].value = supervise.firstname || '';
                        form.elements['fonction'].value = supervise.fonction || '';
                        form.elements['service'].value = supervise.service || '';
                        form.elements['profession'].value = supervise.profession || '';
                        form.elements['phone'].value = supervise.phone || '';
                        form.elements['email'].value = supervise.email || '';

                        if (card.dataset.id) {
                            form.dataset.editId = card.dataset.id;
                        } else if (card.dataset.offlineId) {
                            form.dataset.editId = card.dataset.offlineId;
                        }
                    }
                } catch (e) {
                    console.error('Erreur parsing:', e);
                }
            }

            this.showForm();
        },

        updateNumbers() {
            const rows = document.querySelectorAll('#supervises-table tr');
            rows.forEach((row, index) => {
                const rowNumber = (this.currentPage - 1) * 10 + index + 1;
                row.cells[0].textContent = rowNumber;
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
                <i class="fas fa-search"></i>
                <p>Aucun résultat trouvé pour "${searchInput.value}"</p>
            `;
                } else {
                    emptyMessage.innerHTML = `
                <i class="fas fa-users"></i>
                <p>Aucun superviseur enregistré</p>
`;
                }
            }
        },

        initFormValidation() {
            const form = document.getElementById('superviseForm');
            if (!form) return;

            const phoneInput = form.elements['phone'];
            if (phoneInput) {
                phoneInput.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9+\s-]/g, '');
                    const isValid = /^[+]?[\d\s-]{9,}$/.test(this.value);
                    this.classList.toggle('is-invalid', !isValid && this.value !== '');
                });
            }

            const emailInput = form.elements['email'];
            if (emailInput) {
                emailInput.addEventListener('input', function() {
                    const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value);
                    this.classList.toggle('is-invalid', !isValid && this.value !== '');
                });
            }

            const requiredInputs = form.querySelectorAll('[required]');
            requiredInputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.classList.toggle('is-invalid', !this.value.trim());
                });
            });
        },

        renderPagination(paginationData) {
            const paginationContainer = document.getElementById('pagination-container');
            if (!paginationContainer || !paginationData) return;

            const currentPage = paginationData.current_page;
            const lastPage = paginationData.last_page;

            if (lastPage <= 1) {
                paginationContainer.innerHTML = '';
                return;
            }

            let paginationHTML = `
            <nav aria-label="Pagination des superviseurs">
                <ul class="pagination">
        `;

            paginationHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="SuperviseManager.loadSupervises(${currentPage - 1}, '${this.searchTerm}'); return false;" ${currentPage === 1 ? 'tabindex="-1" aria-disabled="true"' : ''}>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        `;

            paginationData.links.forEach(link => {
                if (link.url && !link.label.includes('Previous') && !link.label.includes('Next')) {
                    const pageNum = parseInt(link.label);
                    paginationHTML += `
                    <li class="page-item ${link.active ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="SuperviseManager.loadSupervises(${pageNum}, '${this.searchTerm}'); return false;">
                            ${link.label}
                        </a>
                    </li>
                `;
                }
            });

            paginationHTML += `
            <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="SuperviseManager.loadSupervises(${currentPage + 1}, '${this.searchTerm}'); return false;" ${currentPage === lastPage ? 'tabindex="-1" aria-disabled="true"' : ''}>
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
                let csvContent = "N°,Noms/prénoms,Fonction,Service,Profession,Téléphone,E-mail\n";

                rows.forEach(row => {
                    if (!row.classList.contains('d-none')) {
                        const columns = Array.from(row.cells)
                            .slice(0, -1)
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
                link.setAttribute('download', `superviseurs_${timestamp}.csv`);
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
            NotificationManager.init();
            
            if (typeof window.showLoadingWithTimeout === 'function') {
                window.showLoadingWithTimeout();
            } else if (typeof window.showLoading === 'function') {
                window.showLoading();
            }

            await new Promise(resolve => setTimeout(resolve, 100));

            await SuperviseManager.init();
            ConnectionManager.init();

            if (ConnectionManager.isOnline) {
                await SuperviseManager.syncOfflineData();
            }

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
        } finally {
            if (typeof window.hideLoadingWithTimeout === 'function') {
                window.hideLoadingWithTimeout();
            } else if (typeof window.hideLoading === 'function') {
                window.hideLoading();
            }
        }
    });

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

    // Fonctions globales pour le loading
    let loadingTimeout = null;

    window.showLoading = function() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            // Retirer la classe hidden et le style display
            spinner.classList.remove('hidden');
            spinner.style.removeProperty('display');
            spinner.style.display = 'flex';
        } else {
            console.error('Élément loadingSpinner introuvable');
        }
    };

    window.hideLoading = function() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            // Arrêter toutes les animations
            spinner.classList.add('hidden');
            spinner.style.setProperty('display', 'none', 'important');
        } else {
            console.error('Élément loadingSpinner introuvable pour masquer');
        }
    };

    window.showLoadingWithTimeout = function() {
        window.showLoading();
        // Annuler le timeout précédent s'il existe
        if (loadingTimeout) {
            clearTimeout(loadingTimeout);
        }
        // Timeout de sécurité pour forcer le masquage après 10 secondes
        loadingTimeout = setTimeout(() => {
            console.warn('Timeout de sécurité: masquage du loading après 10 secondes');
            window.hideLoading();
        }, 10000); // 10 secondes maximum
    };

    window.hideLoadingWithTimeout = function() {
        if (loadingTimeout) {
            clearTimeout(loadingTimeout);
            loadingTimeout = null;
        }
        window.hideLoading();
    };

    // Exportation des fonctions globales
    window.showForm = () => SuperviseManager.showForm();
    window.showTable = () => SuperviseManager.showTable();
    window.handleSubmit = (event) => SuperviseManager.handleSubmit(event);
    window.exportToExcel = () => SuperviseManager.exportToExcel();
    window.closeDrawer = closeDrawer;
    window.SuperviseManager = SuperviseManager;
</script>
@endsection
