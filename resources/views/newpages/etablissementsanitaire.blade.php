@extends('layoutsapp.master')
@section('title', 'Outil de supervision')

@section('content')
<!-- Ajout des dépendances Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

<style>
    .card {
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
    }
</style>



<section class="mb-4">
    <!-- Section Table -->
    <div id="table-section">
    <div class="card">
        <div class="card-header text-center py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fw-bold">Liste des supervisions</h2>
                <div>
                    <button id="deleteSelectedBtn" class="btn btn-danger btn-rounded me-2 d-none ripple-surface-dark">
                        <i class="bi bi-trash"></i> Supprimer la sélection
                    </button>
                    <button type="button" class="btn btn-primary  ripple-surface" onclick="showForm()">
                        <i class="bi bi-plus-circle"></i> Nouvelle établissement
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead class="bg-light">
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleAllCheckboxes(this)">
                                </div>
                            </th>
                            <th>N°</th>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="d-none">
        <div class="card shadow-2-strong">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-center fw-bold">IDENTIFICATION DE L'ETABLISSEMENT SANITAIRE</h4>
            </div>

            <div class="card-body p-4">
                <form id="supervisionForm" onsubmit="handleSubmit(event)">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="direction_regionale" id="direction_regionale" required>
                                <label class="form-label">Direction Régionale</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="district_sanitaire" id="district_sanitaire" required>
                                <label class="form-label">District Sanitaire</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="etablissement_sanitaire" id="etablissement_sanitaire" required>
                                <label class="form-label">Établissement Sanitaire</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label select-label">Catégorie de l'établissement</label>
                            <select class="select form-control" name="categorie_etablissement" id="categorie_etablissement" required>
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="hopital">Hôpital</option>
                                <option value="centre_sante">Centre de santé</option>
                                <option value="clinique">Clinique</option>
                                <option value="dispensaire">Dispensaire</option>
                            </select>

                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="code_etablissement" id="code_etablissement" required>
                                <label class="form-label">Code Établissement Sanitaire</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="periode_supervisee" id="periode_supervisee" required>
                                <label class="form-label">Période supervisée</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control datepicker" name="date_debut" id="date_debut" required>
                                <label class="form-label">Date/heure de début</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control datepicker" name="date_fin" id="date_fin" required>
                                <label class="form-label">Date/heure de fin</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" class="form-control" name="nom_responsable" id="nom_responsable" required>
                                <label class="form-label">Nom du Responsable</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-outline">
                                        <input type="tel" class="form-control" name="telephone_responsable" id="telephone_responsable" required>
                                        <label class="form-label">Téléphone</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-outline">
                                        <input type="email" class="form-control" name="email_responsable" id="email_responsable" required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary " onclick="showTable()">
                            <i class="bi bi-x-circle"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-primary ">
                            <i class="bi bi-save"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation des composants MDB
        document.querySelectorAll('.form-outline').forEach((formOutline) => {
            new mdb.Input(formOutline).init();
        });

        // Initialisation de Flatpickr
        flatpickr(".datepicker", {
            locale: "fr",
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            time_24hr: true,
            allowInput: true,
            minuteIncrement: 1,
        });
    });

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

    function showForm() {
        document.getElementById('table-section').classList.add('d-none');
        document.getElementById('form-section').classList.remove('d-none');
        // Réinitialiser le formulaire
        document.getElementById('supervisionForm').reset();
    }

    function showTable() {
        document.getElementById('form-section').classList.add('d-none');
        document.getElementById('table-section').classList.remove('d-none');
    }

    function handleSubmit(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const tbody = document.getElementById('table-body');
        const rowCount = tbody.rows.length;
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" onchange="updateDeleteButton()">
                </div>
            </td>
            <td>${rowCount + 1}</td>
            <td>${formData.get('direction_regionale')}</td>
            <td>${formData.get('district_sanitaire')}</td>
            <td>${formData.get('etablissement_sanitaire')}</td>
            <td>${formData.get('categorie_etablissement')}</td>
            <td>${formData.get('code_etablissement')}</td>
            <td>${formData.get('periode_supervisee')}</td>
            <td>${formData.get('date_debut')}</td>
            <td>${formData.get('date_fin')}</td>
            <td>${formData.get('nom_responsable')}</td>
            <td>${formData.get('telephone_responsable')}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;

        tbody.appendChild(newRow);
        showTable();
    }

    function deleteRow(button) {
        const row = button.closest('tr');
        row.remove();
        updateDeleteButton();
    }
</script>
@endsection