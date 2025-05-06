@extends('layouts.master')

@section('title', 'Tableau de Bord')

@section('content')

<main class="p-4">
    <div class="pb-2 mb-3">
        <h1 class="h2">Tableau de bord</h1>
    </div>

    <!-- Première rangée de statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="text-muted mb-2">New Posts</h5>
                            <h3 class="mb-0">278</h3>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10">
                            <i class="fas fa-pencil text-primary fs-5"></i>
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
                            <h5 class="text-muted mb-2">New Comments</h5>
                            <h3 class="mb-0">156</h3>
                        </div>
                        <div class="icon-box bg-warning bg-opacity-10">
                            <i class="fas fa-comments text-warning fs-5"></i>
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
                            <h5 class="text-muted mb-2">Bounce Rate</h5>
                            <h3 class="mb-0">64.89%</h3>
                        </div>
                        <div class="icon-box bg-success bg-opacity-10">
                            <i class="fas fa-chart-line text-success fs-5"></i>
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
                            <h5 class="text-muted mb-2">Total Visits</h5>
                            <h3 class="mb-0">423</h3>
                        </div>
                        <div class="icon-box bg-danger bg-opacity-10">
                            <i class="fas fa-map-marker-alt text-danger fs-5"></i>
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
                            <h5 class="text-muted mb-2">New Projects</h5>
                            <h3 class="mb-0">278</h3>
                        </div>
                        <div class="icon-box bg-danger bg-opacity-10">
                            <i class="fas fa-rocket text-danger fs-5"></i>
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
                            <h5 class="text-muted mb-2">New Clients</h5>
                            <h3 class="mb-0">156</h3>
                        </div>
                        <div class="icon-box bg-success bg-opacity-10">
                            <i class="fas fa-users text-success fs-5"></i>
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
                            <h5 class="text-muted mb-2">Conversion Rate</h5>
                            <h3 class="mb-0">64.89%</h3>
                        </div>
                        <div class="icon-box bg-warning bg-opacity-10">
                            <i class="fas fa-book text-warning fs-5"></i>
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
                            <h5 class="text-muted mb-2">Support Tickets</h5>
                            <h3 class="mb-0">423</h3>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10">
                            <i class="fas fa-cogs text-primary fs-5"></i>
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
                    <h5 class="card-title mb-0">Histogramme des ventes</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow border-0">
                <div class="card-header border-0 bg-white">
                    <h5 class="card-title mb-0">Répartition des catégories</h5>
                </div>
                <div class="card-body">
                    <canvas id="pieChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    
</main>

@endsection