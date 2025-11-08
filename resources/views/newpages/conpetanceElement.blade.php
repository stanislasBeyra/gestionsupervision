@extends('layoutsapp.master')
@section('title', 'Éléments de Compétance')

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
        vertical-align: middle !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }

    .table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    .table tbody tr {
        cursor: pointer;
    }

    /* Buttons */
    .btn-primary-custom {
        background: var(--primary-color) !important;
        border: none !important;
        color: white !important;
        padding: 8px 16px !important;
        border-radius: 6px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
        font-size: 13px !important;
    }

    .btn-primary-custom:hover {
        background: #1d4ed8 !important;
        transform: translateY(-1px);
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

    .btn-danger-custom {
        background: #ef4444 !important;
        border: none !important;
        color: white !important;
        padding: 8px 16px !important;
        border-radius: 6px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
        font-size: 13px !important;
    }

    .btn-danger-custom:hover {
        background: #dc2626 !important;
        transform: translateY(-1px);
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

        /* Masquer le tableau et afficher les cartes mobiles */
        .table-wrapper {
            display: none !important;
        }

        .mobile-cards {
            display: block !important;
        }

        .drawer {
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

    .toast-container {
        z-index: 1060;
    }
</style>
@endsection

@section('content')
<div class="page-container">
    @include('layoutsapp.partials.loading', ['size' => 'medium', 'overlay' => true, 'id' => 'loadingSpinner'])

    <div class="page-header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
            <div class="mb-3 mb-md-0" style="width: 100%;">
                <h1 class="page-title">Liste des Éléments de compétance</h1>
                <p class="page-subtitle">Aperçu de la vue des Éléments de compétance</p>
            </div>
            <div class="header-actions">
                <button type="button" class="btn btn-outline-success-custom" onclick="exportToExcel()">
                    <i class="fas fa-file-excel"></i>
                    <span class="d-none d-md-inline">Exporter en Excel</span>
                    <span class="d-md-none">Exporter</span>
                </button>
            </div>
        </div>
    </div>

    <div class="content-card">
        <!-- Desktop Table View -->
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)">
                        </th>
                        <th scope="col">#ID</th>
                        <th scope="col">Date d'ajout</th>
                        <th scope="col">Établissement</th>
                        <th scope="col" class="d-none d-lg-table-cell">Domaine</th>
                        <th scope="col" class="d-none d-xl-table-cell">Contenu</th>
                        <th scope="col" class="d-none d-xl-table-cell">Question PA</th>
                        <th scope="col" class="d-none d-lg-table-cell">Méthode</th>
                        <th scope="col" class="d-none d-xl-table-cell">Réponse</th>
                        <th scope="col" class="d-none d-md-table-cell">Note Obtenue</th>
                        <th scope="col" class="d-none d-xl-table-cell">Commentaires</th>
                        <th scope="col" style="text-align: center; width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards View -->
        <div class="mobile-cards" id="mobile-cards">
            <!-- Les cartes mobiles seront ajoutées ici -->
        </div>

        <div id="empty-message" class="empty-state d-none">
            <i class="fas fa-clipboard"></i>
            <p>Aucune supervision trouvée</p>
        </div>

        <div id="pagination-container" class="mt-3"></div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3"></div>

    <!-- Drawer pour les détails -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
    <div class="drawer" id="detailDrawer">
        <div class="drawer-header">
            <h2 class="drawer-title">Détails de la supervision</h2>
            <button class="drawer-close" onclick="closeDrawer()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="drawer-body" id="drawerBody">
            <!-- Le contenu sera ajouté dynamiquement -->
        </div>
    </div>
</div>

<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script>
    // Points d'accès de l'API
    const API_ENDPOINTS = {
        SUPERVISIONS: '/api/supervision/competanceElement'
    };

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

            return `${day} ${month} ${year} à ${hours}:${minutes}:${seconds}`;
        } catch (error) {
            console.error('Erreur de formatage de date:', error);
            return date || '';
        }
    }

    // Gestionnaire de notifications
    const NotificationManager = {
        show(message, type = 'success') {
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
    };

    // Récupérer les supervisions avec type = 2
    function fetchSupervisions(page = 1) {
        if (typeof window.showLoadingWithTimeout === 'function') {
            window.showLoadingWithTimeout();
        }

        fetch(`${API_ENDPOINTS.SUPERVISIONS}?type=2&page=${page}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderTable(data.data);
                    renderPagination(data.data);
                } else {
                    NotificationManager.show(data.message || 'Erreur lors du chargement', 'danger');
                }
            })
            .catch(error => {
                console.error('Erreur récupération:', error);
                NotificationManager.show('Erreur lors du chargement des données', 'danger');
            })
            .finally(() => {
                if (typeof window.hideLoadingWithTimeout === 'function') {
                    window.hideLoadingWithTimeout();
                } else if (typeof window.hideLoading === 'function') {
                    window.hideLoading();
                }
            });
    }

    // Afficher les supervisions dans la table
    function renderTable(data) {
        const tbody = document.getElementById('table-body');
        const mobileCards = document.getElementById('mobile-cards');
        const emptyMessage = document.getElementById('empty-message');

        if (!tbody) return;

        tbody.innerHTML = '';
        if (mobileCards) mobileCards.innerHTML = '';

        if (data.data.length === 0) {
            if (emptyMessage) emptyMessage.classList.remove('d-none');
            return;
        }

        if (emptyMessage) emptyMessage.classList.add('d-none');

        data.data.forEach((supervision, index) => {
            addRowToTable(supervision, index);
            addMobileCard(supervision, index);
        });
    }

    function addRowToTable(supervision, index) {
        const tbody = document.getElementById('table-body');
        if (!tbody) return;

        const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
        const getValue = (value) => value ?? '-';

        const row = document.createElement('tr');
        row.style.cursor = 'pointer';
        row.onclick = () => openDrawer(supervision);
        row.setAttribute('data-supervision', JSON.stringify(supervision));

        row.innerHTML = `
            <td onclick="event.stopPropagation()"><input type="checkbox" value="${supervision.id}"></td>
            <td>${index + 1}</td>
            <td>${formatDate(supervision.created_at)}</td>
            <td>${safeText(getValue(supervision.etablissements))}</td>
            <td class="d-none d-lg-table-cell">${safeText(getValue(supervision.domaines?.name_domaine))}</td>
            <td class="d-none d-xl-table-cell">${safeText(getValue(supervision.continues?.[0]?.name_contenu))}</td>
            <td class="d-none d-xl-table-cell">${safeText(getValue(supervision.questions?.[0]?.name_question))}</td>
            <td class="d-none d-lg-table-cell">${safeText(getValue(supervision.methodes?.[0]?.methode_name))}</td>
            <td class="d-none d-xl-table-cell">${safeText(getValue(supervision.reponse))}</td>
            <td class="d-none d-md-table-cell">${safeText(getValue(supervision.note))}</td>
            <td class="d-none d-xl-table-cell">${safeText(getValue(supervision.commentaire))}</td>
            <td onclick="event.stopPropagation()">
                <button class="btn btn-primary-custom btn-sm" onclick="viewSupervision(${supervision.id})">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn btn-danger-custom btn-sm" onclick="deleteSupervision(${supervision.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    }

    function addMobileCard(supervision, index) {
        const mobileCards = document.getElementById('mobile-cards');
        if (!mobileCards) return;

        const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
        const getValue = (value) => value ?? 'N/A';

        const card = document.createElement('div');
        card.className = 'mobile-card';
        card.onclick = () => openDrawer(supervision);
        card.setAttribute('data-supervision', JSON.stringify(supervision));
        card.setAttribute('data-id', supervision.id);

        card.innerHTML = `
            <div class="mobile-card-header">
                <h3 class="mobile-card-title">Supervision #${index + 1}</h3>
            </div>
            <div class="mobile-card-content">
                <div class="mobile-card-item">
                    <span class="mobile-card-label">Date d'ajout</span>
                    <span class="mobile-card-value">${formatDate(supervision.created_at)}</span>
                </div>
                <div class="mobile-card-item">
                    <span class="mobile-card-label">Établissement</span>
                    <span class="mobile-card-value">${safeText(getValue(supervision.etablissements))}</span>
                </div>
                <div class="mobile-card-item">
                    <span class="mobile-card-label">Domaine</span>
                    <span class="mobile-card-value">${safeText(getValue(supervision.domaines?.name_domaine))}</span>
                </div>
                <div class="mobile-card-item">
                    <span class="mobile-card-label">Note Obtenue</span>
                    <span class="mobile-card-value">${safeText(getValue(supervision.note))}</span>
                </div>
            </div>
        `;
        mobileCards.appendChild(card);
    }

    function renderPagination(data) {
        const paginationContainer = document.getElementById('pagination-container');
        if (!paginationContainer) return;

        let currentPage = data.current_page;
        let lastPage = data.last_page;

        let paginationHTML = `
            <nav aria-label="Pagination des supervisions">
                <ul class="pagination pagination-circle justify-content-center">
                    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="fetchSupervisions(${currentPage - 1})" ${currentPage === 1 ? 'tabindex="-1" aria-disabled="true"' : ''}>
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
        `;

        for (let page = 1; page <= lastPage; page++) {
            paginationHTML += `
                <li class="page-item ${page === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="fetchSupervisions(${page})">${page}</a>
                </li>
            `;
        }

        paginationHTML += `
                    <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="fetchSupervisions(${currentPage + 1})" ${currentPage === lastPage ? 'tabindex="-1" aria-disabled="true"' : ''}>
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        `;

        paginationContainer.innerHTML = paginationHTML;
    }

    // Ouvrir le drawer avec les détails
    function openDrawer(supervision) {
        const drawer = document.getElementById('detailDrawer');
        const overlay = document.getElementById('drawerOverlay');
        const drawerBody = document.getElementById('drawerBody');

        if (!drawer || !overlay || !drawerBody) return;

        const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
        const getValue = (value) => value ?? 'N/A';

        drawerBody.innerHTML = `
            <div class="drawer-section">
                <h3 class="drawer-section-title">Informations générales</h3>
                <div class="drawer-item">
                    <span class="drawer-label">Date d'ajout</span>
                    <span class="drawer-value">${formatDate(supervision.created_at)}</span>
                </div>
                <div class="drawer-item">
                    <span class="drawer-label">Établissement</span>
                    <span class="drawer-value">${safeText(getValue(supervision.etablissements))}</span>
                </div>
            </div>

            <div class="drawer-section">
                <h3 class="drawer-section-title">Détails de la supervision</h3>
                <div class="drawer-item">
                    <span class="drawer-label">Domaine</span>
                    <span class="drawer-value">${safeText(getValue(supervision.domaines?.name_domaine))}</span>
                </div>
                <div class="drawer-item">
                    <span class="drawer-label">Contenu</span>
                    <span class="drawer-value">${safeText(getValue(supervision.continues?.[0]?.name_contenu))}</span>
                </div>
                <div class="drawer-item">
                    <span class="drawer-label">Question PA</span>
                    <span class="drawer-value">${safeText(getValue(supervision.questions?.[0]?.name_question))}</span>
                </div>
                <div class="drawer-item">
                    <span class="drawer-label">Méthode</span>
                    <span class="drawer-value">${safeText(getValue(supervision.methodes?.[0]?.methode_name))}</span>
                </div>
                <div class="drawer-item">
                    <span class="drawer-label">Réponse Constat</span>
                    <span class="drawer-value">${safeText(getValue(supervision.reponse))}</span>
                </div>
                <div class="drawer-item">
                    <span class="drawer-label">Note Obtenue</span>
                    <span class="drawer-value">${safeText(getValue(supervision.note))}</span>
                </div>
                <div class="drawer-item">
                    <span class="drawer-label">Commentaires</span>
                    <span class="drawer-value">${safeText(getValue(supervision.commentaire))}</span>
                </div>
            </div>
        `;

        drawer.classList.add('open');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    // Fermer le drawer
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

    // Voir les détails d'une supervision
    function viewSupervision(id) {
        const row = document.querySelector(`tr[data-supervision]`);
        if (row) {
            try {
                const supervision = JSON.parse(row.getAttribute('data-supervision'));
                if (supervision.id === id) {
                    openDrawer(supervision);
                    return;
                }
            } catch (e) {
                console.error('Erreur parsing:', e);
            }
        }

        // Si on ne trouve pas la ligne, chercher dans toutes les lignes
        const allRows = document.querySelectorAll('tr[data-supervision]');
        for (const row of allRows) {
            try {
                const supervision = JSON.parse(row.getAttribute('data-supervision'));
                if (supervision.id === id) {
                    openDrawer(supervision);
                    return;
                }
            } catch (e) {
                continue;
            }
        }
    }

    // Supprimer une supervision
    function deleteSupervision(id) {
        if (!confirm('Voulez-vous vraiment supprimer cette supervision ?')) return;

        fetch(`${API_ENDPOINTS.SUPERVISIONS}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    NotificationManager.show('Supervision supprimée avec succès', 'success');
                    fetchSupervisions();
                } else {
                    NotificationManager.show(data.message || 'Erreur lors de la suppression', 'danger');
                }
            })
            .catch(error => {
                console.error('Erreur suppression:', error);
                NotificationManager.show('Erreur lors de la suppression', 'danger');
            });
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

            XLSX.utils.book_append_sheet(wb, ws, "Éléments de compétance");
            XLSX.writeFile(wb, `elements_competance_${new Date().toISOString().split('T')[0]}.xlsx`);

            NotificationManager.show('Export Excel réussi', 'success');
        } catch (error) {
            console.error('Erreur lors de l\'export Excel:', error);
            NotificationManager.show('Erreur lors de l\'export Excel', 'danger');
        }
    }

    // Tout sélectionner dans la table
    function toggleAllCheckboxes(source) {
        document.querySelectorAll('#table-body input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = source.checked;
        });
    }

    // Fonctions globales pour le loading
    window.showLoading = function() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            spinner.classList.remove('hidden');
            spinner.style.removeProperty('display');
        }
    };

    window.hideLoading = function() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            spinner.classList.add('hidden');
            spinner.style.setProperty('display', 'none', 'important');
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

    // Charger automatiquement au démarrage
    document.addEventListener('DOMContentLoaded', () => {
        fetchSupervisions();
    });
</script>

@endsection
