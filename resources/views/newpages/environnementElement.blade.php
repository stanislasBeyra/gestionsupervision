@extends('layoutsapp.master')
@section('title', 'Supervision')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #2563eb 0%, #5170a2 100%);
        --secondary-gradient: linear-gradient(135deg, #64748b 0%, #94a3b8 100%);
        --success-gradient: linear-gradient(135deg, #059669 0%, #10b981 100%);
        --danger-gradient: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    }

    .card {
        border: none;
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
    }

    .card-header {
        border-bottom: none;
        padding: 2rem;
        background: transparent;
    }

    .btn-custom {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-primary {
        background: var(--primary-gradient);
        border: none;
    }

    .btn-success {
        background: var(--success-gradient);
        border: none;
    }

    .btn-danger {
        background: var(--danger-gradient);
        border: none;
    }

    .etablissement-radio {
        display: none;
    }

    .hidden {
        display: none;
    }

    .etablissement-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.2rem;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 50%;
        position: relative;
        overflow: hidden;
        background: white;
    }

    .etablissement-label:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .etablissement-label:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .etablissement-radio:checked+.etablissement-label {
        border-color: #3b82f6;
        background: var(--primary-gradient);
        color: #fff;
    }

    .etablissement-radio:checked+.etablissement-label:before {
        opacity: 1;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .form-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.75rem;
    }



    .toast {
        border-radius: 12px;
        backdrop-filter: blur(10px);
    }

    .disabled-overlay {
        position: relative;
        pointer-events: none;
        opacity: 0.7;
    }

    .disabled-overlay::after {
        content: "Veuillez d'abord sélectionner un établissement";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #64748b;
        backdrop-filter: blur(4px);
        border-radius: 16px;
        z-index: 10;
    }

    .etablissement-section {
        margin-bottom: 2rem;
        padding: 2rem;

    }

    /* Animations */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: slideIn 0.5s ease-out forwards;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card-header {
            padding: 1.5rem;
        }

        .etablissement-label {
            padding: 1rem;
        }

        .btn-custom {
            padding: 0.5rem 1rem;
        }
    }
</style>
<style>
    /* Styles pour la pagination */
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination .page-link {
        color: #007bff;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: transparent;
        border-color: #dee2e6;
    }

    #pagination-container {
        margin-top: 1rem;
        display: flex;
        justify-content: center;
    }

    /* Autres styles existants */
    .badge-offline {
        background-color: #ffa000;
        color: white;
        padding: 0.2em 0.6em;
        border-radius: 0.25rem;
        font-size: 0.75em;
        margin-left: 0.5em;
    }

    @media (max-width: 768px) {
        .h4 {
            font-size: 1.25rem;
        }

        .btn {
            padding: 0.5rem 1rem;
        }

        .badge-offline {
            font-size: 0.7em;
        }
    }

    #connection-status {
        z-index: 1050;
    }

    .toast-container {
        z-index: 1060;
    }

    .card {
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
    }
</style>
<section class="mb-4">
    <!-- Section Table -->



    <div class="row mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">Liste des Elements d'environnement</h2>
                <p class="text-muted mb-0">Aperçu de la vue des Elements d'environnement</p>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-success" onclick="exportToExcel()">
                    <i class="bi bi-file-excel me-2"></i>Exporter en Excel
                </button>

            </div>
        </div>
    </div>

    <div class="card">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)">
                            </th>
                            <th scope="col">#ID</th>
                            <th scope="col">Date d'ajout</th>
                            <th scope="col">Établissement</th>
                            <th scope="col">Domaine</th>
                            <th scope="col">Contenu</th>
                            <th scope="col">Question PA</th>
                            <th scope="col">Méthode</th>
                            <th scope="col">Réponse</th>
                            <th scope="col">Note Obtenue</th>
                            <th scope="col">Commentaires</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>

            </div>
            <div id="pagination-container" class="mt-3"></div>
        </div>
    </div>



    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
    </div>
</section>


