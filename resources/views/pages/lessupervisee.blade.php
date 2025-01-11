@extends('layouts.master')
@section('title', 'Identification des supervisés')

@section('content')
<style>
    /* :root {
        --primary-gradient: linear-gradient(45deg, #e66a0a 0%, #17a204 100%);
        --secondary-gradient: linear-gradient(45deg, #4a5568 0%, #2d3748 100%);
        --warning-gradient: linear-gradient(45deg, #ed8936 0%, #dd6b20 100%);
        --success-gradient: linear-gradient(45deg, #48bb78 0%, #2f855a 100%);
        --hover-overlay: rgba(255, 255, 255, 0.1);
    } */

    :root {
        --primary-gradient: linear-gradient(45deg, #2962ff 0%, #1976d2 100%);
        --secondary-gradient: linear-gradient(45deg, #4a5568 0%, #2d3748 100%);
        --warning-gradient: linear-gradient(45deg, #ed8936 0%, #dd6b20 100%);
        --success-gradient: linear-gradient(45deg, #48bb78 0%, #2f855a 100%);
        --hover-overlay: rgba(255, 255, 255, 0.1);
    }

    .hidden {
        display: none;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in forwards;
    }

    .fade-out {
        animation: fadeOut 0.3s ease-out forwards;
    }

    .slide-up {
        animation: slideUp 0.5s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
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

    .btn-primary {
        background: var(--primary-gradient);
        border: none;
    }

    .btn-secondary {
        background: var(--secondary-gradient);
        border: none;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .supervision-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
    }

    .supervision-header {
        background: var(--primary-gradient);
        color: white;
        padding: 1.5rem;
    }

    .table thead th {
        background: var(--secondary-gradient);
        color: white;
        border: none;
        padding: 1rem;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .form-control,
    .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #e66a0a;
        box-shadow: 0 0 0 0.2rem rgba(230, 106, 10, 0.25);
    }
</style>

<div class="container-fluid mt-4">
    <!-- Section Tableau -->
    <div id="table-section" class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Liste des supervisés</h2>
            <button type="button" class="btn btn-primary" onclick="showForm()">
                <i class="bi bi-plus-circle"></i> Ajouter un supervisé
            </button>
        </div>

        <div class="supervision-card">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th style="width: 20%">Noms/prénoms</th>
                            <th style="width: 20%">Fonction/Service</th>
                            <th style="width: 15%">Phone</th>
                            <th style="width: 25%">E-mail</th>
                            <th style="width: 15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="supervises-table">
                        <!-- Les données seront ajoutées ici -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="hidden">
        <div class="supervision-card slide-up">
            <div class="supervision-header">
                <h4 class="mb-0">Ajouter/Modifier un supervisé</h4>
            </div>

            <div class="card-body p-4">
                <form id="superviseForm" onsubmit="handleSubmit(event)">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Noms/prénoms</label>
                            <input type="text" class="form-control" name="nom_prenom" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fonction/Service</label>
                            <input type="text" class="form-control" name="fonction" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" required>
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
    let superviseCount = 0;
    let editingRow = null;

    function showForm() {
        document.getElementById('form-section').classList.remove('hidden');
        document.getElementById('table-section').classList.add('hidden');
    }

    function showTable() {
        document.getElementById('form-section').classList.add('hidden');
        document.getElementById('table-section').classList.remove('hidden');
        document.getElementById('superviseForm').reset();
        editingRow = null;
    }

    function handleSubmit(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        if (editingRow) {
            // Mode édition
            updateRow(editingRow, formData);
        } else {
            // Mode ajout
            superviseCount++;
            const tbody = document.getElementById('supervises-table');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
            <td class="text-center">${superviseCount}</td>
            <td>${formData.get('nom_prenom')}</td>
            <td>${formData.get('fonction')}</td>
            <td>${formData.get('phone')}</td>
            <td>${formData.get('email')}</td>
            <td>
                <button class="btn btn-sm btn-warning me-1" onclick="editSupervise(this)">
                    <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteSupervise(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;

            tbody.appendChild(newRow);
        }

        showTable();
    }

    function updateRow(row, formData) {
        row.cells[1].textContent = formData.get('nom_prenom');
        row.cells[2].textContent = formData.get('fonction');
        row.cells[3].textContent = formData.get('phone');
        row.cells[4].textContent = formData.get('email');
    }

    function editSupervise(button) {
        const row = button.closest('tr');
        editingRow = row;

        const form = document.getElementById('superviseForm');
        form.elements['nom_prenom'].value = row.cells[1].textContent;
        form.elements['fonction'].value = row.cells[2].textContent;
        form.elements['phone'].value = row.cells[3].textContent;
        form.elements['email'].value = row.cells[4].textContent;

        showForm();
    }

    function deleteSupervise(button) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce supervisé ?')) {
            const row = button.closest('tr');
            row.remove();
            updateNumbers();
        }
    }

    function updateNumbers() {
        const rows = document.querySelectorAll('#supervises-table tr');
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
        superviseCount = rows.length;
    }
</script>
@endsection