@extends('layouts.master')
@section('title', 'Synthèse de la supervision Intégrée')

@section('content')
<style>
   
   .hidden {
       display: none;
   }

   .fade-in {
       animation: fadeIn 0.5s ease-in forwards;
   }

   .slide-up {
       animation: slideUp 0.5s ease-out forwards;
   }

   @keyframes fadeIn {
       from { opacity: 0; }
       to { opacity: 1; }
   }

   @keyframes slideUp {
       from {
           transform: translateY(50px);
           opacity: 0;
       }
       to {
           transform: translateY(0);
           opacity: 1;
       }
   }

   .supervision-card {
       background: white;
       border-radius: 5px;
       box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
       border: none;
       overflow: hidden;
   }

   .supervision-header {
       background: var(--primary-gradient);
       color: white;
       padding: 1.5rem;
   }

   .form-control, .form-select {
       border: 2px solid #e2e8f0;
       border-radius: 10px;
       padding: 0.75rem;
       transition: all 0.3s ease;
   }

   .form-control:focus {
       border-color: #e66a0a;
       box-shadow: 0 0 0 0.2rem rgba(230, 106, 10, 0.25);
   }

   .table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .table thead th {
        background: var(--secondary-gradient);
        color: white;
        border: none;
        /* padding: 1rem; */
    }

    .table tbody td {
        /* padding: 1rem; */
        border-bottom: 1px solid #e2e8f0;
    }

    .table tbody tr:hover {
        background: var(--hover-overlay);
    }
   /* Styles pour les cellules du tableau selon le pourcentage */
   .text-red {
       color: #dc3545 !important;
       font-weight: bold;
   }

   .text-orange {
       color: #fd7e14 !important;
       font-weight: bold;
   }

   .text-green {
       color: #28a745 !important;
       font-weight: bold;
   }

   .legend-item {
       padding: 1rem;
       border-radius: 4px;
       margin-bottom: 0.8rem;
   }

   .legend-red {
       background-color: rgba(220, 53, 69, 0.15);
       border-left: 4px solid #dc3545;
   }

   .legend-orange {
       background-color: rgba(253, 126, 20, 0.15);
       border-left: 4px solid #fd7e14;
   }

   .legend-green {
       background-color: rgba(40, 167, 69, 0.15);
       border-left: 4px solid #28a745;
   }

   .btn-primary {
       background: var(--primary-gradient);
       border: none;
       padding: 0.75rem 1.5rem;
       border-radius: 8px;
       transition: all 0.3s ease;
   }

   .btn-primary:hover {
       transform: translateY(-2px);
       box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
   }
</style>

<div class="mt-4">
   <!-- Section Tableau -->
   <div id="table-section" class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Synthèse de la supervision Intégrée</h2>
        <button type="button" class="btn btn-primary" onclick="showForm()">
            <i class="bi bi-plus-circle"></i> Ajouter une synthèse
        </button>
    </div>

    <div class="row">
        <!-- Tableau à gauche -->
        <div class="col-md-8 mb-4">
            <div class="supervision-card">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th style="width: 40%">Domaine</th>
                                <th style="width: 20%">Points disponibles</th>
                                <th style="width: 20%">Points obtenus</th>
                                <th style="width: 20%">%</th>
                            </tr>
                        </thead>
                        <tbody id="synthese-table">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Légende à droite -->
        <div class="col-md-4">
            <div class="supervision-card">
                <div class="card-body">
                    <h5 class="mb-3 text-center">Légende :</h5>
                    <div class="legend-item legend-red">
                        Rouge (0-40%) actions urgentes à conduire
                    </div>
                    <div class="legend-item legend-orange">
                        Orange (41-60%) actions requises
                    </div>
                    <div class="legend-item legend-green">
                        Vert (61-100%) poursuite des actions d'amélioration
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

   <!-- Section Formulaire -->
   <div id="form-section" class="hidden">
       <div class="supervision-card slide-up">
           <div class="supervision-header">
               <h4 class="mb-0 text-center">Ajouter une synthèse</h4>
           </div>

           <div class="card-body p-4">
               <form id="syntheseForm" onsubmit="handleSubmit(event)">
                   <div class="row">
                       <div class="col-md-6 mb-3">
                           <label class="form-label">Domaine</label>
                           <input type="text" class="form-control" name="domaine" required>
                       </div>

                       <div class="col-md-6 mb-3">
                           <label class="form-label">Points disponibles</label>
                           <input type="number" class="form-control" name="points_disponibles" value="4" readonly>
                       </div>

                       <div class="col-md-6 mb-3">
                           <label class="form-label">Points obtenus</label>
                           <input type="number" class="form-control" name="points_obtenus" min="0" max="4" step="0.5" required>
                       </div>
                   </div>

                   <div class="d-flex justify-content-end mt-4">
                       <button type="button" class="btn btn-secondary me-2" onclick="showTable()">
                           <i class="bi bi-x-circle"></i> Annuler
                       </button>
                       <button type="submit" class="btn btn-primary">
                           <i class="bi bi-save"></i> Enregistrer
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
   percentage = parseFloat(percentage);
   if (percentage <= 40) return 'text-red';
   if (percentage <= 60) return 'text-orange';
   return 'text-green';
}

function showForm() {
   document.getElementById('form-section').classList.remove('hidden');
   document.getElementById('table-section').classList.add('hidden');
}

function showTable() {
   document.getElementById('form-section').classList.add('hidden');
   document.getElementById('table-section').classList.remove('hidden');
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