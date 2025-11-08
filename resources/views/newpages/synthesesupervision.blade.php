@extends('layoutsapp.master')
@section('title', 'Synthèse de la supervision Intégrée')

@section('styles')
<style>
    :root {
        --card-border: #e2e8f0;
        --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        --card-hover: 0 4px 6px rgba(0, 0, 0, 0.1);
        --primary-color: #2563eb;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        /* Couleurs spécifiques pour les indicateurs - À CONSERVER */
        --color-danger: #ef4444; /* Rouge pour 0-40% */
        --color-warning: #f59e0b; /* Orange pour 41-60% */
        --color-success: #10b981; /* Vert pour 61-100% */
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
        vertical-align: middle !important;
    }

    .table tbody tr:hover {
        background: #f8fafc !important;
    }

    .table tbody tr:last-child td {
        border-bottom: none !important;
    }

    #total-row {
        border-top: 2px solid var(--card-border) !important;
        background: #f8fafc !important;
    }

    #total-row td {
        font-weight: 700 !important;
        font-size: 15px !important;
    }

    /* Buttons */
    .btn-primary {
        background: var(--primary-color) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 10px 20px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
    }

    .btn-primary:hover {
        background: #1d4ed8 !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2) !important;
    }

    .btn-outline-success {
        border: 1px solid #10b981 !important;
        color: #10b981 !important;
        border-radius: 8px !important;
        padding: 10px 20px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
    }

    .btn-outline-success:hover {
        background: #10b981 !important;
        color: white !important;
    }

    /* Legend Card */
    .legend-card {
        background: white !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 12px !important;
        padding: 24px !important;
        box-shadow: none !important;
        height: 100%;
    }

    .legend-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 20px;
        text-align: center;
    }

    .legend-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .legend-item {
        padding: 12px 16px;
        margin-bottom: 8px;
        border-radius: 8px;
        border: 1px solid var(--card-border);
        background: white;
        display: flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    .legend-item:hover {
        background: #f8fafc;
        transform: translateX(4px);
    }

    .legend-item i {
        margin-right: 12px;
        font-size: 16px;
    }

    /* Couleurs des icônes dans la légende - À CONSERVER */
    .legend-item.text-danger i {
        color: #ef4444 !important;
    }

    .legend-item.text-warning i {
        color: #f59e0b !important;
    }

    .legend-item.text-success i {
        color: #10b981 !important;
    }

    .legend-item.text-danger {
        color: #ef4444 !important;
    }

    .legend-item.text-warning {
        color: #f59e0b !important;
    }

    .legend-item.text-success {
        color: #10b981 !important;
    }

    /* Couleurs spécifiques pour les indicateurs du tableau - À CONSERVER */
    .table tbody .text-danger {
        color: #ef4444 !important;
    }

    .table tbody .text-warning {
        color: #f59e0b !important;
    }

    .table tbody .text-success {
        color: #10b981 !important;
    }

    #total-row .text-danger {
        color: #ef4444 !important;
    }

    #total-row .text-warning {
        color: #f59e0b !important;
    }

    #total-row .text-success {
        color: #10b981 !important;
    }

    .legend-text {
        font-size: 14px;
        color: var(--text-primary);
        font-weight: 500;
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

    /* Couleurs des badges dans les cartes mobiles - À CONSERVER */
    .mobile-card-badge.bg-danger {
        background-color: #ef4444 !important;
    }

    .mobile-card-badge.bg-warning {
        background-color: #f59e0b !important;
    }

    .mobile-card-badge.bg-success {
        background-color: #10b981 !important;
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
        z-index: 1;
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
        }

        .content-card {
            padding: 16px !important;
            border-radius: 8px !important;
        }

        .legend-card {
            margin-top: 24px;
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

        .legend-card {
            padding: 12px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="page-container">
    <!-- Loading Spinner -->
    @include('layoutsapp.partials.loading', ['size' => 'medium', 'overlay' => true])

    <div id="table-section">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div style="width: 100%;">
                    <h1 class="page-title">Synthèse de la supervision Intégrée</h1>
                    <p class="page-subtitle">Aperçu de la vue de Synthèse de la supervision Intégrée</p>
                </div>
                <div class="header-actions">
                    <button type="button" class="btn btn-outline-success" onclick="exportToExcel()">
                        <i class="fas fa-file-excel me-2"></i><span class="d-none d-md-inline">Exporter Excel</span><span class="d-md-none">Excel</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <!-- Tableau à gauche -->
            <div class="col-12 col-lg-8">
                <div class="content-card">
                    <!-- Desktop Table View -->
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Domaine</th>
                                    <th class="text-center">Points disponibles</th>
                                    <th class="text-center">Points obtenus</th>
                                    <th class="text-center">%</th>
                                </tr>
                            </thead>
                            <tbody id="synthese-table">
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <div class="d-flex align-items-center justify-content-center" style="min-height: 200px;">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Chargement...</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards View -->
                    <div class="mobile-cards" id="mobile-cards">
                        <!-- Les cartes mobiles seront ajoutées ici -->
                    </div>
                </div>
            </div>

            <!-- Légende à droite -->
            <div class="col-12 col-lg-4">
                <div class="legend-card">
                    <h5 class="legend-title">Légende</h5>
                    <ul class="legend-list">
                        <li class="legend-item text-danger">
                            <i class="fas fa-square"></i>
                            <span class="legend-text">Rouge (0-40%) - Actions urgentes à conduire</span>
                        </li>
                        <li class="legend-item text-warning">
                            <i class="fas fa-square"></i>
                            <span class="legend-text">Orange (41-60%) - Actions requises</span>
                        </li>
                        <li class="legend-item text-success">
                            <i class="fas fa-square"></i>
                            <span class="legend-text">Vert (61-100%) - Poursuite des actions d'amélioration</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;"></div>

    <!-- Drawer pour les détails -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
    <div class="drawer" id="detailDrawer">
        <div class="drawer-header">
            <h2 class="drawer-title">Détails du domaine</h2>
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
    function getTextColorClass(percentage) {
        const percent = parseFloat(percentage);
        if (percent <= 40) return 'text-danger';
        if (percent <= 60) return 'text-warning';
        return 'text-success';
    }

    function showAlert(message, type) {
        const toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) return;

        const toast = document.createElement('div');
        toast.className = `toast show align-items-center text-white bg-${type} border-0`;
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;
        toastContainer.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    async function loadSyntheseData() {
        try {
            // Afficher le loading
            if (typeof window.showLoadingWithTimeout === 'function') {
                window.showLoadingWithTimeout();
            }

            const response = await fetch('/api/supervision/synthese');
            const data = await response.json();

            if (data.success) {
                const tbody = document.getElementById('synthese-table');
                const mobileCards = document.getElementById('mobile-cards');
                tbody.innerHTML = '';
                if (mobileCards) mobileCards.innerHTML = '';

                // Afficher les lignes de données
                data.synthese.forEach(item => {
                    if (item.domaine !== 'TOTAL') {
                        const colorClass = getTextColorClass(item.percentage);
                        // Ligne du tableau desktop
                        const row = document.createElement('tr');
                        row.style.cursor = 'pointer';
                        row.onclick = () => openDrawer(item);
                        row.innerHTML = `
                            <td class="${colorClass}">${item.domaine}</td>
                            <td class="text-center ${colorClass}">${item.points_disponibles}</td>
                            <td class="text-center ${colorClass}">${item.points_obtenus}</td>
                            <td class="text-center ${colorClass}">${item.percentage}%</td>
                        `;
                        tbody.appendChild(row);

                        // Carte mobile
                        if (mobileCards) {
                            addMobileCard(item, colorClass);
                        }
                    }
                });

                // Ajouter la ligne du total
                const totalData = data.synthese.find(item => item.domaine === 'TOTAL');
                if (totalData) {
                    const totalColorClass = getTextColorClass(totalData.percentage);
                    // Ligne du tableau desktop
                    const totalRow = document.createElement('tr');
                    totalRow.id = 'total-row';
                    totalRow.innerHTML = `
                        <td class="fw-bold ${totalColorClass}">TOTAL</td>
                        <td class="text-center fw-bold ${totalColorClass}">${totalData.points_disponibles}</td>
                        <td class="text-center fw-bold ${totalColorClass}">${totalData.points_obtenus}</td>
                        <td class="text-center fw-bold ${totalColorClass}">${totalData.percentage}%</td>
                    `;
                    tbody.appendChild(totalRow);

                    // Carte mobile pour le total
                    if (mobileCards) {
                        addMobileCard(totalData, totalColorClass, true);
                    }
                }

                showAlert('Données chargées avec succès', 'success');
            } else {
                console.error('Erreur lors du chargement des données');
                showAlert('Erreur lors du chargement des données', 'danger');
            }
        } catch (error) {
            console.error('Erreur:', error);
            showAlert('Erreur lors du chargement des données', 'danger');
        } finally {
            // Masquer le loading
            if (typeof window.hideLoadingWithTimeout === 'function') {
                window.hideLoadingWithTimeout();
            } else if (typeof window.hideLoading === 'function') {
                window.hideLoading();
            }
        }
    }

    // Fonction pour l'export Excel
    function exportToExcel() {
        showAlert('Fonctionnalité d\'export Excel à implémenter', 'warning');
    }

    // Fonctions pour gérer le loading spinner
    window.showLoading = function() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            spinner.classList.remove('hidden');
            spinner.style.removeProperty('display');
            const segments = spinner.querySelectorAll('.spinner-segment');
            segments.forEach((segment, index) => {
                segment.style.animation = `spinner-segment-fade 1.2s cubic-bezier(0.4, 0, 0.2, 1) infinite`;
                segment.style.animationDelay = `${index * 0.033}s`;
            });
        }
    };

    window.hideLoading = function() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            const segments = spinner.querySelectorAll('.spinner-segment');
            segments.forEach(segment => {
                segment.style.animation = 'none';
            });
            spinner.classList.add('hidden');
            spinner.style.setProperty('display', 'none', 'important');
        }
    };

    let loadingTimeout;
    window.showLoadingWithTimeout = function() {
        window.showLoading();
        if (loadingTimeout) {
            clearTimeout(loadingTimeout);
        }
        loadingTimeout = setTimeout(() => {
            window.hideLoading();
        }, 10000);
    };

    window.hideLoadingWithTimeout = function() {
        if (loadingTimeout) {
            clearTimeout(loadingTimeout);
            loadingTimeout = null;
        }
        window.hideLoading();
    };

    // Fonction pour ajouter une carte mobile
    function addMobileCard(item, colorClass, isTotal = false) {
        const mobileCards = document.getElementById('mobile-cards');
        if (!mobileCards) return;

        const card = document.createElement('div');
        card.className = 'mobile-card';
        card.onclick = () => openDrawer(item);

        const badgeClass = colorClass === 'text-danger' ? 'bg-danger' : 
                          colorClass === 'text-warning' ? 'bg-warning' : 'bg-success';

        card.innerHTML = `
            <div class="mobile-card-header">
                <h3 class="mobile-card-title ${colorClass}">${item.domaine}</h3>
                <span class="mobile-card-badge ${badgeClass} text-white">${item.percentage}%</span>
            </div>
            <div class="mobile-card-content">
                <div class="mobile-card-item">
                    <span class="mobile-card-label">Points disponibles</span>
                    <span class="mobile-card-value ${colorClass}">${item.points_disponibles}</span>
                </div>
                <div class="mobile-card-item">
                    <span class="mobile-card-label">Points obtenus</span>
                    <span class="mobile-card-value ${colorClass}">${item.points_obtenus}</span>
                </div>
                <div class="mobile-card-item">
                    <span class="mobile-card-label">Pourcentage</span>
                    <span class="mobile-card-value ${colorClass}" style="font-weight: 700; font-size: 16px;">${item.percentage}%</span>
                </div>
            </div>
        `;
        mobileCards.appendChild(card);
    }

    // Fonction pour ouvrir le drawer avec les détails
    function openDrawer(item) {
        const drawer = document.getElementById('detailDrawer');
        const overlay = document.getElementById('drawerOverlay');
        const drawerBody = document.getElementById('drawerBody');

        if (!drawer || !overlay || !drawerBody) return;

        const colorClass = getTextColorClass(item.percentage);
        const statusText = item.percentage <= 40 ? 'Actions urgentes à conduire' :
                          item.percentage <= 60 ? 'Actions requises' :
                          'Poursuite des actions d\'amélioration';

        drawerBody.innerHTML = `
            <div class="drawer-section">
                <h3 class="drawer-section-title ${colorClass}">${item.domaine}</h3>
                <div class="drawer-item">
                    <span class="drawer-label">Statut</span>
                    <span class="drawer-value ${colorClass}" style="font-weight: 600;">${statusText}</span>
                </div>
            </div>

            <div class="drawer-section">
                <h3 class="drawer-section-title">Points</h3>
                <div class="drawer-item">
                    <span class="drawer-label">Points disponibles</span>
                    <span class="drawer-value ${colorClass}" style="font-weight: 600; font-size: 18px;">${item.points_disponibles}</span>
                </div>
                <div class="drawer-item">
                    <span class="drawer-label">Points obtenus</span>
                    <span class="drawer-value ${colorClass}" style="font-weight: 600; font-size: 18px;">${item.points_obtenus}</span>
                </div>
            </div>

            <div class="drawer-section">
                <h3 class="drawer-section-title">Performance</h3>
                <div class="drawer-item">
                    <span class="drawer-label">Pourcentage</span>
                    <span class="drawer-value ${colorClass}" style="font-weight: 700; font-size: 24px;">${item.percentage}%</span>
                </div>
            </div>
        `;

        drawer.classList.add('open');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    // Fonction pour fermer le drawer
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

    // Charger les données au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        // Afficher le spinner au chargement initial
        window.showLoadingWithTimeout();
        
        // Charger les données
        loadSyntheseData();
    });
</script>
@endsection
