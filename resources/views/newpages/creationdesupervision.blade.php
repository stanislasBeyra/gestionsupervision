@extends('layoutsapp.master')
@section('title', 'Supervision')

@section('styles')
<style>
    :root {
        --card-border: #e2e8f0;
        --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        --card-hover: 0 4px 6px rgba(0, 0, 0, 0.1);
        --primary-color: #2563eb;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
    }

    .page-container {
        padding: 32px 24px;
        position: relative;
        min-height: calc(100vh - 58px - 64px);
    }

    @media (max-width: 768px) {
        .page-container {
            padding-top: 40px !important;
            padding: 16px 12px;
        }
    }

    /* Header */
    .page-header {
        margin-bottom: 32px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        display: block;
        visibility: visible;
        opacity: 1;
    }

    .page-subtitle {
        font-size: 15px;
        color: var(--text-secondary);
        margin: 0;
        display: block;
        visibility: visible;
    }

    .header-actions {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: nowrap;
        flex-shrink: 0;
    }

    /* Cards */
    .content-card {
        background: white !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 12px !important;
        padding: 24px !important;
        box-shadow: none !important;
    }

    /* Table */
    .table-wrapper {
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
        position: relative;
    }

    .table {
        margin-bottom: 0 !important;
        width: 100%;
    }

    .table thead th {
        background: #f8fafc !important;
        border-bottom: 2px solid var(--card-border) !important;
        color: var(--text-primary) !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 12px 16px !important;
        white-space: nowrap !important;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table tbody td {
        padding: 14px 16px !important;
        border-bottom: 1px solid #f1f5f9 !important;
        color: var(--text-primary) !important;
        font-size: 14px !important;
        vertical-align: middle !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }

    .table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    /* Buttons */
    .btn-primary-custom {
        background: var(--primary-color) !important;
        border: none !important;
        color: white !important;
        padding: 10px 20px !important;
        border-radius: 8px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .btn-primary-custom:hover {
        background: #1d4ed8 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2) !important;
    }

    .btn-outline-success-custom {
        border: 1px solid #10b981 !important;
        color: #10b981 !important;
        padding: 10px 20px !important;
        border-radius: 8px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
        background: transparent !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .btn-outline-success-custom:hover {
        background: #10b981 !important;
        color: white !important;
        transform: translateY(-1px);
    }

    .btn-secondary-custom {
        background: #f1f5f9 !important;
        border: 1px solid var(--card-border) !important;
        color: var(--text-primary) !important;
        padding: 10px 20px !important;
        border-radius: 8px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
    }

    .btn-secondary-custom:hover {
        background: #e2e8f0 !important;
    }

    /* Pagination */
    .pagination {
        margin-top: 24px !important;
    }

    .pagination .page-link {
        color: var(--primary-color) !important;
        border: 1px solid var(--card-border) !important;
        padding: 8px 12px !important;
        margin: 0 4px !important;
        border-radius: 6px !important;
        transition: all 0.2s ease !important;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: white !important;
    }

    .pagination .page-link:hover {
        background: #f8fafc !important;
    }

    /* Form Controls */
    .form-control, .form-select {
        border: 1px solid var(--card-border) !important;
        border-radius: 8px !important;
        padding: 10px 16px !important;
        font-size: 14px !important;
        transition: all 0.2s ease !important;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
        outline: none !important;
    }

    .form-label {
        color: var(--text-primary) !important;
        font-weight: 500 !important;
        font-size: 14px !important;
        margin-bottom: 8px !important;
    }

    /* Établissement Section */
    .etablissement-section {
        margin-bottom: 32px;
        padding: 24px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid var(--card-border);
    }

    .etablissement-section h5 {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 20px;
    }

    .etablissement-radio {
        display: none;
    }

    .etablissement-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 16px;
        border: 2px solid var(--card-border);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        text-align: center;
        min-height: 80px;
    }

    .etablissement-label:hover {
        transform: translateY(-2px);
        box-shadow: var(--card-hover);
        border-color: var(--primary-color);
    }

    .etablissement-radio:checked + .etablissement-label {
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: white;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
    }

    .etablissement-label span {
        font-size: 13px;
        font-weight: 600;
    }

    /* Method Checkboxes */
    .method-checkboxes {
        background-color: white;
        border: 1px solid var(--card-border) !important;
        border-radius: 8px !important;
        padding: 16px !important;
        max-height: 200px;
        overflow-y: auto;
    }

    .method-checkboxes .form-check {
        margin-bottom: 8px;
    }

    .method-checkboxes .form-check-label {
        cursor: pointer;
        font-size: 14px;
        color: var(--text-primary);
    }

    .method-checkboxes .form-check-input {
        margin-right: 8px;
    }

    .method-checkboxes .form-check-label:hover {
        color: var(--primary-color);
    }

    /* Disabled Overlay */
    .disabled-overlay {
        position: relative;
        pointer-events: none;
        opacity: 0.6;
    }

    .disabled-overlay::after {
        content: "Veuillez d'abord sélectionner un établissement";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 500;
        color: var(--text-secondary);
        border-radius: 12px;
        z-index: 10;
        backdrop-filter: blur(2px);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .page-container {
            padding: 24px 16px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 24px;
        }

        .header-actions {
            margin-top: 16px;
        }
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 16px 12px;
        }

        .page-header {
            margin-bottom: 24px !important;
        }

        .page-header > div {
            flex-direction: column !important;
        }

        .page-header > div > div:first-child {
            margin-bottom: 16px !important;
            width: 100% !important;
            order: 1 !important;
            flex-shrink: 0 !important;
        }

        .header-actions {
            order: 2 !important;
            flex-direction: row;
            flex-wrap: wrap;
            width: 100%;
            margin-top: 0 !important;
            gap: 8px;
        }

        .page-title {
            font-size: 20px !important;
            margin-bottom: 4px !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
            position: relative !important;
            z-index: 1 !important;
            color: var(--text-primary) !important;
        }

        .page-subtitle {
            font-size: 13px !important;
            display: block !important;
            visibility: visible !important;
            color: var(--text-secondary) !important;
        }

        .header-actions .btn {
            flex: 1;
            padding: 12px 16px !important;
            font-size: 14px;
            justify-content: center !important;
        }

        .content-card {
            padding: 16px !important;
        }

        .etablissement-section {
            padding: 16px !important;
        }

        .etablissement-label {
            padding: 12px !important;
            min-height: 60px;
        }

        .etablissement-label span {
            font-size: 11px;
        }
    }

    @media (max-width: 576px) {
        .page-container {
            padding: 12px 8px;
        }

        .page-title {
            font-size: 18px;
        }

        .content-card {
            padding: 12px !important;
        }

        .etablissement-section {
            padding: 12px !important;
        }
    }

    .toast-container {
        z-index: 1060;
    }

    .hidden {
        display: none;
    }

    /* Mobile Cards View */
    .mobile-cards {
        display: none;
    }

    .mobile-card {
        background: white;
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .mobile-card:hover {
        box-shadow: var(--card-hover);
        transform: translateY(-2px);
    }

    .mobile-card-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 12px;
    }

    .mobile-card-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        flex: 1;
    }

    .mobile-card-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        margin-left: 8px;
    }

    .mobile-card-content {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
        font-size: 13px;
    }

    .mobile-card-item {
        display: flex;
        flex-direction: column;
    }

    .mobile-card-label {
        color: var(--text-secondary);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .mobile-card-value {
        color: var(--text-primary);
        font-weight: 500;
    }

    /* Drawer */
    .drawer {
        position: fixed;
        top: 0;
        right: -100%;
        width: 100%;
        max-width: 500px;
        height: 100vh;
        background: white;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1050;
        transition: right 0.3s ease;
        overflow-y: auto;
    }

    .drawer.open {
        right: 0;
    }

    .drawer-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .drawer-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .drawer-header {
        padding: 20px;
        border-bottom: 1px solid var(--card-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        background: white;
        z-index: 10;
    }

    .drawer-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
    }

    .drawer-close {
        background: none;
        border: none;
        font-size: 24px;
        color: var(--text-secondary);
    cursor: pointer;
        padding: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s ease;
    }

    .drawer-close:hover {
        background: #f1f5f9;
        color: var(--text-primary);
    }

    .drawer-body {
        padding: 20px;
    }

    .drawer-section {
        margin-bottom: 24px;
    }

    .drawer-section-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .drawer-item {
        display: flex;
        flex-direction: column;
        margin-bottom: 16px;
    }

    .drawer-label {
        font-size: 12px;
        color: var(--text-secondary);
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .drawer-value {
        font-size: 14px;
        color: var(--text-primary);
        font-weight: 500;
    }

    /* Hide columns on mobile */
    @media (max-width: 768px) {
        .table-wrapper {
            display: none !important;
        }

        .mobile-cards {
            display: block !important;
        }

        .drawer {
            max-width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="page-container">
    @include('layoutsapp.partials.loading', ['size' => 'medium', 'overlay' => true, 'id' => 'loadingSpinner'])

    <!-- Section Tableau -->
    <div id="table-section">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                <div class="mb-3 mb-md-0" style="width: 100%;">
                    <h1 class="page-title">Liste des Supervisions</h1>
                    <p class="page-subtitle">Aperçu de la vue des Supervisions</p>
                </div>
                <div class="header-actions">
                    <button type="button" class="btn btn-outline-success-custom" onclick="exportToExcel()">
                        <i class="fas fa-file-excel"></i>
                        <span class="d-none d-md-inline">Exporter en Excel</span>
                        <span class="d-md-none">Exporter</span>
                    </button>
                    <button type="button" class="btn btn-primary-custom" onclick="showForm()">
                        <i class="fas fa-plus-circle"></i>
                        <span class="d-none d-md-inline">Nouvelle Supervision</span>
                        <span class="d-md-none">Nouvelle</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="content-card">
            <!-- Desktop Table View -->
            <div class="table-wrapper">
                <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleAllCheckboxes(this)">
                                    </div>
                                </th>
                                <th>N°</th>
                                <th>Date d'ajout</th>
                                <th>Établissement</th>
                                <th class="d-none d-md-table-cell">Domaine</th>
                                <th class="d-none d-lg-table-cell">Note Obtenue</th>
                                <th style="text-align: center; width: 60px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
            </div>

            <!-- Mobile Cards View -->
            <div class="mobile-cards" id="mobile-cards">
                <!-- Les cartes mobiles seront ajoutées ici -->
                </div>

                <div id="pagination-container" class="mt-3"></div>
        </div>
    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="hidden">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                <div class="mb-3 mb-md-0">
                    <h1 class="page-title" id="formTitle">Nouvelle</h1>
                    <p class="page-subtitle" id="formSubtitle">Ajouter une nouvelle supervision</p>
                </div>
                <button class="btn btn-secondary-custom" onclick="showTable()">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </button>
            </div>
        </div>

        <div class="content-card">
                <form id="data-form" onsubmit="handleSubmit(event)">
                    <!-- Section Établissement -->
                    <div class="etablissement-section">
                    <h5>Sélection de l'établissement</h5>
                        <div class="row g-3">
                            <div class="col-md-2">
                                <input type="radio" name="etablissement" id="etabCSR" value="CENTRE DE SANTÉ RURAL" class="etablissement-radio" data-type="1" onchange="handleEtablissementChange()">
                                <label for="etabCSR" class="etablissement-label">
                                <span>CENTRE DE SANTÉ RURAL</span>
                                </label>
                            </div>

                            <div class="col-md-2">
                                <input type="radio" name="etablissement" id="etabCSU" value="CENTRE DE SANTÉ URBAIN" class="etablissement-radio" data-type="2" onchange="handleEtablissementChange()">
                                <label for="etabCSU" class="etablissement-label">
                                <span>CENTRE DE SANTÉ URBAIN</span>
                                </label>
                            </div>

                            <div class="col-md-2">
                                <input type="radio" name="etablissement" id="CS" value="CENTRE SPECIALISÉ" class="etablissement-radio" data-type="3" onchange="handleEtablissementChange()">
                                <label for="CS" class="etablissement-label">
                                <span>CENTRE SPECIALISÉ</span>
                                </label>
                            </div>

                            <div class="col-md-3">
                                <input type="radio" name="etablissement" id="etabDR" value="DISPENSAIRE RURAL" class="etablissement-radio" data-type="4" onchange="handleEtablissementChange()">
                                <label for="etabDR" class="etablissement-label">
                                <span>DISPENSAIRE RURAL</span>
                                </label>
                            </div>

                            <div class="col-md-3">
                                <input type="radio" name="etablissement" id="etabEPHD" value="EPHD" class="etablissement-radio" data-type="5" onchange="handleEtablissementChange()">
                                <label for="etabEPHD" class="etablissement-label">
                                <span>ETABLISSEMENT PUBLIC HOSPITALIER DEPARTEMENTAL</span>
                                </label>
                            </div>

                            <div class="col-md-3">
                                <input type="radio" name="etablissement" id="etabEPHN" value="EPHN" class="etablissement-radio" data-type="6" onchange="handleEtablissementChange()">
                                <label for="etabEPHN" class="etablissement-label">
                                <span>ETABLISSEMENT PUBLIC HOSPITALIER NATIONAL</span>
                                </label>
                            </div>

                            <div class="col-md-3">
                                <input type="radio" name="etablissement" id="etabEPHR" value="EPHR" class="etablissement-radio" data-type="7" onchange="handleEtablissementChange()">
                                <label for="etabEPHR" class="etablissement-label">
                                <span>ETABLISSEMENT PUBLIC HOSPITALIER REGiONAL</span>
                                </label>
                            </div>

                            <div class="col-md-3">
                                <input type="radio" name="etablissement" id="etabFSU" value="FSU" class="etablissement-radio" data-type="8" onchange="handleEtablissementChange()">
                                <label for="etabFSU" class="etablissement-label">
                                <span>FSU</span>
                                </label>
                            </div>

                            <div class="col-md-3">
                                <input type="radio" name="etablissement" id="etabFSU COM" value="FSU COM" class="etablissement-radio" data-type="9" onchange="handleEtablissementChange()">
                                <label for="etabFSU COM" class="etablissement-label">
                                <span>FSU COM</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Autres champs du formulaire -->
                    <div id="form-fields" class="disabled-overlay">
                    <div class="row g-4">
                        <div class="col-md-6">
                                <label class="form-label">Domaine</label>
                                <select id="domaine" name="domaine" class="form-select" required disabled>
                                    <option value="">Sélectionnez un domaine</option>
                                </select>
                            </div>

                        <div class="col-md-6">
                                <label class="form-label">Contenu</label>
                                <select id="contenu" name="contenu" class="form-select" required disabled>
                                    <option value="">Sélectionnez un contenu</option>
                                </select>
                            </div>

                        <div class="col-md-6">
                                <label class="form-label">Question</label>
                                <select id="question" name="question" class="form-select" required disabled>
                                    <option value="">Sélectionnez une question</option>
                                </select>
                            </div>

                        <div class="col-md-6">
                                <label class="form-label">Méthode(s)</label>
                            <div class="method-checkboxes">
                                    <div id="methodList">
                                        <!-- Les méthodes seront ajoutées ici dynamiquement -->
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-6">
                                <label class="form-label">Note Obtenue</label>
                                <select id="note" name="note" class="form-select" required disabled>
                                    <option value="">Sélectionnez une note</option>
                                </select>
                            </div>

                        <div class="col-md-6">
                            <label class="form-label">Type</label>
                            <select id="type" name="type" class="form-select" required disabled>
                                <option value="">Sélectionnez un type</option>
                                    <option value="1">Element d'environnement</option>
                                    <option value="2">Element de compétance</option>
                                </select>
                            </div>

                        <div class="col-md-6">
                                <label class="form-label">Réponse Constat</label>
                            <input type="text" id="reponse" name="reponse" class="form-control" required disabled>
                            </div>

                        <div class="col-md-6">
                                <label class="form-label">Commentaires</label>
                                <textarea id="commentaire" name="commentaire" class="form-control" rows="3" required disabled></textarea>
                            </div>
                        </div>
                    </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary-custom" onclick="showTable()">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                    </div>
                </form>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3"></div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
    </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cette supervision ? Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Drawer pour les détails -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
    <div class="drawer" id="detailDrawer">
        <div class="drawer-header">
            <h2 class="drawer-title">Détails de la supervision</h2>
            <button class="drawer-close" onclick="closeDrawer()">
                <i class="fas fa-times"></i>
            </button>
    </div>
        <div class="drawer-body" id="drawerBody">
            <!-- Le contenu sera ajouté dynamiquement -->
        </div>
    </div>
</div>

<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script>
    // Points d'accès de l'API
    const API_ENDPOINTS = {
        DOMAINES: '/api/domaine',
        CONTENUS: '/api/contenu',
        QUESTIONS: '/api/allquestion',
        METHODES: '/api/methodes',
        NOTES: '/api/note',
        SUPERVISIONS: '/api/supervision',
        SAVESUPERVISONS: '/api/supervision/save',
        DELETESUPERVISION: '/api/supervision/delete'
    };

    // ID de l'utilisateur connecté
    const CURRENT_USER_ID = {{ auth()->id() }};
    
    // Clés de stockage local (avec ID utilisateur pour l'isolation)
    const STORAGE_KEYS = {
        SUPERVISIONS: `offline_supervisions_${CURRENT_USER_ID}`,
        PENDING_SUPERVISIONS: `pending_supervisions_${CURRENT_USER_ID}`,
        DOMAINES: 'cached_domaines', // Données partagées (pas de user_id)
        CONTENUS: 'cached_contenus', // Données partagées (pas de user_id)
        QUESTIONS: 'cached_questions', // Données partagées (pas de user_id)
        METHODES: 'cached_methodes', // Données partagées (pas de user_id)
        NOTES: 'cached_notes', // Données partagées (pas de user_id)
        LAST_SYNC: `last_sync_timestamp_${CURRENT_USER_ID}`
    };

    // Types d'établissements
    const ETABLISSEMENT_TYPES = {
        'CENTRE DE SANTÉ RURAL': 1,
        'CENTRE DE SANTÉ URBAIN': 2,
        'CENTRE SPECIALISÉ': 3,
        'DISPENSAIRE RURAL': 4,
        'EPHD': 5,
        'EPHN': 6,
        'EPHR': 7,
        'FSU': 8,
        'FSU COM': 9
    };

    // Cache global pour les questions
    let cachedQuestions = [];

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

            return `${day} ${month} ${year} à ${hours}:${minutes}:${seconds}`;
        } catch (error) {
            console.error('Erreur de formatage de date:', error);
            return date || '';
        }
    }

    // Gestionnaire des alertes
    class AlertManager {
        static showAlert(message, type) {
            const toastContainer = document.querySelector('.toast-container');
            if (!toastContainer) return;

            const toast = document.createElement('div');
            toast.className = `toast show align-items-center text-white bg-${type} border-0`;
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;

            toastContainer.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        static showSuccess(message) {
            this.showAlert(message, 'success');
        }

        static showError(message) {
            this.showAlert(message, 'danger');
        }

        static showWarning(message) {
            this.showAlert(message, 'warning');
        }
    }

    // Gestionnaire du cache
    class CacheManager {
        static set(key, data, expirationInHours = 24) {
            try {
                const cacheData = {
                    data: data,
                    timestamp: new Date().getTime(),
                    expiration: new Date().getTime() + (expirationInHours * 60 * 60 * 1000)
                };
                localStorage.setItem(key, JSON.stringify(cacheData));
            } catch (error) {
                console.error(`Erreur lors de la mise en cache pour ${key}:`, error);
                this.clearExpiredCache();
            }
        }

        static get(key) {
            try {
                const cached = localStorage.getItem(key);
                if (!cached) return null;

                const parsedCache = JSON.parse(cached);
                if (new Date().getTime() > parsedCache.expiration) {
                    localStorage.removeItem(key);
                    return null;
                }

                return parsedCache.data;
            } catch (error) {
                console.error(`Erreur lors de la récupération du cache pour ${key}:`, error);
                return null;
            }
        }

        static getPendingSupervisions() {
            return this.get(STORAGE_KEYS.PENDING_SUPERVISIONS) || [];
        }

        static addPendingSupervision(supervision) {
            const pending = this.getPendingSupervisions();
            pending.push(supervision);
            this.set(STORAGE_KEYS.PENDING_SUPERVISIONS, pending);
        }

        static clearPendingSupervisions() {
            localStorage.removeItem(STORAGE_KEYS.PENDING_SUPERVISIONS);
        }

        static clearExpiredCache() {
            Object.values(STORAGE_KEYS).forEach(key => {
                try {
                    const cached = localStorage.getItem(key);
                    if (cached) {
                        const parsedCache = JSON.parse(cached);
                        if (new Date().getTime() > parsedCache.expiration) {
                            localStorage.removeItem(key);
                        }
                    }
                } catch (error) {
                    localStorage.removeItem(key);
                }
            });
        }
    }

    // Gestionnaire des données
    class DataManager {
        static async fetchData(endpoint) {
            try {
                const response = await fetch(endpoint);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return await response.json();
            } catch (error) {
                console.error(`Erreur lors de la récupération des données depuis ${endpoint}:`, error);
                throw error;
            }
        }

        static async loadSelectData(endpoint, selectId, defaultText = "Sélectionnez une option", etablissementType = null) {
            try {
                if (selectId === 'method') {
                    const methodList = document.getElementById('methodList');
                    if (!methodList) throw new Error('Élément methodList non trouvé');

                    const response = await this.fetchData(endpoint);
                    const items = response.data || [];

                    methodList.innerHTML = items.map(item => `
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input method-checkbox"
                                id="method_${item.id}"
                                name="method[]"
                                value="${item.id}">
                            <label class="form-check-label" for="method_${item.id}">
                                ${item.methode_name}
                            </label>
                        </div>
                    `).join('');
                    return;
                }

                const select = document.getElementById(selectId);
                if (!select) throw new Error(`Élément select avec l'ID ${selectId} non trouvé`);

                const response = await this.fetchData(endpoint);
                select.innerHTML = `<option value="">${defaultText}</option>`;

                let items = [];

                switch (selectId) {
                    case 'domaine':
                        items = response.domaine || [];
                        items.forEach(item => {
                            select.innerHTML += `<option value="${item.id}">${item.name_domaine}</option>`;
                        });
                        break;

                    case 'contenu':
                        items = response.contenu || [];
                        items.forEach(item => {
                            select.innerHTML += `<option value="${item.id}">${item.name_contenu}</option>`;
                        });
                        break;

                    case 'question':
                        items = response.questions || [];
                        cachedQuestions = items;
                        if (etablissementType) {
                            items = items.filter(item => item.type === etablissementType);
                        }
                        items.forEach(item => {
                            select.innerHTML += `<option value="${item.id}">${item.name_question}</option>`;
                        });
                        break;

                    case 'note':
                        items = response.data || [];
                        items.forEach(item => {
                            select.innerHTML += `<option value="${item.id}">${item.note_name}</option>`;
                        });
                        break;

                    default:
                        console.warn(`Type de select non géré: ${selectId}`);
                }
            } catch (error) {
                AlertManager.showError(`Erreur lors du chargement des données pour ${selectId}`);
                console.error(error);
            }
        }
    }

    // Gestionnaire de navigation
    class NavigationManager {
        static async handleEtablissementChange() {
            const etablissement = document.querySelector('input[name="etablissement"]:checked');
            const formFields = document.getElementById('form-fields');
            const formInputs = formFields.querySelectorAll('select, input, textarea');
            const questionSelect = document.getElementById('question');

            if (etablissement) {
                formFields.classList.remove('disabled-overlay');
                formInputs.forEach(input => {
                    input.disabled = false;
                });

                const etablissementType = parseInt(etablissement.getAttribute('data-type'));

                try {
                    await DataManager.loadSelectData(API_ENDPOINTS.QUESTIONS, 'question', 'Sélectionnez une question', etablissementType);
                } catch (error) {
                    console.error('Erreur lors du chargement des questions filtrées:', error);
                    AlertManager.showError('Erreur lors du chargement des questions');
                }
            } else {
                formFields.classList.add('disabled-overlay');
                formInputs.forEach(input => {
                    input.disabled = true;
                });

                if (questionSelect) {
                    questionSelect.innerHTML = '<option value="">Sélectionnez une question</option>';
                }
            }
        }

        static showForm() {
            document.getElementById('form-section').classList.remove('hidden');
            document.getElementById('table-section').classList.add('hidden');
            document.getElementById('data-form').reset();
            this.handleEtablissementChange();
        }

        static showTable() {
            document.getElementById('form-section').classList.add('hidden');
            document.getElementById('table-section').classList.remove('hidden');
        }

        static toggleAllCheckboxes(source) {
            const checkboxes = document.querySelectorAll('#table-body input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
            SupervisionManager.updateDeleteButton();
        }
    }

    // Gestionnaire de supervision
    class SupervisionManager {
        static currentPage = 1;
        static paginationInfo = null;

        static async loadSupervisions(page = 1) {
            try {
                if (typeof window.showLoadingWithTimeout === 'function') {
                    window.showLoadingWithTimeout();
                }

                const tbody = document.getElementById('table-body');
                const mobileCards = document.getElementById('mobile-cards');
                if (!tbody) throw new Error('Élément table-body non trouvé');

                tbody.innerHTML = '';
                if (mobileCards) mobileCards.innerHTML = '';
                let supervisions = [];
                const pendingSupervisions = CacheManager.getPendingSupervisions();

                if (navigator.onLine) {
                    try {
                        const response = await DataManager.fetchData(`${API_ENDPOINTS.SUPERVISIONS}?page=${page}`);
                        if (response && response.data) {
                            supervisions = response.data.data;
                            this.paginationInfo = {
                                currentPage: response.data.current_page,
                                lastPage: response.data.last_page,
                                total: response.data.total,
                                perPage: response.data.per_page,
                                links: response.data.links
                            };
                            this.currentPage = page;
                            this.renderPagination();
                        }

                        if (page === 1) {
                            supervisions = [...supervisions, ...pendingSupervisions];
                        }
                    } catch (error) {
                        console.error('Erreur serveur:', error);
                        AlertManager.showWarning('Utilisation des données en cache');
                        supervisions = [...CacheManager.get(STORAGE_KEYS.SUPERVISIONS) || [], ...pendingSupervisions];
                    }
                } else {
                    supervisions = [...CacheManager.get(STORAGE_KEYS.SUPERVISIONS) || [], ...pendingSupervisions];
                    if (supervisions.length > 0) {
                        AlertManager.showWarning('Mode hors ligne - Utilisation des données en cache');
                    }
                }

                supervisions.forEach((supervision, index) => {
                    if (supervision && typeof supervision === 'object') {
                        this.addRowToTable(supervision, index);
                    }
                });

            } catch (error) {
                console.error('Erreur lors du chargement des supervisions:', error);
                AlertManager.showError('Erreur lors du chargement des données');
            } finally {
                if (typeof window.hideLoadingWithTimeout === 'function') {
                    window.hideLoadingWithTimeout();
                } else if (typeof window.hideLoading === 'function') {
                    window.hideLoading();
                }
            }
        }

        static renderPagination() {
            const paginationContainer = document.getElementById('pagination-container');
            if (!paginationContainer || !this.paginationInfo) return;

            const {
                currentPage,
                lastPage,
                links
            } = this.paginationInfo;

            let paginationHTML = `
            <nav aria-label="Pagination des supervisions">
                <ul class="pagination pagination-circle justify-content-center">
        `;

            paginationHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="SupervisionManager.loadSupervisions(${currentPage - 1})" ${currentPage === 1 ? 'tabindex="-1" aria-disabled="true"' : ''}>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        `;

            links.forEach(link => {
                if (link.url && !link.label.includes('Previous') && !link.label.includes('Next')) {
                    paginationHTML += `
                    <li class="page-item ${link.active ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="SupervisionManager.loadSupervisions(${link.label})">
                            ${link.label}
                        </a>
                    </li>
                `;
                }
            });

            paginationHTML += `
            <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="SupervisionManager.loadSupervisions(${currentPage + 1})" ${currentPage === lastPage ? 'tabindex="-1" aria-disabled="true"' : ''}>
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        `;

            paginationHTML += `
                </ul>
            </nav>
        `;

            paginationContainer.innerHTML = paginationHTML;
        }

        static addRowToTable(supervision, index) {
            const tbody = document.getElementById('table-body');
            const mobileCards = document.getElementById('mobile-cards');
            if (!tbody || !supervision) return;

            const getSelectText = (selectId, value) => {
                if (selectId === 'method' && value) {
                    const methodIds = value.split(',');
                    const methodNames = methodIds.map(id => {
                        const methodLabel = document.querySelector(`label[for="method_${id.trim()}"]`);
                        return methodLabel ? methodLabel.textContent.trim() : id;
                    });
                    return methodNames.join(', ');
                }

                const select = document.getElementById(selectId);
                if (select) {
                    const option = select.querySelector(`option[value="${value}"]`);
                    return option ? option.textContent : value;
                }
                return value;
            };

            const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';

            // Ligne du tableau desktop
            const row = document.createElement('tr');
            row.setAttribute('data-id', supervision.id);
            row.setAttribute('data-supervision', JSON.stringify(supervision));

            row.innerHTML = `
            <td onclick="event.stopPropagation()">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" onchange="SupervisionManager.updateDeleteButton()">
                </div>
            </td>
            <td>${index + 1}</td>
            <td>${formatDate(supervision.created_at)}</td>
            <td style="cursor: pointer; color: var(--primary-color);" onclick="SupervisionManager.openDrawerFromRow(this.closest('tr'))">${safeText(supervision.etablissements || '')}</td>
            <td class="d-none d-md-table-cell">${safeText(getSelectText('domaine', supervision.domaine) || supervision.domaine || '')}</td>
            <td class="d-none d-lg-table-cell">${safeText(getSelectText('note', supervision.note) || supervision.note || '')}</td>
            <td onclick="event.stopPropagation()">
                <button class="btn btn-primary btn-sm" onclick="SupervisionManager.openDrawerFromRow(this.closest('tr'))" title="Voir détails">
                    <i class="fas fa-eye"></i>
                </button>
            </td>
        `;
            tbody.appendChild(row);

            // Carte mobile
            if (mobileCards) {
                this.addMobileCard(supervision, index, getSelectText);
            }
        }

        static addMobileCard(supervision, index, getSelectText) {
            const mobileCards = document.getElementById('mobile-cards');
            if (!mobileCards) return;

            const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
            const card = document.createElement('div');
            card.className = 'mobile-card';
            card.onclick = () => this.openDrawer(supervision);
            card.setAttribute('data-supervision', JSON.stringify(supervision));
            card.setAttribute('data-id', supervision.id);

            card.innerHTML = `
                <div class="mobile-card-header">
                    <h3 class="mobile-card-title">Supervision #${index + 1}</h3>
                </div>
                <div class="mobile-card-content">
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Date d'ajout</span>
                        <span class="mobile-card-value">${formatDate(supervision.created_at)}</span>
                    </div>
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Établissement</span>
                        <span class="mobile-card-value">${safeText(supervision.etablissements || 'N/A')}</span>
                    </div>
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Domaine</span>
                        <span class="mobile-card-value">${safeText(getSelectText('domaine', supervision.domaine) || supervision.domaine || 'N/A')}</span>
                    </div>
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Note Obtenue</span>
                        <span class="mobile-card-value">${safeText(getSelectText('note', supervision.note) || supervision.note || 'N/A')}</span>
                    </div>
                </div>
            `;
            mobileCards.appendChild(card);
        }

        static openDrawerFromRow(row) {
            const supervisionData = row.getAttribute('data-supervision');
            if (supervisionData) {
                try {
                    const supervision = JSON.parse(supervisionData);
                    this.openDrawer(supervision);
                } catch (e) {
                    console.error('Erreur parsing:', e);
                }
            }
        }

        static openDrawer(supervision) {
            const drawer = document.getElementById('detailDrawer');
            const overlay = document.getElementById('drawerOverlay');
            const drawerBody = document.getElementById('drawerBody');

            if (!drawer || !overlay || !drawerBody) return;

            const getSelectText = (selectId, value) => {
                if (selectId === 'method' && value) {
                    const methodIds = value.split(',');
                    const methodNames = methodIds.map(id => {
                        const methodLabel = document.querySelector(`label[for="method_${id.trim()}"]`);
                        return methodLabel ? methodLabel.textContent.trim() : id;
                    });
                    return methodNames.join(', ');
                }

                const select = document.getElementById(selectId);
                if (select) {
                    const option = select.querySelector(`option[value="${value}"]`);
                    return option ? option.textContent : value;
                }
                return value;
            };

            const safeText = (text) => text ? text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';

            drawerBody.innerHTML = `
                <div class="drawer-section">
                    <h3 class="drawer-section-title">Informations générales</h3>
                    <div class="drawer-item">
                        <span class="drawer-label">Date d'ajout</span>
                        <span class="drawer-value">${formatDate(supervision.created_at)}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Établissement</span>
                        <span class="drawer-value">${safeText(supervision.etablissements || 'N/A')}</span>
                    </div>
                </div>

                <div class="drawer-section">
                    <h3 class="drawer-section-title">Détails de la supervision</h3>
                    <div class="drawer-item">
                        <span class="drawer-label">Domaine</span>
                        <span class="drawer-value">${safeText(getSelectText('domaine', supervision.domaine) || supervision.domaine || 'N/A')}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Contenu</span>
                        <span class="drawer-value">${safeText(getSelectText('contenu', supervision.contenu) || supervision.contenu || 'N/A')}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Question PA</span>
                        <span class="drawer-value">${safeText(getSelectText('question', supervision.question) || supervision.question || 'N/A')}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Méthode(s)</span>
                        <span class="drawer-value">${safeText(getSelectText('method', supervision.methode) || supervision.methode || 'N/A')}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Réponse Constat</span>
                        <span class="drawer-value">${safeText(supervision.reponse || 'N/A')}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Note Obtenue</span>
                        <span class="drawer-value">${safeText(getSelectText('note', supervision.note) || supervision.note || 'N/A')}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Commentaires</span>
                        <span class="drawer-value">${safeText(supervision.commentaire || 'N/A')}</span>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-danger" onclick="SupervisionManager.showDeleteModalFromDrawer('${supervision.id}')">
                        <i class="fas fa-trash me-2"></i>Supprimer
                    </button>
                </div>
            `;

            drawer.classList.add('open');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        static showDeleteModalFromDrawer(identifier) {
            closeDrawer();
            const modalElement = document.getElementById('deleteModal');
            if (!modalElement) return;
            
            // Réutiliser l'instance existante ou en créer une nouvelle
            let modal;
            if (modalElement._mdbModal) {
                modal = modalElement._mdbModal;
            } else {
                modal = new mdb.Modal(modalElement);
                modalElement._mdbModal = modal;
            }
            
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            if (!confirmBtn) return;
            
            // Trouver la supervision et son ID
            let supervisionId = null;
            let supervision = null;
            
            const rows = document.querySelectorAll('#table-body tr');
            for (const row of rows) {
                const supervisionData = row.getAttribute('data-supervision');
                if (supervisionData) {
                    try {
                        const sup = JSON.parse(supervisionData);
                        if (sup.id && sup.id.toString() === identifier) {
                            supervisionId = sup.id;
                            supervision = sup;
                            break;
                        }
                    } catch (e) {
                        console.error('Erreur parsing:', e);
                    }
                }
            }
            
            // Supprimer l'ancien gestionnaire d'événement
            const newConfirmBtn = confirmBtn.cloneNode(true);
            confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
            
            // Ajouter le nouveau gestionnaire
            newConfirmBtn.onclick = async () => {
                if (!supervisionId) {
                    // Pas d'ID, supprimer juste du DOM
                    const cards = document.querySelectorAll('.mobile-card');
                    const rows = document.querySelectorAll('#table-body tr');
                    
                    cards.forEach(card => {
                        const cardId = card.getAttribute('data-id');
                        if (cardId && cardId.toString() === identifier) {
                            card.remove();
                        }
                    });
                    
                    rows.forEach(row => {
                        const rowId = row.getAttribute('data-id');
                        if (rowId && rowId.toString() === identifier) {
                            row.remove();
                        }
                    });
                    
                    AlertManager.showSuccess('Supervision supprimée');
                    modal.hide();
                    return;
                }
                
                // Supprimer via API
                try {
                    if (navigator.onLine) {
                        const response = await fetch(`${API_ENDPOINTS.SUPERVISIONS}/delete`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ id: parseInt(supervisionId) })
                        });

                        const data = await response.json();

                        if (!response.ok || !data.success) {
                            throw new Error(data.message || 'Erreur lors de la suppression');
                        }

                        // Supprimer du DOM
                        const cards = document.querySelectorAll('.mobile-card');
                        const rows = document.querySelectorAll('#table-body tr');
                        
                        cards.forEach(card => {
                            const cardId = card.getAttribute('data-id');
                            if (cardId && cardId.toString() === supervisionId.toString()) {
                                card.remove();
                            }
                        });
                        
                        rows.forEach(row => {
                            const rowId = row.getAttribute('data-id');
                            if (rowId && rowId.toString() === supervisionId.toString()) {
                                row.remove();
                            }
                        });

                        AlertManager.showSuccess('Supervision supprimée avec succès');
                        await this.loadSupervisions();
                    } else {
                        // Mode hors ligne
                        const pendingSupervisions = CacheManager.getPendingSupervisions();
                        const updatedPending = pendingSupervisions.filter(sup => sup.id !== parseInt(supervisionId));
                        CacheManager.set(STORAGE_KEYS.PENDING_SUPERVISIONS, updatedPending);

                        const cachedData = CacheManager.get(STORAGE_KEYS.SUPERVISIONS) || [];
                        const updatedCache = cachedData.filter(sup => sup.id !== parseInt(supervisionId));
                        CacheManager.set(STORAGE_KEYS.SUPERVISIONS, updatedCache);

                        // Supprimer du DOM
                        const cards = document.querySelectorAll('.mobile-card');
                        const rows = document.querySelectorAll('#table-body tr');
                        
                        cards.forEach(card => {
                            const cardId = card.getAttribute('data-id');
                            if (cardId && cardId.toString() === supervisionId.toString()) {
                                card.remove();
                            }
                        });
                        
                        rows.forEach(row => {
                            const rowId = row.getAttribute('data-id');
                            if (rowId && rowId.toString() === supervisionId.toString()) {
                                row.remove();
                            }
                        });

                        AlertManager.showSuccess('Supervision supprimée (mode hors ligne)');
                    }
                } catch (error) {
                    console.error('Erreur lors de la suppression:', error);
                    AlertManager.showError(error.message || 'Erreur lors de la suppression');
                }
                
                modal.hide();
            };
            
            modal.show();
        }

        static async handleSubmit(event) {
            event.preventDefault();

            const etablissement = document.querySelector('input[name="etablissement"]:checked');
            if (!etablissement) {
                AlertManager.showError('Veuillez sélectionner un établissement');
                return;
            }

            const selectedMethods = Array.from(document.querySelectorAll('.method-checkbox:checked')).map(cb => cb.value);

            if (selectedMethods.length === 0) {
                AlertManager.showError('Veuillez sélectionner au moins une méthode');
                return;
            }

            const formData = {
                id: Date.now(),
                etablissements: etablissement.value,
                type: document.getElementById('type').value,
                domaine: document.getElementById('domaine').value,
                contenu: document.getElementById('contenu').value,
                question: document.getElementById('question').value,
                methode: selectedMethods.join(','),
                reponse: document.getElementById('reponse').value,
                note: document.getElementById('note').value,
                commentaire: document.getElementById('commentaire').value,
                timestamp: new Date().toISOString()
            };

            try {
                if (navigator.onLine) {
                    const response = await fetch(API_ENDPOINTS.SAVESUPERVISONS, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(formData)
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Erreur lors de l\'enregistrement');
                    }

                    AlertManager.showSuccess('Données enregistrées avec succès');
                    document.getElementById('data-form').reset();
                    document.querySelectorAll('.method-checkbox').forEach(cb => cb.checked = false);
                    NavigationManager.showTable();
                    await this.loadSupervisions();
                } else {
                    CacheManager.addPendingSupervision(formData);
                    AlertManager.showSuccess('Données sauvegardées localement - En attente de synchronisation');
                    document.getElementById('data-form').reset();
                    document.querySelectorAll('.method-checkbox').forEach(cb => cb.checked = false);
                    NavigationManager.showTable();
                    await this.loadSupervisions();
                }
            } catch (error) {
                console.error('Erreur lors de l\'enregistrement:', error);
                AlertManager.showError(error.message || 'Erreur lors de l\'enregistrement');
                return;
            }
        }

        static async syncPendingSupervisions() {
            const pendingSupervisions = CacheManager.getPendingSupervisions();
            if (!pendingSupervisions.length) return;

            const successfulSyncs = [];
            const errors = [];

            for (const supervision of pendingSupervisions) {
                try {
                    const response = await fetch(API_ENDPOINTS.SAVESUPERVISONS, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(supervision)
                    });

                    if (response.ok) {
                        successfulSyncs.push(supervision.id);
                    } else {
                        errors.push({
                            id: supervision.id,
                            error: 'Erreur de réponse serveur'
                        });
                    }
                } catch (error) {
                    errors.push({
                        id: supervision.id,
                        error: error.message
                    });
                }
            }

            if (successfulSyncs.length > 0) {
                const remainingPending = pendingSupervisions.filter(
                    sup => !successfulSyncs.includes(sup.id)
                );
                CacheManager.set(STORAGE_KEYS.PENDING_SUPERVISIONS, remainingPending);

                if (successfulSyncs.length === pendingSupervisions.length) {
                    AlertManager.showSuccess('Toutes les données ont été synchronisées avec succès');
                } else {
                    AlertManager.showSuccess(`${successfulSyncs.length} supervision(s) synchronisée(s)`);
                }
            }

            if (errors.length > 0) {
                AlertManager.showWarning(`${errors.length} supervision(s) n'ont pas pu être synchronisée(s)`);
            }

            return {
                successfulSyncs,
                errors
            };
        }

        static updateDeleteButton() {
            const deleteBtn = document.getElementById('deleteSelectedBtn');
            const anyChecked = document.querySelectorAll('#table-body input[type="checkbox"]:checked').length > 0;
            deleteBtn?.classList.toggle('d-none', !anyChecked);
        }

        static async deleteRow(button) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) return;

            const row = button.closest('tr');
            const id = row.getAttribute('data-id');

            try {
                if (navigator.onLine) {
                    const response = await fetch(`${API_ENDPOINTS.SUPERVISIONS}/delete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ id: parseInt(id) })
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Erreur lors de la suppression');
                    }

                    row.remove();
                    this.updateDeleteButton();
                    AlertManager.showSuccess('Élément supprimé avec succès');
                    await this.loadSupervisions();
                } else {
                    const pendingSupervisions = CacheManager.getPendingSupervisions();
                    const updatedPending = pendingSupervisions.filter(sup => sup.id !== parseInt(id));
                    CacheManager.set(STORAGE_KEYS.PENDING_SUPERVISIONS, updatedPending);

                    const cachedData = CacheManager.get(STORAGE_KEYS.SUPERVISIONS) || [];
                    const updatedCache = cachedData.filter(sup => sup.id !== parseInt(id));
                    CacheManager.set(STORAGE_KEYS.SUPERVISIONS, updatedCache);

                    row.remove();
                    this.updateDeleteButton();
                    AlertManager.showSuccess('Élément supprimé avec succès (mode hors ligne)');
                }
            } catch (error) {
                console.error('Erreur lors de la suppression:', error);
                AlertManager.showError(error.message || 'Erreur lors de la suppression');
            }
        }

        static async deleteSelectedRows() {
            if (!confirm('Êtes-vous sûr de vouloir supprimer les éléments sélectionnés ?')) return;

            const selectedRows = document.querySelectorAll('#table-body input[type="checkbox"]:checked');
            for (const checkbox of selectedRows) {
                const row = checkbox.closest('tr');
                await this.deleteRow(row.querySelector('.btn-danger'));
            }
        }
    }

    // Export Excel
    function exportToExcel() {
        try {
            const table = document.querySelector('table');
            if (!table) throw new Error('Table non trouvée');

            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.table_to_sheet(table, {
                raw: true,
                display: false,
                skipHidden: true
            });

            ws['!cols'] = Array(table.rows[0].cells.length).fill({
                wch: 15
            });

            XLSX.utils.book_append_sheet(wb, ws, "Supervision");
            XLSX.writeFile(wb, `supervision_${new Date().toISOString().split('T')[0]}.xlsx`);

            AlertManager.showSuccess('Export Excel réussi');
        } catch (error) {
            console.error('Erreur lors de l\'export Excel:', error);
            AlertManager.showError('Erreur lors de l\'export Excel');
        }
    }

    // Fonctions globales pour le loading
    window.showLoading = function() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            spinner.classList.remove('hidden');
            spinner.style.removeProperty('display');
        }
    };

    window.hideLoading = function() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            spinner.classList.add('hidden');
            spinner.style.setProperty('display', 'none', 'important');
        }
    };

    window.showLoadingWithTimeout = function() {
        window.showLoading();
        setTimeout(() => {
            window.hideLoading();
        }, 10000);
    };

    window.hideLoadingWithTimeout = function() {
        window.hideLoading();
    };

    // Fonction globale pour fermer le drawer
    function closeDrawer() {
        const drawer = document.getElementById('detailDrawer');
        const overlay = document.getElementById('drawerOverlay');
        
        if (drawer) {
            drawer.classList.remove('open');
        }
        if (overlay) {
            overlay.classList.remove('show');
        }
        document.body.style.overflow = '';
    }

    // Configuration globale
    function setupGlobalHandlers() {
        window.showForm = NavigationManager.showForm.bind(NavigationManager);
        window.showTable = NavigationManager.showTable.bind(NavigationManager);
        window.handleEtablissementChange = NavigationManager.handleEtablissementChange.bind(NavigationManager);
        window.handleSubmit = SupervisionManager.handleSubmit.bind(SupervisionManager);
        window.deleteSelectedRows = SupervisionManager.deleteSelectedRows.bind(SupervisionManager);
        window.toggleAllCheckboxes = NavigationManager.toggleAllCheckboxes.bind(NavigationManager);
        window.exportToExcel = exportToExcel;
        window.closeDrawer = closeDrawer;
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            setupGlobalHandlers();

            await Promise.all([
                DataManager.loadSelectData(API_ENDPOINTS.DOMAINES, 'domaine', 'Sélectionnez un domaine'),
                DataManager.loadSelectData(API_ENDPOINTS.CONTENUS, 'contenu', 'Sélectionnez un contenu'),
                DataManager.loadSelectData(API_ENDPOINTS.QUESTIONS, 'question', 'Sélectionnez une question'),
                DataManager.loadSelectData(API_ENDPOINTS.METHODES, 'method', 'Sélectionnez une méthode'),
                DataManager.loadSelectData(API_ENDPOINTS.NOTES, 'note', 'Sélectionnez une note'),
                SupervisionManager.loadSupervisions()
            ]);

            window.addEventListener('online', async () => {
                AlertManager.showSuccess('Connexion rétablie');
                await SupervisionManager.syncPendingSupervisions();
                await SupervisionManager.loadSupervisions();
            });

            window.addEventListener('offline', () => {
                AlertManager.showWarning('Mode hors ligne activé - Les données seront synchronisées automatiquement');
            });

        } catch (error) {
            console.error('Erreur lors de l\'initialisation:', error);
            AlertManager.showError('Erreur lors du chargement initial des données');
        }
    });
</script>

@endsection

