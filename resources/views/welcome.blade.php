@extends('layoutsapp.master')

@section('title', 'Dashboard')

@section('content')
<style>
    .card {
    box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important; /* Ombre très légère */
}


   
</style>
<section>
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="align-self-center">
                            <i class="fas fa-pencil-alt text-info fa-3x"></i>
                        </div>
                        <div class="text-end">
                            <h3>278</h3>
                            <p class="mb-0">New Posts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="align-self-center">
                            <i class="far fa-comment-alt text-warning fa-3x"></i>
                        </div>
                        <div class="text-end">
                            <h3>156</h3>
                            <p class="mb-0">New Comments</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="align-self-center">
                            <i class="fas fa-chart-line text-success fa-3x"></i>
                        </div>
                        <div class="text-end">
                            <h3>64.89 %</h3>
                            <p class="mb-0">Bounce Rate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="align-self-center">
                            <i class="fas fa-map-marker-alt text-danger fa-3x"></i>
                        </div>
                        <div class="text-end">
                            <h3>423</h3>
                            <p class="mb-0">Total Visits</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div>
                            <h3 class="text-danger">278</h3>
                            <p class="mb-0">New Projects</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-rocket text-danger fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div>
                            <h3 class="text-success">156</h3>
                            <p class="mb-0">New Clients</p>
                        </div>
                        <div class="align-self-center">
                            <i class="far fa-user text-success fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div>
                            <h3 class="text-warning">64.89 %</h3>
                            <p class="mb-0">Conversion Rate</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-chart-pie text-warning fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div>
                            <h3 class="text-info">423</h3>
                            <p class="mb-0">Support Tickets</p>
                        </div>
                        <div class="align-self-center">
                            <i class="far fa-life-ring text-info fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Graphiques -->
<div class="row g-4">
    <div class="col-12 col-lg-6">
        <div class="card border-0">
            <div class="card-header border-0 bg-white">
                <!-- <h5 class="card-title mb-0">Histogramme des ventes</h5> -->
            </div>
            <div class="card-body">
                <canvas id="barChart" height="300"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card border-0">
            <div class="card-header border-0 bg-white">
                <!-- <h5 class="card-title mb-0">Répartition des catégories</h5> -->
            </div>
            <div class="card-body">
                <canvas id="pieChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection