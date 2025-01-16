@extends('layoutsapp.master')
@section('title', 'Identification des supervisés')

@section('content')
<style>
    .card {
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
    }
</style>

<div class="container-fluid mt-4">
    <!-- Section Tableau -->
    <div id="table-section" class="fade-in">
    <div class="card">
        <div class="card-header text-center py-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Liste des supervisés</h2>
                <button type="button" class="btn btn-primary" onclick="showForm()">
                    <i class="bi bi-plus-circle"></i> Ajouter un supervisé
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Noms/prénoms</th>
                            <th scope="col">Fonction/Service</th>
                            <th scope="col">Phone</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="supervises-table">
                        <!-- Les données seront ajoutées ici -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="d-none">
        <div class="card shadow-sm slide-up">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Ajouter/Modifier un supervisé</h4>
            </div>

            <div class="card-body">
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
        document.getElementById('form-section').classList.remove('d-none');
        document.getElementById('table-section').classList.add('d-none');
    }

    function showTable() {
        document.getElementById('form-section').classList.add('d-none');
        document.getElementById('table-section').classList.remove('d-none');
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