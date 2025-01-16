@extends('layoutsapp.master')
@section('title', 'Synthèse de la supervision Intégrée')

@section('content')

<style>
    .card {
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
    }
</style>


<section class="mb-4">
    
</section>

<div class="container my-5">
    <!-- Section Tableau -->
    <div id="table-section">
       

        <div class="row">
            <!-- Tableau à gauche -->
            <div class="col-md-8 mb-4">
            <div class="card ">
        <div class="card-header text-center py-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-primary">Synthèse de la supervision Intégrée</h4>
                <button type="button" class="btn btn-primary" onclick="showForm()">
                    <i class="fas fa-plus-circle"></i> Ajouter une synthèse
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">

                    <thead class="text-white bg-primary">
                        <tr>
                            <th scope="col">Domaine</th>
                            <th scope="col">Points disponibles</th>
                            <th scope="col">Points obtenus</th>
                            <th scope="col">%</th>
                        </tr>
                    </thead>
                    <tbody id="synthese-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
            </div>

            <!-- Légende à droite -->
            <div class="col-md-4">
                <div class="card shadow-3">
                    <div class="card-body">
                        <h5 class="text-center text-primary">Légende :</h5>
                        <ul class="list-group">
                            <li class="list-group-item text-danger">
                                <i class="fas fa-square text-danger me-2"></i> Rouge (0-40%) actions urgentes à conduire
                            </li>
                            <li class="list-group-item text-warning">
                                <i class="fas fa-square text-warning me-2"></i> Orange (41-60%) actions requises
                            </li>
                            <li class="list-group-item text-success">
                                <i class="fas fa-square text-success me-2"></i> Vert (61-100%) poursuite des actions d'amélioration
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="d-none">
        <div class="card shadow-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Ajouter une synthèse</h5>
            </div>
            <div class="card-body">
                <form id="syntheseForm" onsubmit="handleSubmit(event)">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="domaine" class="form-label">Domaine</label>
                            <input type="text" id="domaine" name="domaine" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="points_disponibles" class="form-label">Points disponibles</label>
                            <input type="number" id="points_disponibles" name="points_disponibles" class="form-control" value="4" readonly>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="points_obtenus" class="form-label">Points obtenus</label>
                            <input type="number" id="points_obtenus" name="points_obtenus" class="form-control" min="0" max="4" step="0.5" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" onclick="showTable()">
                            <i class="fas fa-times-circle"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function calculatePercentage(points_obtenus) {
        return ((points_obtenus / 4) * 100).toFixed(2);
    }

    function getTextColorClass(percentage) {
        if (percentage <= 40) return 'text-danger';
        if (percentage <= 60) return 'text-warning';
        return 'text-success';
    }

    function showForm() {
        document.getElementById('form-section').classList.remove('d-none');
        document.getElementById('table-section').classList.add('d-none');
    }

    function showTable() {
        document.getElementById('form-section').classList.add('d-none');
        document.getElementById('table-section').classList.remove('d-none');
        document.getElementById('syntheseForm').reset();
    }

    function handleSubmit(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const points_obtenus = formData.get('points_obtenus');
        const percentage = calculatePercentage(points_obtenus);
        const colorClass = getTextColorClass(percentage);

        const tbody = document.getElementById('synthese-table');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td class="${colorClass}">${formData.get('domaine')}</td>
        <td class="text-center ${colorClass}">${formData.get('points_disponibles')}</td>
        <td class="text-center ${colorClass}">${points_obtenus}</td>
        <td class="text-center ${colorClass}">${percentage}%</td>
    `;

        tbody.appendChild(newRow);
        showTable();
    }
</script>

@endsection