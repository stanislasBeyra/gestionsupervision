@extends('layouts.master')
@section('title', 'Outil de supervision')

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

    .form-control,
    .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 5px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #e66a0a;
        box-shadow: 0 0 0 0.2rem rgba(230, 106, 10, 0.25);
    }

    .table {
        background: white;
        border-radius: 15px;
        overflow: hidden;
    }

    .table thead th {
        background: var(--secondary-gradient);
        color: white;
        border: none;
        padding: auto;
    }

    .table tbody td {
        padding: auto;
        border-bottom: 1px solid #e2e8f0;
    }

    .btn-action {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.5rem;
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
</style>

<div class="mt-4">
    <!-- Section Tableau -->
    <div id="table-section" class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title">Liste des supervisions</h2>
            <div>
                <button id="deleteSelectedBtn" class="btn btn-danger me-2 d-none">
                    <i class="bi bi-trash"></i> Supprimer la sélection
                </button>
                <button type="button" class="btn btn-primary" onclick="showForm()">
                    <i class="bi bi-plus-circle"></i> Nouvelle établissement
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)">
                        </th>
                        <th>Direction Régionale</th>
                        <th>District Sanitaire</th>
                        <th>Établissement</th>
                        <th>Catégorie</th>
                        <th>Code</th>
                        <th>Période</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Responsable</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Les données seront ajoutées ici dynamiquement -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="hidden">
        <div class="supervision-card slide-up">
            <div class="supervision-header">
                <h2 class="mb-0 text-center">IDENTIFICATION DE L'ETABLISSEMENT SANITAIRE</h2>

            </div>

            <div class="card-body p-4">
                <form id="supervisionForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Direction Régionale</label>
                            <input type="text" class="form-control" name="direction_regionale" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">District Sanitaire</label>
                            <input type="text" class="form-control" name="district_sanitaire" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Établissement Sanitaire</label>
                            <input type="text" class="form-control" name="etablissement_sanitaire" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Catégorie de l'établissement sanitaire</label>
                            <select class="form-select" name="categorie_etablissement" required>
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="hopital">Hôpital</option>
                                <option value="centre_sante">Centre de santé</option>
                                <option value="clinique">Clinique</option>
                                <option value="dispensaire">Dispensaire</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Code Établissement Sanitaire</label>
                            <input type="text" class="form-control" name="code_etablissement" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Période supervisée</label>
                            <input type="text" class="form-control" name="periode_supervisee" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date/heure de début</label>
                            <input type="datetime-local" class="form-control" name="date_debut" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date/heure de fin</label>
                            <input type="datetime-local" class="form-control" name="date_fin" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nom du Responsable</label>
                            <input type="text" class="form-control" name="nom_responsable" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Contact du Responsable</label>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="tel" class="form-control" name="telephone_responsable" placeholder="Téléphone" required>
                                </div>
                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email_responsable" placeholder="Email" required>
                                </div>
                            </div>
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
    function toggleAllCheckboxes(source) {
        const checkboxes = document.querySelectorAll('#table-body input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
        updateDeleteButton();
    }

    function updateDeleteButton() {
        const anyChecked = [...document.querySelectorAll('#table-body input[type="checkbox"]')].some(checkbox => checkbox.checked);
        document.getElementById('deleteSelectedBtn').classList.toggle('d-none', !anyChecked);
    }

    function deleteSelectedRows() {
        const checkboxes = document.querySelectorAll('#table-body input[type="checkbox"]:checked');
        checkboxes.forEach(checkbox => {
            checkbox.closest('tr').remove();
        });
        updateDeleteButton();
    }

    function showForm() {
        document.getElementById('form-section').classList.remove('hidden');
        document.getElementById('table-section').classList.add('hidden');
    }

    function showTable() {
        document.getElementById('form-section').classList.add('hidden');
        document.getElementById('table-section').classList.remove('hidden');
    }

    function formatDate(dateString) {
        return new Date(dateString).toLocaleString('fr-FR');
    }

    function handleSubmit(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const tbody = document.getElementById('table-body');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
        <td><input type="checkbox" onchange="updateDeleteButton()"></td>
        <td>${formData.get('direction_regionale')}</td>
        <td>${formData.get('district_sanitaire')}</td>
        <td>${formData.get('etablissement_sanitaire')}</td>
        <td>${formData.get('categorie_etablissement')}</td>
        <td>${formData.get('code_etablissement')}</td>
        <td>${formData.get('periode_supervisee')}</td>
        <td>${formatDate(formData.get('date_debut'))}</td>
        <td>${formatDate(formData.get('date_fin'))}</td>
        <td>${formData.get('nom_responsable')}</td>
        <td>
            Tél: ${formData.get('telephone_responsable')}<br>
            Email: ${formData.get('email_responsable')}
        </td>
        <td>
            <button class="btn btn-sm btn-warning me-1" onclick="editRow(this)">
                <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">
                <i class="bi bi-trash"></i>
            </button>
        </td>
    `;

        tbody.appendChild(newRow);
        event.target.reset();
        showTable();
    }

    function deleteRow(button) {
        button.closest('tr').remove();
        updateDeleteButton();
    }

    function editRow(button) {
        const row = button.closest('tr');
        const cells = row.cells;

        const form = document.getElementById('supervisionForm');
        form.elements['direction_regionale'].value = cells[1].textContent;
        form.elements['district_sanitaire'].value = cells[2].textContent;
        form.elements['etablissement_sanitaire'].value = cells[3].textContent;
        form.elements['categorie_etablissement'].value = cells[4].textContent;
        form.elements['code_etablissement'].value = cells[5].textContent;
        form.elements['periode_supervisee'].value = cells[6].textContent;
        // Pour les dates, il faudrait les reformater au format datetime-local

        const contact = cells[10].textContent.split('\n');
        form.elements['telephone_responsable'].value = contact[0].replace('Tél: ', '');
        form.elements['email_responsable'].value = contact[1].replace('Email: ', '');

        showForm();
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('supervisionForm').addEventListener('submit', handleSubmit);

        document.querySelectorAll('#table-body input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButton);
        });
    });
</script>
@endsection