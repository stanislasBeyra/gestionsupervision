@extends('layoutsapp.master')
@section('title', 'Synthèse de la supervision Intégrée')

@section('content')

<style>
    .card {
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
    }

    .toast-container {
        z-index: 1060;
    }

    #connection-status {
        z-index: 1050;
    }

    .badge {
        font-size: 0.75em;
    }

    #total-row {
        border-top: 2px solid #dee2e6;
    }

    .btn-link {
        text-decoration: none;
    }
</style>






<div id="table-section">

    <div class="row mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">Synthèse de la supervision Intégrée</h2>
                <p class="text-muted mb-0">Aperçu de la vue de Synthèse de la supervision Intégrée</p>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-success" onclick="exportToExcel()">
                    <i class="bi bi-file-excel me-2"></i>Exporter en Excel
                </button>
                <button type="button" class="btn btn-primary" onclick="showForm()">
                    <i class="fas fa-plus-circle"></i> Ajouter une synthèse
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tableau à gauche -->
        <div class="col-md-8 mb-4">
            <div class="card ">

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
    <div class="row mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <h2 class="mb-1" id="formTitle">Nouvelle synthèse</h2>
                <p class="text-muted mb-0" id="formSubtitle">Ajouter une nouvelle synthèse</p>
            </div>
            <button class="btn bg-primary text-white" id="toggleListButton" onclick="showTable()">
                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </button>
        </div>
    </div>
    <div class="card shadow-3">
        
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
<script>
    // Variables globales
    let isOnline = navigator.onLine;
    let editingRow = null;

    // Initialisation lors du chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        setupToastContainer();
        setupConnectionStatus();
        initMDB();
        loadOfflineData();
        calculateTotalPercentage();
    });

    // Configuration initiale
    function setupToastContainer() {
        if (!document.querySelector('.toast-container')) {
            const container = document.createElement('div');
            container.className = 'toast-container position-fixed top-0 end-0 p-3';
            container.style.zIndex = '1060';
            document.body.appendChild(container);
        }
    }

    function setupConnectionStatus() {
        // Créer l'indicateur de statut s'il n'existe pas
        if (!document.getElementById('connection-status')) {
            const statusDiv = document.createElement('div');
            statusDiv.id = 'connection-status';
            statusDiv.className = 'position-fixed bottom-0 end-0 m-3';
            statusDiv.style.zIndex = '1050';
            statusDiv.innerHTML = `
            <div class="alert alert-warning d-flex align-items-center mb-0">
                <i class="fas fa-wifi-slash me-2"></i>
                Mode hors ligne
            </div>
        `;
            document.body.appendChild(statusDiv);
        }

        // Ajouter les écouteurs d'événements de connectivité
        window.addEventListener('online', () => {
            isOnline = true;
            showToast('Connexion Internet rétablie', 'success');
            updateConnectionStatus();
            syncData();
        });

        window.addEventListener('offline', () => {
            isOnline = false;
            showToast('Mode hors ligne activé', 'warning');
            updateConnectionStatus();
        });

        // État initial
        updateConnectionStatus();
    }

    function initMDB() {
        document.querySelectorAll('.form-outline').forEach((formOutline) => {
            new mdb.Input(formOutline).init();
        });
    }

    // Gestion de la connexion
    function updateConnectionStatus() {
        const statusElement = document.getElementById('connection-status');
        if (statusElement) {
            if (isOnline) {
                statusElement.style.display = 'none';
            } else {
                statusElement.style.display = 'block';
            }
        }
    }

    // Gestion des toasts
    function showToast(message, type = 'success') {
        const toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) return;

        const toast = document.createElement('div');
        toast.className = `toast show align-items-center text-white bg-${type} border-0`;
        toast.role = 'alert';
        toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.parentElement.parentElement.remove();"></button>
        </div>
    `;

        toastContainer.appendChild(toast);
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    // Fonctions utilitaires
    function calculatePercentage(points_obtenus) {
        return ((parseFloat(points_obtenus) / 4) * 100).toFixed(2);
    }

    function getTextColorClass(percentage) {
        const percent = parseFloat(percentage);
        if (percent <= 40) return 'text-danger';
        if (percent <= 60) return 'text-warning';
        return 'text-success';
    }

    // Gestion du formulaire
    function showForm() {
        document.getElementById('form-section').classList.remove('d-none');
        document.getElementById('table-section').classList.add('d-none');
    }

    function showTable() {
        document.getElementById('form-section').classList.add('d-none');
        document.getElementById('table-section').classList.remove('d-none');
        document.getElementById('syntheseForm').reset();
        editingRow = null;
    }

    async function handleSubmit(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        const syntheseData = {
            domaine: formData.get('domaine'),
            points_disponibles: formData.get('points_disponibles'),
            points_obtenus: formData.get('points_obtenus'),
            percentage: calculatePercentage(formData.get('points_obtenus')),
            timestamp: Date.now(),
            id: editingRow ? editingRow.dataset.id : Date.now().toString()
        };

        if (isOnline) {
            try {
                await saveToServer(syntheseData);
                addSyntheseRow(syntheseData, false);
                showToast('Synthèse enregistrée avec succès', 'success');
            } catch (error) {
                console.error('Erreur serveur:', error);
                saveLocally(syntheseData);
                addSyntheseRow(syntheseData, true);
                showToast('Erreur de connexion - Enregistré localement', 'warning');
            }
        } else {
            saveLocally(syntheseData);
            addSyntheseRow(syntheseData, true);
            showToast('Enregistré localement - En attente de connexion', 'warning');
        }

        showTable();
        calculateTotalPercentage();
    }

    // Gestion du stockage local
    function saveLocally(data) {
        try {
            let savedSyntheses = JSON.parse(localStorage.getItem('offlineSyntheses') || '[]');
            const existingIndex = savedSyntheses.findIndex(s => s.id === data.id);

            if (existingIndex >= 0) {
                savedSyntheses[existingIndex] = data;
            } else {
                savedSyntheses.push(data);
            }

            localStorage.setItem('offlineSyntheses', JSON.stringify(savedSyntheses));
        } catch (error) {
            console.error('Erreur de sauvegarde locale:', error);
            showToast('Erreur lors de la sauvegarde locale', 'danger');
        }
    }

    function loadOfflineData() {
        try {
            const savedSyntheses = JSON.parse(localStorage.getItem('offlineSyntheses') || '[]');
            savedSyntheses.forEach(synthese => {
                addSyntheseRow(synthese, true);
            });
        } catch (error) {
            console.error('Erreur de chargement des données:', error);
        }
    }

    // Gestion du tableau
    function addSyntheseRow(data, isOffline = false) {
        const tbody = document.getElementById('synthese-table');
        const existingRow = editingRow || document.querySelector(`tr[data-id="${data.id}"]`);
        const colorClass = getTextColorClass(data.percentage);

        const rowContent = `
        <td class="${colorClass}">
            ${data.domaine}
            ${isOffline ? '<span class="badge bg-warning ms-2">Hors ligne</span>' : ''}
        </td>
        <td class="text-center ${colorClass}">${data.points_disponibles}</td>
        <td class="text-center ${colorClass}">${data.points_obtenus}</td>
        <td class="text-center ${colorClass}">${data.percentage}%</td>
        <td class="text-center">
            <button class="btn btn-link btn-sm text-warning" onclick="editSynthese(this)">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-link btn-sm text-danger" onclick="deleteSynthese(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;

        if (existingRow) {
            existingRow.innerHTML = rowContent;
            existingRow.dataset.id = data.id;
        } else {
            const newRow = document.createElement('tr');
            newRow.innerHTML = rowContent;
            newRow.dataset.id = data.id;
            tbody.appendChild(newRow);
        }
    }

    function editSynthese(button) {
        editingRow = button.closest('tr');
        const cells = editingRow.cells;

        document.getElementById('domaine').value = cells[0].textContent.replace('Hors ligne', '').trim();
        document.getElementById('points_disponibles').value = cells[1].textContent;
        document.getElementById('points_obtenus').value = cells[2].textContent;

        showForm();
    }

    function deleteSynthese(button) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette synthèse ?')) {
            const row = button.closest('tr');
            const id = row.dataset.id;

            if (id) {
                removeFromLocalStorage(id);
            }

            row.remove();
            calculateTotalPercentage();
            showToast('Synthèse supprimée avec succès');
        }
    }

    function removeFromLocalStorage(id) {
        try {
            let savedSyntheses = JSON.parse(localStorage.getItem('offlineSyntheses') || '[]');
            savedSyntheses = savedSyntheses.filter(s => s.id !== id);
            localStorage.setItem('offlineSyntheses', JSON.stringify(savedSyntheses));
        } catch (error) {
            console.error('Erreur lors de la suppression:', error);
        }
    }

    // Calcul des totaux
    function calculateTotalPercentage() {
        const tbody = document.getElementById('synthese-table');
        const rows = Array.from(tbody.getElementsByTagName('tr'))
            .filter(row => row.id !== 'total-row');

        if (rows.length === 0) return;

        let totalPoints = 0;
        let totalObtained = 0;

        rows.forEach(row => {
            totalPoints += parseFloat(row.cells[1].textContent);
            totalObtained += parseFloat(row.cells[2].textContent);
        });

        const totalPercentage = ((totalObtained / totalPoints) * 100).toFixed(2);
        const colorClass = getTextColorClass(totalPercentage);

        let totalRow = document.getElementById('total-row');
        if (!totalRow) {
            totalRow = document.createElement('tr');
            totalRow.id = 'total-row';
            tbody.appendChild(totalRow);
        }

        totalRow.innerHTML = `
        <td class="fw-bold ${colorClass}">TOTAL</td>
        <td class="text-center fw-bold ${colorClass}">${totalPoints}</td>
        <td class="text-center fw-bold ${colorClass}">${totalObtained}</td>
        <td class="text-center fw-bold ${colorClass}">${totalPercentage}%</td>
        <td></td>
    `;
    }

    // Communication avec le serveur
    async function saveToServer(data) {
        const response = await fetch('/api/syntheses', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error('Erreur réseau');
        }

        return response.json();
    }

    // Synchronisation des données
    async function syncData() {
        try {
            const offlineData = JSON.parse(localStorage.getItem('offlineSyntheses') || '[]');
            if (offlineData.length === 0) return;

            for (const data of offlineData) {
                try {
                    await saveToServer(data);
                    const row = document.querySelector(`tr[data-id="${data.id}"]`);
                    if (row) {
                        const badge = row.querySelector('.badge');
                        if (badge) badge.remove();
                    }
                } catch (error) {
                    console.error('Erreur de synchronisation:', error);
                    continue;
                }
            }

            localStorage.removeItem('offlineSyntheses');
            showToast('Données synchronisées avec succès', 'success');
        } catch (error) {
            console.error('Erreur lors de la synchronisation:', error);
            showToast('Erreur de synchronisation', 'danger');
        }
    }
</script>

@endsection