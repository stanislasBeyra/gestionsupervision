@extends('layoutsapp.master')
@section('title', 'Synthèse de la supervision Intégrée')

@section('content')
<style>
    .card {
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
    }
    #total-row {
        border-top: 2px solid #dee2e6;
    }
</style>

<div id="table-section">
    <div class="row mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">Synthèse de la supervision Intégrée</h2>
                <p class="text-muted mb-0">Aperçu de la vue de Synthèse de la supervision Intégrée</p>
            </div>
            <div>
                <button type="button" class="btn btn-outline-success" onclick="exportToExcel()">
                    <i class="bi bi-file-excel me-2"></i>Exporter en Excel
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tableau à gauche -->
        <div class="col-md-8 mb-4">
            <div class="card">
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

<script>
function getTextColorClass(percentage) {
    const percent = parseFloat(percentage);
    if (percent <= 40) return 'text-danger';
    if (percent <= 60) return 'text-warning';
    return 'text-success';
}

async function loadSyntheseData() {
    try {
        const response = await fetch('api/supervision/synthese');
        const data = await response.json();

        if (data.success) {
            const tbody = document.getElementById('synthese-table');
            tbody.innerHTML = '';

            // Afficher les lignes de données
            data.synthese.forEach(item => {
                if (item.domaine !== 'TOTAL') {
                    const colorClass = getTextColorClass(item.percentage);
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="${colorClass}">${item.domaine}</td>
                        <td class="text-center ${colorClass}">${item.points_disponibles}</td>
                        <td class="text-center ${colorClass}">${item.points_obtenus}</td>
                        <td class="text-center ${colorClass}">${item.percentage}%</td>
                    `;
                    tbody.appendChild(row);
                }
            });

            // Ajouter la ligne du total
            const totalData = data.synthese.find(item => item.domaine === 'TOTAL');
            if (totalData) {
                const totalRow = document.createElement('tr');
                totalRow.id = 'total-row';
                const totalColorClass = getTextColorClass(totalData.percentage);
                totalRow.innerHTML = `
                    <td class="fw-bold ${totalColorClass}">TOTAL</td>
                    <td class="text-center fw-bold ${totalColorClass}">${totalData.points_disponibles}</td>
                    <td class="text-center fw-bold ${totalColorClass}">${totalData.points_obtenus}</td>
                    <td class="text-center fw-bold ${totalColorClass}">${totalData.percentage}%</td>
                `;
                tbody.appendChild(totalRow);
            }
        } else {
            console.error('Erreur lors du chargement des données');
        }
    } catch (error) {
        console.error('Erreur:', error);
    }
}

// Fonction pour l'export Excel
function exportToExcel() {
    // Implémentez ici la logique d'export Excel si nécessaire
    alert('Fonctionnalité d\'export Excel en cours de développement');
}

// Charger les données au chargement de la page
document.addEventListener('DOMContentLoaded', loadSyntheseData);
</script>

@endsection