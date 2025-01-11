@extends('layouts.master')
@section('title', 'Supervision')

@section('content')
<style>
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
</style>



<div class="container mt-5">
    <!-- Section Tableau -->
    <div id="table-section" class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Liste des données</h2>
            <div>
                <button id="deleteSelectedBtn" class="btn btn-danger me-2 d-none" onclick="deleteSelectedRows()">
                    <i class="bi bi-trash"></i> Supprimer la sélection
                </button>
                <button type="button" class="btn btn-primary" onclick="showForm()">
                    <i class="bi bi-plus-circle"></i> Ajouter
                </button>
            </div>
        </div>

        <div class="slide-up">
            <div class="table-responsive">
                <table id="data-table" class="table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)">
                            </th>
                            <th scope="col">Domaine</th>
                            <th scope="col">Contenu</th>
                            <th scope="col">Question PA</th>
                            <th scope="col">Méthode</th>
                            <th scope="col">Réponse </th>
                            <th scope="col">Note Obtenue</th>
                            <th scope="col">Commentaires</th>
                            <th scope="col">Établissements</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <!-- Les lignes seront ajoutées ici -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="hidden">
        <div class="card slide-up">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Ajouter une nouvelle entrée</h4>
            </div>
            <div class="card-body">
                <form id="data-form" onsubmit="handleSubmit(event)">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <!-- <label for="domaine" class="form-label">Domaine</label> -->
                            <select id="domaine" name="domaine" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez un domaine</option>
                                <option value="informatique">Informatique</option>
                                <option value="marketing">Marketing</option>
                                <option value="finance">Finance</option>
                                <option value="ressources_humaines">Ressources Humaines</option>
                                <!-- Ajoutez d'autres options selon les besoins -->
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <!-- <label for="contenu" class="form-label">Contenu</label> -->
                            <select id="contenu" name="contenu" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez un contenu</option>
                                <option value="article">Article</option>
                                <option value="note">Note</option>
                                <option value="report">Report</option>
                                <!-- Ajoutez d'autres options selon les besoins -->
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <!-- <label for="question" class="form-label">Question Point Apprécié</label> -->
                            <select id="question" name="question" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez une question</option>
                                <option value="qualite_travail">Qualité du travail</option>
                                <option value="respect_delai">Respect des délais</option>
                                <option value="communication">Communication</option>
                                <option value="esprit_equipe">Esprit d'équipe</option>
                                <!-- Ajoutez d'autres options selon les besoins -->
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <!-- <label for="method" class="form-label">Méthode Supervision</label> -->
                            <select id="method" name="method" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez une méthode</option>
                                <option value="observation">Observation directe</option>
                                <option value="audit">Audit régulier</option>
                                <option value="feedback">Retour d'information</option>
                                <option value="auto_evaluation">Auto-évaluation</option>
                                <!-- Ajoutez d'autres options selon les besoins -->
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="reponse" class="form-label">Réponse Constat</label>
                            <input type="text" id="reponse" name="reponse" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="note" class="form-label">Note Obtenue</label>
                            <select id="note" name="note" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez une note</option>
                                <option value="0">Pas satisfaisant</option>
                                <option value="1">Besoin d'amélioration</option>
                                <option value="2">Satisfaisant</option>
                            </select>
                        </div>
                        <div class="row">
                            <!-- Commentaires -->
                            <div class="col-md-6 mb-3">
                                <label for="commentaire" class="form-label">Commentaires</label>
                                <textarea id="commentaire" name="commentaire" class="form-control" rows="3" required></textarea>
                            </div>


                            <!-- Établissements -->
                            <div class="col-md-6 mb-3 ml-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <label class="form-label">Établissements</label>

                                </div>
                                <div class="d-flex mt-2">
                                    <div class="form-check form-check-inline me-3">
                                        <input class="form-check-input etablissement-checkbox" type="checkbox" id="etabESPC" value="ESPC">
                                        <label class="form-check-label" for="etabESPC">ESPC</label>
                                    </div>
                                    <div class="form-check form-check-inline me-3">
                                        <input class="form-check-input etablissement-checkbox" type="checkbox" id="etabEHE" value="EHE">
                                        <label class="form-check-label" for="etabEHE">EHE</label>
                                    </div>
                                    <div class="form-check form-check-inline me-3">
                                        <input class="form-check-input etablissement-checkbox" type="checkbox" id="etabEESP" value="EESP">
                                        <label class="form-check-label" for="etabEESP">EESP</label>
                                    </div>
                                    <div class="form-check form-check-inline me-3">
                                        <input class="form-check-input etablissement-checkbox" type="checkbox" id="etabHE" value="HE">
                                        <label class="form-check-label" for="etabHE">HE</label>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-primary me-2" onclick="selectAllEtablissements()">Tout sélectionner</button>
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="deselectAllEtablissements()">Tout désélectionner</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" onclick="showTable()">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function selectAllEtablissements() {
        const checkboxes = document.querySelectorAll('.etablissement-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
    }

    function deselectAllEtablissements() {
        const checkboxes = document.querySelectorAll('.etablissement-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    }
    // JS pour gérer le tableau et le formulaire
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

    function handleSubmit(event) {
        event.preventDefault();
        const domaine = document.getElementById('domaine').value;
        const contenu = document.getElementById('contenu').value;
        const question = document.getElementById('question').value;
        const method = document.getElementById('method').value;
        const reponse = document.getElementById('reponse').value;
        const note = document.getElementById('note').value;
        const commentaire = document.getElementById('commentaire').value;
        const etablissements = [];
        if (document.getElementById('etabESPC').checked) etablissements.push('ESPC');
        if (document.getElementById('etabEHE').checked) etablissements.push('EHE');
        if (document.getElementById('etabEESP').checked) etablissements.push('EESP');
        if (document.getElementById('etabHE').checked) etablissements.push('HE');

        // Exemple d'ajout de ligne dans le tableau
        const tbody = document.getElementById('table-body');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="checkbox" onchange="updateDeleteButton()"></td>
            <td>${domaine}</td>
            <td>${contenu}</td>
            <td>${question}</td>
            <td>${method}</td>
            <td>${reponse}</td>
            <td>${note}</td>
            <td>${commentaire}</td>
            <td>${etablissements.join(', ')}</td>
            <td><button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Supprimer</button></td>
        `;
        tbody.appendChild(newRow);
        showTable();
    }

    function deleteRow(button) {
        button.closest('tr').remove();
        updateDeleteButton();
    }
</script>

@endsection