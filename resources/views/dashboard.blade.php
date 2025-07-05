@extends('layoutsapp.master')
@section('title', 'Dashboard')
@section('styles')
    <!-- Intégration de MDB CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet">
    <style>
        .logo-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.01) !important;
            /* Ombre plus légère par défaut */
        }

        .logo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1) !important;
            /* Ombre au survol plus légère également */
        }

        .logo-card .card-body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .logo-card img {
            max-height: 80px;
            width: auto;
            object-fit: contain;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-5">

        <!-- Première rangée de statistiques -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="text-muted mb-2">Etablissements Sanitaires</h5>
                                <h3 class="etablissement-count mb-0">
                                    <span class="stat-value">0</span>
                                    <span class="spinner-border spinner-border-sm text-primary stat-loading" role="status" style="display:inline-block;"></span>
                                </h3>
                            </div>
                            <div class="d-flex flex-column align-items-center ms-2">
                                <div class="icon-box bg-primary bg-opacity-10 mb-1">
                                    <i class="fas fa-hospital text-primary fs-5"></i>
                                </div>
                                <button class="btn mt-4 btn-link p-0 refresh-stat" data-target=".etablissement-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="text-muted mb-2">Supervisions Réalisées</h5>
                                <h3 class="supervision-count mb-0">
                                    <span class="stat-value">0</span>
                                    <span class="spinner-border spinner-border-sm text-warning stat-loading" role="status" style="display:inline-block;"></span>
                                </h3>
                            </div>
                            <div class="d-flex flex-column align-items-center ms-2">
                                <div class="icon-box bg-warning bg-opacity-10 mb-1">
                                    <i class="fas fa-tasks text-warning fs-5"></i>
                                </div>
                                <button class="btn mt-4 btn-link p-0 refresh-stat" data-target=".supervision-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="text-muted mb-2">Éléments de compétence</h5>
                                <h3 class="competance-count mb-0">
                                    <span class="stat-value">0</span>
                                    <span class="spinner-border spinner-border-sm text-success stat-loading" role="status" style="display:inline-block;"></span>
                                </h3>
                            </div>
                            <div class="d-flex flex-column align-items-center ms-2">
                                <div class="icon-box bg-success bg-opacity-10 mb-1">
                                    <i class="fas fa-brain text-success fs-5"></i>
                                </div>
                                <button class="btn mt-4 btn-link p-0 refresh-stat" data-target=".competance-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="text-muted mb-2">Éléments d'environnement</h5>
                                <h3 class="environnement-count mb-0">
                                    <span class="stat-value">0</span>
                                    <span class="spinner-border spinner-border-sm text-danger stat-loading" role="status" style="display:inline-block;"></span>
                                </h3>
                            </div>
                            <div class="d-flex flex-column align-items-center ms-2">
                                <div class="icon-box bg-danger bg-opacity-10 mb-1">
                                    <i class="fas fa-leaf text-danger fs-5"></i>
                                </div>
                                <button class="btn mt-4 btn-link p-0 refresh-stat" data-target=".environnement-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Deuxième rangée de statistiques -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="text-muted mb-2">Superviseurs</h5>
                                <h3 class="superviseur-count mb-0">
                                    <span class="stat-value">0</span>
                                    <span class="spinner-border spinner-border-sm text-danger stat-loading" role="status" style="display:inline-block;"></span>
                                </h3>
                            </div>
                            <div class="d-flex flex-column align-items-center ms-2">
                                <div class="icon-box bg-danger bg-opacity-10 mb-1">
                                    <i class="fas fa-user-tie text-danger fs-5"></i>
                                </div>
                                <button class="btn mt-4 btn-link p-0 refresh-stat" data-target=".superviseur-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="text-muted mb-2">Supervisés</h5>
                                <h3 class="superviser-count mb-0">
                                    <span class="stat-value">0</span>
                                    <span class="spinner-border spinner-border-sm text-success stat-loading" role="status" style="display:inline-block;"></span>
                                </h3>
                            </div>
                            <div class="d-flex flex-column align-items-center ms-2">
                                <div class="icon-box bg-success bg-opacity-10 mb-1">
                                    <i class="fas fa-users text-success fs-5"></i>
                                </div>
                                <button class="btn mt-4 btn-link p-0 refresh-stat" data-target=".superviser-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="text-muted mb-2">Problèmes prioritaires</h5>
                                <h3 class="probleme-count mb-0">
                                    <span class="stat-value">0</span>
                                    <span class="spinner-border spinner-border-sm text-warning stat-loading" role="status" style="display:inline-block;"></span>
                                </h3>
                            </div>
                            <div class="d-flex flex-column align-items-center ms-2">
                                <div class="icon-box bg-warning bg-opacity-10 mb-1">
                                    <i class="fas fa-exclamation-triangle text-warning fs-5"></i>
                                </div>
                                <button class="btn mt-4 btn-link p-0 refresh-stat" data-target=".probleme-count" title="Rafraîchir" style="display:none;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="row g-4">
            <div class="col-12 col-lg-6">
                <div class="card shadow border-0">
                    <div class="card-header border-0 bg-white">
                        <h5 class="card-title mb-0">Évolution des supervisions par mois</h5>
                    </div>
                    <div class="card-body position-relative">
                        <canvas id="barChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card shadow border-0">
                    <div class="card-header border-0 bg-white">
                        <h5 class="card-title mb-0">Répartition des supervisons sur la semaine</h5>
                    </div>
                    <div class="card-body position-relative">
                        <canvas id="pieChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">

        <!-- PNETHA -->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/pnethaT.png') }}" class="img-fluid" alt="Logo PNETHA">
                    </div>
                </div>
            </div>
            <!-- ARMOIRIE -->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/harT.png') }}" class="img-fluid" alt="Logo ARMOIRIE">
                    </div>
                </div>
            </div>

            <!-- PNEL 1er plan-->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/pnelT.png') }}" class="img-fluid" alt="Logo PNEL">
                    </div>
                </div>
            </div>
            <!-- PNEVG 1er plan-->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/pnevgT.png') }}" class="img-fluid" alt="Logo PNEVG">
                    </div>
                </div>
            </div>
            <!-- PNLMNCP 1er plan -->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/pnlmtncpT.png') }}" class="img-fluid" alt="Logo PNLMNCP">
                    </div>
                </div>
            </div>
            <!-- PNLUB 1er plan-->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/pnlubT.png') }}" class="img-fluid" alt="Logo PNLUB">
                    </div>
                </div>
            </div>
            <!-- PNETHA 1er plan -->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/PNETHA.jpeg') }}" class="img-fluid" alt="Logo PNETHA">
                    </div>
                </div>
            </div>
            <!-- INFAS 1er plan-->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/infas2.png') }}" class="img-fluid" alt="Logo FOLLEREAU">
                    </div>
                </div>
            </div>

            <!-- USAID 2e plan-->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/usaidT.png') }}" class="img-fluid" alt="Logo USAID">
                    </div>
                </div>
            </div>
            <!-- Anesvad 2e plan-->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/anesvadT.png') }}" class="img-fluid" alt="Logo Anesvad">
                    </div>
                </div>
            </div>
            <!-- Coptiment 2e plan-->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/coptimentT.png') }}" class="img-fluid" alt="Logo Coptiment">
                    </div>
                </div>
            </div>
            <!-- Hope Rises 2e plan-->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/hoperisesT.png') }}" class="img-fluid" alt="Logo Hope Rises">
                    </div>
                </div>
            </div>
            <!-- IRFCI -->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/irfciT.png') }}" class="img-fluid" alt="Logo IRFCI">
                    </div>
                </div>
            </div>
            <!-- FOLLEREAU -->
            <div class="col">
                <div class="card h-100 logo-card">
                    <div class="card-body">
                        <img src="{{ asset('images/follT.png') }}" class="img-fluid" alt="Logo FOLLEREAU">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- IMPORTANT: Importer jQuery AVANT tous les autres scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Intégration de MDB JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Script pour les particules
        function createParticles() {
            const container = document.getElementById('particlesContainer');
            if (!container) {
                // Créer le conteneur s'il n'existe pas
                const newContainer = document.createElement('div');
                newContainer.id = 'particlesContainer';
                newContainer.style.position = 'fixed';
                newContainer.style.top = '0';
                newContainer.style.left = '0';
                newContainer.style.width = '100%';
                newContainer.style.height = '100%';
                newContainer.style.pointerEvents = 'none';
                newContainer.style.zIndex = '0';
                document.body.appendChild(newContainer);

                const particleCount = 50;
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    const size = Math.random() * 5 + 1;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.position = 'absolute';
                    particle.style.backgroundColor = 'rgba(0, 123, 255, 0.2)';
                    particle.style.borderRadius = '50%';
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.top = `${Math.random() * 100}%`;
                    particle.style.opacity = '0.7';

                    // Animation personnalisée pour chaque particule
                    const randomX = Math.random() * 200 - 100;
                    const randomY = Math.random() * 200 - 100;
                    const duration = Math.random() * 20 + 10;

                    particle.animate([
                        { transform: 'translate(0, 0) rotate(0deg)', opacity: 0.7 },
                        { transform: `translate(${randomX}vw, ${randomY}vh) rotate(360deg)`, opacity: 0 }
                    ], {
                        duration: duration * 1000,
                        iterations: Infinity,
                        delay: Math.random() * 5000
                    });

                    newContainer.appendChild(particle);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', createParticles);

        // Fonction utilitaire pour afficher/masquer le loading sur une card
        function setCardLoading(selector, isLoading, value = null) {
            const card = $(selector).closest('.d-flex.align-items-center');
            if (isLoading) {
                card.find('.stat-loading').show();
                card.find('.stat-value').hide();
                card.find('.refresh-stat').hide();
            } else {
                card.find('.stat-loading').hide();
                card.find('.stat-value').show();
                card.find('.refresh-stat').show();
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
                error: function (xhr, status, error) {
                    setCardLoading('.etablissement-count', false, 'Erreur');
                    console.error('Erreur lors de la récupération des établissements:', error);
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
                error: function (xhr, status, error) {
                    setCardLoading('.supervision-count', false, 'Erreur');
                    console.error('Erreur lors de la récupération des supervisions:', error);
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
                error: function (xhr, status, error) {
                    setCardLoading('.competance-count', false, 'Erreur');
                    console.error('Erreur lors de la récupération des éléments de compétence:', error);
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
                error: function (xhr, status, error) {
                    setCardLoading('.environnement-count', false, 'Erreur');
                    console.error('Erreur lors de la récupération des éléments d\'environnement:', error);
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
                error: function (xhr, status, error) {
                    setCardLoading('.superviseur-count', false, 'Erreur');
                    console.error('Erreur lors de la récupération des superviseurs:', error);
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
                error: function (xhr, status, error) {
                    setCardLoading('.superviser-count', false, 'Erreur');
                    console.error('Erreur lors de la récupération des supervisés:', error);
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
                error: function (xhr, status, error) {
                    setCardLoading('.probleme-count', false, 'Erreur');
                    console.error('Erreur lors de la récupération des problèmes:', error);
                }
            });
        }

        // Appeler la fonction quand jQuery est prêt
        $(document).ready(function () {
            getDashboardStats();
            // Appels AJAX pour les charts sans gestion de loading
            $.ajax({
                url: '/api/dashboard/supervisions/stats-by-month',
                type: 'GET',
                success: function (response) {

                    console.log('chats charger::::', response)
                    if (response.success) {
                        const labels = Object.keys(response.data).map(function (mois) {
                            // Mettre la première lettre en majuscule
                            return mois.charAt(0).toUpperCase() + mois.slice(1);
                        });
                        const data = Object.values(response.data);
                        console.log(data.janvier)
                        const barCtx = document.getElementById('barChart').getContext('2d');
                        new Chart(barCtx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Nombre de supervisions',
                                    data: data,
                                    backgroundColor: '#3B82F6',
                                    borderColor: '#3B82F6',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    },
                                    title: {
                                        display: true,
                                        text: 'Évolution mensuelle des supervisions'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            drawBorder: false
                                        },
                                        title: {
                                            display: true,
                                            text: 'Nombre de supervisions'
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
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Erreur lors de la récupération des stats par mois:', error);
                }
            });
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
                                        '#4CAF50', '#FFA726', '#EF5350', '#3B82F6', '#FFD600', '#8E24AA', '#00ACC1'
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
                                        position: 'bottom',
                                        labels: {
                                            padding: 20
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Répartition des supervisions sur la semaine'
                                    }
                                }
                            }
                        });
                    }
                }
            });

            // Rafraîchissement individuel des cards
            $('.refresh-stat').on('click', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                // On relance uniquement la requête AJAX correspondante
                if (target === '.etablissement-count') {
                    setCardLoading(target, true);
                    $.ajax({
                        url: '/api/dashboard/etablissements/count',
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
                } else if (target === '.supervision-count') {
                    setCardLoading(target, true);
                    $.ajax({
                        url: '/api/dashboard/supervisions/count',
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
                } else if (target === '.competance-count') {
                    setCardLoading(target, true);
                    $.ajax({
                        url: '/api/dashboard/competance-elements/count',
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
                } else if (target === '.environnement-count') {
                    setCardLoading(target, true);
                    $.ajax({
                        url: '/api/dashboard/environnement-elements/count',
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
                } else if (target === '.superviseur-count') {
                    setCardLoading(target, true);
                    $.ajax({
                        url: '/api/dashboard/superviseurs/count',
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
                } else if (target === '.superviser-count') {
                    setCardLoading(target, true);
                    $.ajax({
                        url: '/api/dashboard/supervisers/count',
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
                } else if (target === '.probleme-count') {
                    setCardLoading(target, true);
                    $.ajax({
                        url: '/api/dashboard/problemes/count',
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
