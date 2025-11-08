@extends('layoutsapp.master')
@section('title', 'Dashboard')
@section('styles')
    <style>
    :root {
        --card-border: #e2e8f0;
        --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        --card-hover: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    main {
        background-color: #FBFBFB !important;
        min-height: calc(100vh - 58px) !important;
    }

    .dashboard-container {
        padding: 32px 24px !important;
        max-width: 100% !important;
        margin: 0 auto !important;
    }

    /* Stat Cards */
    .stat-card {
        background: white !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 12px !important;
        padding: 24px !important;
        transition: all 0.2s ease !important;
        height: 100% !important;
        box-shadow: none !important;
    }

    .stat-card:hover {
        box-shadow: var(--card-hover) !important;
        transform: translateY(-2px) !important;
    }

    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        position: relative;
    }

    .stat-title {
        font-size: 14px;
        font-weight: 500;
        color: #64748b;
        margin: 0;
        text-align: center;
        flex: 1;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 60px);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        line-height: 1.2;
        text-align: center;
        width: 100%;
        display: block;
    }

    .etablissement-count,
    .supervision-count,
    .competance-count,
    .environnement-count,
    .superviseur-count,
    .superviser-count,
    .probleme-count {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .stat-loading {
            display: flex;
            align-items: center;
            justify-content: center;
        min-height: 40px;
    }

    .refresh-btn {
        background: none;
        border: none;
        color: #64748b;
        cursor: pointer;
        padding: 4px;
        border-radius: 6px;
        transition: all 0.2s ease;
        opacity: 0;
    }

    .stat-card:hover .refresh-btn {
        opacity: 1;
    }

    .refresh-btn:hover {
        background: #f1f5f9;
        color: #2563eb;
    }

    /* Chart Cards */
    .chart-card {
        background: white !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 12px !important;
        padding: 24px !important;
        height: 100% !important;
        box-shadow: none !important;
    }

    .chart-header {
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--card-border);
    }

    .chart-title {
        font-size: 18px;
        font-weight: 600;
        color: #0f172a;
        margin: 0;
    }

    .chart-container {
        position: relative;
        height: 300px;
    }

    .chart-loading {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.9);
        z-index: 10;
        border-radius: 8px;
    }

    .chart-loading[style*="display: none"],
    .chart-loading.hidden {
        display: none !important;
    }

    /* Logo Grid */
    .logo-section {
        margin-top: 48px !important;
    }

    .logo-section-title {
        font-size: 20px !important;
        font-weight: 600 !important;
        color: #0f172a !important;
        margin-bottom: 24px !important;
    }

    /* Grille de logos */
    .logo-section .row {
        margin: 0 !important;
    }

    .logo-section .col {
        padding: 0 !important;
    }

    .logo-card {
        background: white !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 12px !important;
        padding: 20px !important;
        height: 100% !important;
        min-height: 120px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.2s ease !important;
        box-shadow: none !important;
        overflow: hidden !important;
        position: relative !important;
        box-sizing: border-box !important;
    }

    .logo-card:hover {
        box-shadow: var(--card-hover) !important;
        transform: translateY(-2px) !important;
    }

    .logo-card img {
        max-width: calc(100% - 20px) !important;
        max-height: 80px !important;
        width: auto !important;
        height: auto !important;
        object-fit: contain !important;
        display: block !important;
        margin: 0 auto !important;
        padding: 0 !important;
        box-sizing: border-box !important;
    }

    /* Correction spécifique pour les images problématiques */
    .logo-card img[alt*="anesvad"],
    .logo-card img[alt*="Anesvad"],
    .logo-card img[src*="anesvad"] {
        max-width: calc(100% - 30px) !important;
        max-height: 70px !important;
        object-fit: contain !important;
    }

    .logo-card img[alt*="USAID"],
    .logo-card img[src*="usaid"] {
        max-width: calc(100% - 30px) !important;
        max-height: 70px !important;
        object-fit: contain !important;
    }

    /* Gestion des erreurs d'image */
    .logo-card img[src=""],
    .logo-card img:not([src]) {
        display: none !important;
    }

    /* Fallback pour images cassées */
    .logo-card img {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }

    /* Responsive pour les logos */
    @media (max-width: 768px) {
        .logo-card {
            min-height: 100px !important;
            padding: 16px !important;
        }

        .logo-card img {
            max-height: 60px !important;
        }
    }

    /* Colors */
    .icon-primary {
        background: rgba(37, 99, 235, 0.1);
        color: #2563eb;
    }

    .icon-warning {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .icon-success {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .icon-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 24px 16px;
        }

        .stat-value {
            font-size: 28px;
        }
        }
    </style>