<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script>
    // Points d'accès de l'API online
    const API_ENDPOINTS = {
        SUPERVISIONS: '/api/supervision/environnementElement'
    };

    function formatDate(date) {
        if (!date) return '';

        try {
            const d = new Date(date);
            if (isNaN(d.getTime())) return date;

            const day = d.getDate().toString().padStart(2, '0');
            const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
            const month = months[d.getMonth()];
            const year = d.getFullYear();
            const hours = d.getHours().toString().padStart(2, '0');
            const minutes = d.getMinutes().toString().padStart(2, '0');
            const seconds = d.getSeconds().toString().padStart(2, '0');

            return `${day} ${month} ${year} à ${hours}:${minutes}:${seconds} `;
        } catch (error) {
            console.error('Erreur de formatage de date:', error);
            return date || '';
        }
    }

    // Récupérer les supervisions avec type = 1
    function fetchSupervisions(page = 1) {
        fetch(`${API_ENDPOINTS.SUPERVISIONS}?type=1&page=${page}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderTable(data.data);
                    renderPagination(data.data);
                } else {
                    showToast('Erreur', data.message, 'danger');
                }
            })
            .catch(error => console.error('Erreur récupération:', error));
    }

    // Afficher les supervisions dans la table
    function renderTable(data) {
        const tbody = document.getElementById('table-body');
        tbody.innerHTML = data.data.length === 0 ?
            '<tr><td colspan="11" class="text-center">Aucune supervision trouvée</td></tr>' :
            data.data.map((supervision, index) =>
                `<tr>
                <td><input type="checkbox" value="${supervision.id}"></td>
                <td>${index + 1}</td>
                <td>${formatDate(supervision.created_at)}</td>
                <td>${supervision.etablissements ?? '-'}</td>
                <td>${supervision.domaines?.name_domaine ?? '-'}</td>
                <td>${supervision.continues?.[0]?.name_contenu ?? '-'}</td>
                <td>${supervision.questions?.[0]?.name_question ?? '-'}</td>
                <td>${supervision.methodes?.[0]?.methode_name ?? '-'}</td>
                <td>${supervision.reponse ?? '-'}</td>
                <td>${supervision.note ?? '-'}</td>
                <td>${supervision.commentaire ?? '-'}</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="viewSupervision(${supervision.id})">Voir</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteSupervision(${supervision.id})">Supprimer</button>
                </td>
            </tr>`).join('');
    }

    function renderPagination(data) {
        const paginationContainer = document.getElementById('pagination-container');
        paginationContainer.innerHTML = '';

        let currentPage = data.current_page;
        let lastPage = data.last_page;

        let paginationHTML = `
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="fetchSupervisions(${currentPage - 1})"> <span aria-hidden="true">&laquo;</span></a>
                </li>
    `;

        for (let page = 1; page <= lastPage; page++) {
            paginationHTML += `
            <li class="page-item ${page === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="fetchSupervisions(${page})">${page}</a>
            </li>
        `;
        }

        paginationHTML += `
                <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="fetchSupervisions(${currentPage + 1})"><span aria-hidden="true">&raquo;</span></a>
                </li>
            </ul>
        </nav>
    `;

        paginationContainer.innerHTML = paginationHTML;
    }

    // Voir les détails d'une supervision
    function viewSupervision(id) {
        alert(`Détails de la supervision #${id}`);
    }

    // Supprimer une supervision
    function deleteSupervision(id) {
        if (confirm('Voulez-vous vraiment supprimer cette supervision ?')) {
            fetch(`${API_ENDPOINTS.SUPERVISIONS}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    data.success ? showToast('Succès', 'Supervision supprimée', 'success') : showToast('Erreur', data.message, 'danger');
                    fetchSupervisions();
                })
                .catch(error => console.error('Erreur suppression:', error));
        }
    }

    // Afficher une notification toast
    function showToast(title, message, type = 'info') {
        const container = document.querySelector('.toast-container');
        const toast = document.createElement('div');
        toast.className = `toast bg-${type} fade show`;
        toast.innerHTML = `
        <div class="toast-header">
            <strong class="me-auto">${title}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">${message}</div>`;
        container.appendChild(toast);
        setTimeout(() => toast.remove(), 5000);
    }

    // Tout sélectionner dans la table
    function toggleAllCheckboxes(source) {
        document.querySelectorAll('#table-body input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = source.checked;
        });
    }

    // Charger automatiquement au démarrage
    document.addEventListener('DOMContentLoaded', fetchSupervisions);
</script>


@endsection