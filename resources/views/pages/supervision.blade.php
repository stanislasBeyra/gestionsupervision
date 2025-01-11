@extends('layouts.master')
@section('title', 'Supervision')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(45deg, #1266f1 0%, #0d6efd 100%);
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

    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        background: var(--primary-gradient);
        padding: 1.5rem;
        border-bottom: none;
    }

    .card-body {
        padding: 2rem;
        background: #f8f9fa;
    }

    .form-select,
    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .form-label {
        font-weight: 600;
        color: #2d3748;
    }

    .btn-primary {
        background: var(--primary-gradient);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-secondary {
        background: var(--secondary-gradient);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .form-check-input {
        border: 2px solid #0d6efd;
    }

    .form-check-input:checked {
        background: var(--success-gradient);
        border-color: transparent;
    }

    .etablissement-section {
        background: #ffffff;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
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
        padding: 1rem;
    }

    .table tbody td {
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .table tbody tr:hover {
        background: var(--hover-overlay);
    }

    .alert {
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .toast-container {
        z-index: 1050;
    }

    .toast {
        opacity: 0;
        transition: opacity 0.2s ease-in-out;
    }

    .toast.showing,
    .toast.show {
        opacity: 1;
    }

    .toast.hide {
        display: none;
    }

    .toast-body {
        font-size: 0.9rem;
        padding: 0.75rem 1rem;
    }
</style>

<div class="container mt-5">
    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <!-- Les toasts seront ajoutés ici dynamiquement -->
    </div>

    <!-- Section Tableau -->
    <div id="table-section" class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Liste des données</h2>
            <div>
                <button id="deleteSelectedBtn" class="btn btn-danger me-2 d-none" onclick="deleteSelectedRows()">
                    <i class="bi bi-trash"></i> Supprimer la sélection
                </button>
                <button type="button" class="btn btn-success me-2" onclick="exportToExcel()">
                    <i class="bi bi-file-excel"></i> Exporter en Excel
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
                            <th scope="col">Réponse</th>
                            <th scope="col">Note Obtenue</th>
                            <th scope="col">Établissements</th>
                            <th scope="col">Commentaires</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="hidden">
        <div class="card slide-up">
            <div class="card-header">
                <h4 class="mb-0 text-white text-center">Ajouter une nouvelle entrée</h4>
            </div>
            <div class="card-body">
                <form id="data-form" onsubmit="handleSubmit(event)">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <select id="domaine" name="domaine" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez un domaine</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <select id="contenu" name="contenu" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez un contenu</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <select id="question" name="question" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez une question</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <select id="method" name="method" class="form-select form-select-lg mb-3" required>
                                <option value="">Sélectionnez une méthode</option>
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
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="commentaire" class="form-label">Commentaires</label>
                                <textarea id="commentaire" name="commentaire" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="col-md-6 mb-3 etablissement-section">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <label class="form-label">Établissements</label>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-primary me-2" onclick="selectAllEtablissements()">
                                            <i class="bi bi-check2-all"></i> Tout sélectionner
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="deselectAllEtablissements()">
                                            <i class="bi bi-x-lg"></i> Tout désélectionner
                                        </button>
                                    </div>
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
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

<script>
    function exportToExcel() {
        // Récupérer les données du tableau
        const tableData = [];
        const headers = [];

        // Récupérer les en-têtes (sauf la première et dernière colonne)
        document.querySelectorAll('#data-table thead th').forEach((header, index) => {
            if (index !== 0 && index !== document.querySelectorAll('#data-table thead th').length - 1) {
                headers.push(header.textContent.trim());
            }
        });

        // Ajouter les en-têtes comme première ligne
        tableData.push(headers);

        // Récupérer les données des lignes
        document.querySelectorAll('#data-table tbody tr').forEach(row => {
            const rowData = [];
            row.querySelectorAll('td').forEach((cell, index) => {
                // Ignorer la première colonne (checkbox) et la dernière colonne (actions)
                if (index !== 0 && index !== row.querySelectorAll('td').length - 1) {
                    rowData.push(cell.textContent.trim());
                }
            });
            if (rowData.length > 0) {
                tableData.push(rowData);
            }
        });

        // Créer un workbook et une worksheet
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(tableData);

        // Ajouter la worksheet au workbook
        XLSX.utils.book_append_sheet(wb, ws, "Données Supervision");

        // Générer le fichier Excel
        const today = new Date();
        const dateStr = today.toISOString().slice(0, 10);
        XLSX.writeFile(wb, `supervision_${dateStr}.xlsx`);

        // Afficher un message de succès
        showSuccessAlert('Fichier Excel généré avec succès');
    }

    document.addEventListener('DOMContentLoaded', function() {
        loadSupervisions();
        loadDomaines();
        loadContenus();
        loadQuestions();
        loadMethodes();
        loadNotes();

        document.querySelectorAll('#table-body input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButton);
        });

        setTimeout(() => {
            document.getElementById('table-section').classList.add('fade-in');
        }, 100);
    });

    function loadSupervisions() {
        fetch('/api/supervisions/getallsup')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('table-body');
                tbody.innerHTML = ''; // Vider le tableau

                data.forEach(supervision => {
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', supervision.id);
                    row.innerHTML = `
                    <td><input type="checkbox" onchange="updateDeleteButton()"></td>
                    <td>${supervision.domaine_text}</td>
                    <td>${supervision.contenu_text}</td>
                    <td>${supervision.question_text}</td>
                    <td>${supervision.methode_text}</td>
                    <td>${supervision.reponse}</td>
                    <td>${supervision.note_text}</td>
                    <td>${supervision.etablissements.join(', ')}</td>
                    <td>${supervision.commentaire}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </td>
                `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Erreur lors du chargement des supervisions:', error);
                showErrorAlert('Erreur lors du chargement des données');
            });
    }

    // Fonctions de chargement des données
    function loadDomaines() {
        fetch('/api/domaines')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('domaine');
                select.innerHTML = '<option value="">Sélectionnez un domaine</option>';

                if (data.domaine && Array.isArray(data.domaine)) {
                    data.domaine.forEach(item => {
                        select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
                    });
                }
            })
            .catch(handleError);
    }

    function loadContenus() {
        fetch('/api/contenus')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('contenu');
                select.innerHTML = '<option value="">Sélectionnez un contenu</option>';

                if (data.contenus && Array.isArray(data.contenus)) {
                    data.contenus.forEach(item => {
                        select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
                    });
                }
            })
            .catch(handleError);
    }

    function loadQuestions() {
        fetch('/api/questions')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('question');
                select.innerHTML = '<option value="">Sélectionnez une question</option>';

                if (data.questions && Array.isArray(data.questions)) {
                    data.questions.forEach(item => {
                        select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
                    });
                }
            })
            .catch(handleError);
    }

    function loadMethodes() {
        fetch('/api/methodes')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('method');
                select.innerHTML = '<option value="">Sélectionnez une méthode</option>';

                if (data.methodes && Array.isArray(data.methodes)) {
                    data.methodes.forEach(item => {
                        select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
                    });
                }
            })
            .catch(handleError);
    }

    function loadNotes() {
        fetch('/api/notes')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('note');
                select.innerHTML = '<option value="">Sélectionnez une note</option>';

                if (data.notes && Array.isArray(data.notes)) {
                    data.notes.forEach(item => {
                        select.innerHTML += `<option value="${item.value}">${item.name}</option>`;
                    });
                }
            })
            .catch(handleError);
    }

    function handleError(error) {
        console.error('Erreur:', error);
        showErrorAlert('Une erreur est survenue lors du chargement des données.');
    }

    function showErrorAlert(message) {
        const toastContainer = document.querySelector('.toast-container');

        const toastElement = document.createElement('div');
        toastElement.className = 'toast align-items-center text-bg-danger border-0';
        toastElement.setAttribute('role', 'alert');
        toastElement.setAttribute('aria-live', 'assertive');
        toastElement.setAttribute('aria-atomic', 'true');

        toastElement.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

        toastContainer.appendChild(toastElement);

        const toast = new bootstrap.Toast(toastElement, {
            autohide: true,
            delay: 3000
        });

        toast.show();

        toastElement.addEventListener('hidden.bs.toast', () => {
            toastElement.remove();
        });

        setTimeout(() => {
            alert.remove();
        }, 3000);
    }

    function showSuccessAlert(message) {
        const toastContainer = document.querySelector('.toast-container');

        const toastElement = document.createElement('div');
        toastElement.className = 'toast align-items-center text-bg-success border-0';
        toastElement.setAttribute('role', 'alert');
        toastElement.setAttribute('aria-live', 'assertive');
        toastElement.setAttribute('aria-atomic', 'true');

        toastElement.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

        toastContainer.appendChild(toastElement);

        const toast = new bootstrap.Toast(toastElement, {
            autohide: true,
            delay: 3000
        });

        toast.show();

        toastElement.addEventListener('hidden.bs.toast', () => {
            toastElement.remove();
        });

        setTimeout(() => {
            alert.remove();
        }, 3000);
    }

    // function handleSubmit(event) {
    //     event.preventDefault();
    //     const formData = {
    //         domaine: {
    //             value: document.getElementById('domaine').value,
    //             text: document.getElementById('domaine').options[document.getElementById('domaine').selectedIndex].text
    //         },
    //         contenu: {
    //             value: document.getElementById('contenu').value,
    //             text: document.getElementById('contenu').options[document.getElementById('contenu').selectedIndex].text
    //         },
    //         question: {
    //             value: document.getElementById('question').value,
    //             text: document.getElementById('question').options[document.getElementById('question').selectedIndex].text
    //         },
    //         method: {
    //             value: document.getElementById('method').value,
    //             text: document.getElementById('method').options[document.getElementById('method').selectedIndex].text
    //         },
    //         reponse: document.getElementById('reponse').value,
    //         note: {
    //             value: document.getElementById('note').value,
    //             text: document.getElementById('note').options[document.getElementById('note').selectedIndex].text
    //         },
    //         commentaire: document.getElementById('commentaire').value,
    //         etablissements: []
    //     };

    //     document.querySelectorAll('.etablissement-checkbox:checked').forEach(etab => {
    //         formData.etablissements.push(etab.value);
    //     });

    //     const tbody = document.getElementById('table-body');
    //     const newRow = document.createElement('tr');
    //     newRow.innerHTML = `
    //     <td><input type="checkbox" onchange="updateDeleteButton()"></td>
    //     <td>${formData.domaine.text}</td>
    //     <td>${formData.contenu.text}</td>
    //     <td>${formData.question.text}</td>
    //     <td>${formData.method.text}</td>
    //     <td>${formData.reponse}</td>
    //     <td>${formData.note.text}</td>

    //     <td>${formData.etablissements.join(', ')}</td>
    //      <td>${formData.commentaire}</td>
    //     <td>
    //         <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">
    //             <i class="bi bi-trash"></i> Supprimer
    //         </button>
    //     </td>
    // `;
    //     tbody.appendChild(newRow);

    //     document.getElementById('data-form').reset();
    //     showTable();
    //     showSuccessAlert('Données enregistrées avec succès');
    // }

    function handleSubmit(event) {
        event.preventDefault();

        const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
        if (!csrfTokenElement) {
            showErrorAlert('CSRF token manquant');
            return;
        }

        const domaineElement = document.getElementById('domaine');
        const contenuElement = document.getElementById('contenu');
        const questionElement = document.getElementById('question');
        const methodElement = document.getElementById('method');
        const noteElement = document.getElementById('note');

        // Vérification des éléments requis
        if (!domaineElement || !contenuElement || !questionElement || !methodElement || !noteElement) {
            showErrorAlert('Certains champs obligatoires sont manquants');
            return;
        }

        const formData = {
            domaine: domaineElement.value,
            domaine_text: domaineElement.options[domaineElement.selectedIndex]?.text || '',
            contenu: contenuElement.value,
            contenu_text: contenuElement.options[contenuElement.selectedIndex]?.text || '',
            question: questionElement.value,
            question_text: questionElement.options[questionElement.selectedIndex]?.text || '',
            methode: methodElement.value,
            methode_text: methodElement.options[methodElement.selectedIndex]?.text || '',
            reponse: document.getElementById('reponse')?.value || '',
            note: noteElement.value,
            note_text: noteElement.options[noteElement.selectedIndex]?.text || '',
            commentaire: document.getElementById('commentaire')?.value || '',
            etablissements: Array.from(document.querySelectorAll('.etablissement-checkbox:checked')).map(cb => cb.value)
        };

        fetch('/api/supervisions/AddSup', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfTokenElement.getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
               
                    document.getElementById('data-form').reset();
                    showTable();
                    showSuccessAlert('Données enregistrées avec succès');
                    loadSupervisions(); // Recharger le tableau
                
                showTable()
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorAlert('Erreur lors de l\'enregistrement');
            });
    }

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
        if (confirm('Êtes-vous sûr de vouloir supprimer les éléments sélectionnés ?')) {
            const checkboxes = document.querySelectorAll('#table-body input[type="checkbox"]:checked');
            checkboxes.forEach(checkbox => {
                checkbox.closest('tr').remove();
            });
            updateDeleteButton();
            showSuccessAlert('Éléments supprimés avec succès');
        }
    }

    function selectAllEtablissements() {
        document.querySelectorAll('.etablissement-checkbox').forEach(checkbox => {
            checkbox.checked = true;
        });
    }

    function deselectAllEtablissements() {
        document.querySelectorAll('.etablissement-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
    }

    function showForm() {
        document.getElementById('form-section').classList.remove('hidden');
        document.getElementById('table-section').classList.add('hidden');
    }

    function showTable() {
        document.getElementById('form-section').classList.add('hidden');
        document.getElementById('table-section').classList.remove('hidden');
    }

    function deleteRow(button) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
            button.closest('tr').remove();
            updateDeleteButton();
            showSuccessAlert('Élément supprimé avec succès');
        }
    }
</script>



@endsection