@endsection

@section('content')
<div class="dashboard-container">
    <!-- Page Title -->
    <div class="mb-4">
        <h1 class="mb-2" style="font-size: 28px; font-weight: 700; color: #0f172a;">Dashboard</h1>
        <p class="text-muted mb-0">Vue d'ensemble de vos statistiques</p>
    </div>

    <!-- Statistiques - Première rangée -->
    <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-header">
                    <h6 class="stat-title">Établissements Sanitaires</h6>
                    <div class="stat-icon icon-primary">
                        <i class="fas fa-hospital"></i>
                    </div>
                </div>
                <h3 class="etablissement-count">
                                    <span class="stat-value">0</span>
                    <div class="stat-loading" style="display:none;">
                        @include('layoutsapp.partials.loading', ['size' => 'small', 'overlay' => false, 'id' => 'loading-etablissement'])
                    </div>
                                </h3>
                <button class="refresh-btn refresh-stat" data-target=".etablissement-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-header">
                    <h6 class="stat-title">Supervisions Réalisées</h6>
                    <div class="stat-icon icon-warning">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
                <h3 class="supervision-count">
                    <span class="stat-value">0</span>
                    <div class="stat-loading" style="display:none;">
                        @include('layoutsapp.partials.loading', ['size' => 'small', 'overlay' => false, 'id' => 'loading-supervision'])
            </div>
                                </h3>
                <button class="refresh-btn refresh-stat" data-target=".supervision-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-header">
                    <h6 class="stat-title">Éléments de compétence</h6>
                    <div class="stat-icon icon-success">
                        <i class="fas fa-brain"></i>
                    </div>
                </div>
                <h3 class="competance-count">
                    <span class="stat-value">0</span>
                    <div class="stat-loading" style="display:none;">
                        @include('layoutsapp.partials.loading', ['size' => 'small', 'overlay' => false, 'id' => 'loading-competance'])
            </div>
                                </h3>
                <button class="refresh-btn refresh-stat" data-target=".competance-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-header">
                    <h6 class="stat-title">Éléments d'environnement</h6>
                    <div class="stat-icon icon-danger">
                        <i class="fas fa-leaf"></i>
                    </div>
                </div>
                <h3 class="environnement-count">
                    <span class="stat-value">0</span>
                    <div class="stat-loading" style="display:none;">
                        @include('layoutsapp.partials.loading', ['size' => 'small', 'overlay' => false, 'id' => 'loading-environnement'])
            </div>
                                </h3>
                <button class="refresh-btn refresh-stat" data-target=".environnement-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
    </div>

    <!-- Statistiques - Deuxième rangée -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="stat-header">
                    <h6 class="stat-title">Superviseurs</h6>
                    <div class="stat-icon icon-danger">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
                <h3 class="superviseur-count">
                    <span class="stat-value">0</span>
                    <div class="stat-loading" style="display:none;">
                        @include('layoutsapp.partials.loading', ['size' => 'small', 'overlay' => false, 'id' => 'loading-superviseur'])
        </div>
                                </h3>
                <button class="refresh-btn refresh-stat" data-target=".superviseur-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="stat-header">
                    <h6 class="stat-title">Supervisés</h6>
                    <div class="stat-icon icon-success">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <h3 class="superviser-count">
                    <span class="stat-value">0</span>
                    <div class="stat-loading" style="display:none;">
                        @include('layoutsapp.partials.loading', ['size' => 'small', 'overlay' => false, 'id' => 'loading-superviser'])
            </div>
                                </h3>
                <button class="refresh-btn refresh-stat" data-target=".superviser-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="stat-header">
                    <h6 class="stat-title">Problèmes prioritaires</h6>
                    <div class="stat-icon icon-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
                <h3 class="probleme-count">
                    <span class="stat-value">0</span>
                    <div class="stat-loading" style="display:none;">
                        @include('layoutsapp.partials.loading', ['size' => 'small', 'overlay' => false, 'id' => 'loading-probleme'])
            </div>
                                </h3>
                <button class="refresh-btn refresh-stat" data-target=".probleme-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>

    <!-- Graphiques -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">Évolution des supervisions par mois</h5>
                </div>
                <div class="chart-container">
                    <div class="chart-loading" id="loading-barChart" style="display: none;">
                        @include('layoutsapp.partials.loading', ['size' => 'small', 'overlay' => false, 'id' => 'loading-barChart-spinner'])
                    </div>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

            <div class="col-12 col-lg-6">
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">Répartition des supervisions sur la semaine</h5>
                </div>
                <div class="chart-container">
                    <div class="chart-loading" id="loading-pieChart" style="display: none;">
                        @include('layoutsapp.partials.loading', ['size' => 'small', 'overlay' => false, 'id' => 'loading-pieChart-spinner'])
                    </div>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Logos Partenaires -->
    <div class="logo-section">
        <h3 class="logo-section-title">Partenaires</h3>
        <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-lg-4">
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/pnethaT.png') }}" alt="Logo PNETHA">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/harT.png') }}" alt="Logo ARMOIRIE">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/pnelT.png') }}" alt="Logo PNEL">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/pnevgT.png') }}" alt="Logo PNEVG">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/pnlmtncpT.png') }}" alt="Logo PNLMNCP">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/pnlubT.png') }}" alt="Logo PNLUB">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/PNETHA.jpeg') }}" alt="Logo PNETHA">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/infas2.png') }}" alt="Logo INFAS">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/usaidT.png') }}" alt="Logo USAID">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/anesvadT.png') }}" alt="Logo Anesvad">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/coptimentT.png') }}" alt="Logo Coptiment">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/hoperisesT.png') }}" alt="Logo Hope Rises">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/irfciT.png') }}" alt="Logo IRFCI">
                </div>
            </div>
            <div class="col">
                <div class="logo-card mx-3 mb-4">
                    <img src="{{ asset('images/follT.png') }}" alt="Logo FOLLEREAU">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    function setCardLoading(selector, isLoading, value = null) {
        const card = $(selector).closest('.stat-card');
        const loadingContainer = card.find('.stat-loading');
        const loadingSpinner = loadingContainer.find('.loading-container');
        
        if (isLoading) {
            // Afficher le conteneur de loading
            loadingContainer.show();
            // Afficher le spinner en retirant la classe hidden et le style display
            if (loadingSpinner.length) {
                loadingSpinner.removeClass('hidden');
                loadingSpinner.css('display', 'flex');
            }
                card.find('.stat-value').hide();
            card.find('.refresh-btn').hide();
            } else {
            // Masquer le conteneur de loading
            loadingContainer.hide();
            // Masquer le spinner
            if (loadingSpinner.length) {
                loadingSpinner.addClass('hidden');
                loadingSpinner.css('display', 'none');
            }
                card.find('.stat-value').show();
            card.find('.refresh-btn').show();
                if (value !== null) {
                    card.find('.stat-value').text(value);
                }
            }
        }

        function getDashboardStats() {
            // Etablissements
            setCardLoading('.etablissement-count', true);
            $.ajax({
                url: '/api/dashboard/etablissements/count',
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        setCardLoading('.etablissement-count', false, response.data);
                    }
                },
            error: function () {
                    setCardLoading('.etablissement-count', false, 'Erreur');
                }
            });

            // Supervisions
            setCardLoading('.supervision-count', true);
            $.ajax({
                url: '/api/dashboard/supervisions/count',
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        setCardLoading('.supervision-count', false, response.data);
                    }
                },
            error: function () {
                    setCardLoading('.supervision-count', false, 'Erreur');
                }
            });

            // Compétence
            setCardLoading('.competance-count', true);
            $.ajax({
                url: '/api/dashboard/competance-elements/count',
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        setCardLoading('.competance-count', false, response.data);
                    }
                },
            error: function () {
                    setCardLoading('.competance-count', false, 'Erreur');
                }
            });

            // Environnement
            setCardLoading('.environnement-count', true);
            $.ajax({
                url: '/api/dashboard/environnement-elements/count',
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        setCardLoading('.environnement-count', false, response.data);
                    }
                },
            error: function () {
                    setCardLoading('.environnement-count', false, 'Erreur');
                }
            });

            // Superviseurs
            setCardLoading('.superviseur-count', true);
            $.ajax({
                url: '/api/dashboard/superviseurs/count',
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        setCardLoading('.superviseur-count', false, response.data);
                    }
                },
            error: function () {
                    setCardLoading('.superviseur-count', false, 'Erreur');
                }
            });

            // Supervisés
            setCardLoading('.superviser-count', true);
            $.ajax({
                url: '/api/dashboard/supervisers/count',
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        setCardLoading('.superviser-count', false, response.data);
                    }
                },
            error: function () {
                    setCardLoading('.superviser-count', false, 'Erreur');
                }
            });

            // Problèmes prioritaires
            setCardLoading('.probleme-count', true);
            $.ajax({
                url: '/api/dashboard/problemes/count',
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        setCardLoading('.probleme-count', false, response.data);
                    }
                },
            error: function () {
                    setCardLoading('.probleme-count', false, 'Erreur');
                }
            });
        }

        $(document).ready(function () {
            getDashboardStats();

        // Fonction pour gérer le loading des graphiques
        function setChartLoading(chartId, isLoading) {
            const loadingElement = document.getElementById(`loading-${chartId}`);
            const canvasElement = document.getElementById(chartId);
            
            if (isLoading) {
                if (loadingElement) {
                    loadingElement.style.display = 'flex';
                    loadingElement.classList.remove('hidden');
                }
                if (canvasElement) {
                    canvasElement.style.opacity = '0.3';
                }
            } else {
                if (loadingElement) {
                    loadingElement.style.display = 'none';
                    loadingElement.classList.add('hidden');
                }
                if (canvasElement) {
                    canvasElement.style.opacity = '1';
                }
            }
        }

        // Graphique en barres
        setChartLoading('barChart', true);
            $.ajax({
                url: '/api/dashboard/supervisions/stats-by-month',
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        const labels = Object.keys(response.data).map(function (mois) {
                            return mois.charAt(0).toUpperCase() + mois.slice(1);
                        });
                        const data = Object.values(response.data);
                        const barCtx = document.getElementById('barChart').getContext('2d');
                        new Chart(barCtx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Nombre de supervisions',
                                    data: data,
                                backgroundColor: '#2563eb',
                                borderColor: '#2563eb',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                    display: false
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                        color: '#e2e8f0'
                                        }
                                    },
                                    x: {
                                        grid: {
                                            display: false
                                        }
                                    }
                                }
                            }
                        });
                        setChartLoading('barChart', false);
                    } else {
                        setChartLoading('barChart', false);
                    }
                },
                error: function () {
                    setChartLoading('barChart', false);
                }
            });

        // Graphique en camembert
        setChartLoading('pieChart', true);
            $.ajax({
                url: '/api/dashboard/supervisions/stats-current-week-by-day',
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        const labels = Object.keys(response.data).map(function (jour) {
                            return jour.charAt(0).toUpperCase() + jour.slice(1);
                        });
                        const data = Object.values(response.data);
                        const pieCtx = document.getElementById('pieChart').getContext('2d');
                        new Chart(pieCtx, {
                            type: 'pie',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: data,
                                    backgroundColor: [
                                    '#2563eb', '#f59e0b', '#ef4444', '#10b981', 
                                    '#8b5cf6', '#ec4899', '#06b6d4'
                                    ],
                                    borderColor: '#fff',
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                    position: 'bottom'
                                    }
                                }
                            }
                        });
                        setChartLoading('pieChart', false);
                    } else {
                        setChartLoading('pieChart', false);
                    }
                },
                error: function () {
                    setChartLoading('pieChart', false);
                }
            });

        // Rafraîchissement individuel
            $('.refresh-stat').on('click', function(e) {
                e.preventDefault();
            const target = $(this).data('target');
            const endpoints = {
                '.etablissement-count': '/api/dashboard/etablissements/count',
                '.supervision-count': '/api/dashboard/supervisions/count',
                '.competance-count': '/api/dashboard/competance-elements/count',
                '.environnement-count': '/api/dashboard/environnement-elements/count',
                '.superviseur-count': '/api/dashboard/superviseurs/count',
                '.superviser-count': '/api/dashboard/supervisers/count',
                '.probleme-count': '/api/dashboard/problemes/count'
            };

            if (endpoints[target]) {
                    setCardLoading(target, true);
                    $.ajax({
                    url: endpoints[target],
                        type: 'GET',
                        success: function (response) {
                            if (response.success) {
                                setCardLoading(target, false, response.data);
                            }
                        },
                        error: function () {
                            setCardLoading(target, false, 'Erreur');
                        }
                    });
                }
            });
        });
    </script>
@endsection
