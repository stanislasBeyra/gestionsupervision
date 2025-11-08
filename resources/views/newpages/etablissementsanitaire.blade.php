@extends('layoutsapp.master')
@section('title', 'Établissements Sanitaires')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

        .table tbody td:first-child {
            max-width: 50px !important;
        }

        .table tbody td:nth-child(2) {
            max-width: 60px !important;
        }

        .table tbody td:nth-child(3),
        .table tbody td:nth-child(4) {
            max-width: 180px !important;
        }

        .table tbody td:nth-child(5) {
            max-width: 250px !important;
        }

        .table tbody td:nth-child(6) {
            max-width: 150px !important;
        }

        .table tbody td:nth-child(7) {
            max-width: 200px !important;
        }

        .table tbody td:last-child {
            max-width: 120px !important;
        }

        .table tbody td {
            padding: 14px 16px !important;
            border-bottom: 1px solid #f1f5f9 !important;
            color: var(--text-primary) !important;
            font-size: 14px !important;
            vertical-align: middle !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            max-width: 200px !important;
        }

        .table tbody tr:hover {
            background: #f8fafc !important;
        }

        .table tbody tr:last-child td {
            border-bottom: none !important;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-color) !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 10px 20px !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }

        .btn-primary:hover {
            background: #1d4ed8 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2) !important;
        }

        .btn-outline-success {
            border: 1px solid #10b981 !important;
            color: #10b981 !important;
            background: transparent !important;
            border-radius: 8px !important;
            padding: 10px 20px !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }

        .btn-outline-success:hover {
            background: #10b981 !important;
            color: white !important;
        }

        .btn-secondary {
            background: #64748b !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 10px 20px !important;
            font-weight: 500 !important;
            color: white !important;
        }

        .btn-secondary:hover {
            background: #475569 !important;
            color: white !important;
        }

    .btn-danger {
        background: transparent !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 6px 12px !important;
        font-size: 13px !important;
        color: #ef4444 !important;
    }

    .btn-danger:hover {
        background: rgba(239, 68, 68, 0.1) !important;
        color: #dc2626 !important;
    }

    .btn-primary.btn-sm {
        background: transparent !important;
        color: var(--primary-color) !important;
        border: none !important;
        padding: 6px 12px !important;
        font-size: 13px !important;
    }

    .btn-primary.btn-sm:hover {
        background: rgba(37, 99, 235, 0.1) !important;
        color: #1d4ed8 !important;
    }

    .table tbody td:last-child {
        max-width: 120px !important;
    }

    .table tbody td:last-child .btn {
        width: 32px !important;
        height: 32px !important;
        padding: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 2px !important;
    }

        /* Form */
        .form-label {
            font-size: 14px !important;
            font-weight: 500 !important;
            color: var(--text-primary) !important;
            margin-bottom: 8px !important;
        }

        .form-control,
        .select {
            border: 1px solid var(--card-border) !important;
            border-radius: 8px !important;
            padding: 10px 14px !important;
            font-size: 14px !important;
            transition: all 0.2s ease !important;
        }

        .form-control:focus,
        .select:focus {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
            outline: none !important;
        }

        .form-outline {
            margin-bottom: 0 !important;
        }

        /* Pagination */
        .pagination {
            margin-top: 24px !important;
    }

    .pagination .page-link {
            border: 1px solid var(--card-border) !important;
            color: var(--text-primary) !important;
            padding: 8px 12px !important;
            margin: 0 4px !important;
            border-radius: 6px !important;
    }

        .pagination .page-item.active .page-link {
            background: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: white !important;
        }

        .pagination .page-link:hover {
            background: #f8fafc !important;
        }

        /* Badge */
        .badge {
            padding: 4px 10px !important;
            border-radius: 6px !important;
            font-size: 12px !important;
            font-weight: 500 !important;
        }

        .badge.bg-warning {
            background: #f59e0b !important;
            color: white !important;
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
                display: none;
            }

            .mobile-cards {
                display: block;
            }

            .table thead th:nth-child(n+5),
            .table tbody td:nth-child(n+5) {
                display: none;
            }

            .table thead th:nth-child(1),
            .table tbody td:nth-child(1),
            .table thead th:nth-child(2),
            .table tbody td:nth-child(2),
            .table thead th:nth-child(3),
            .table tbody td:nth-child(3),
            .table thead th:nth-child(4),
            .table tbody td:nth-child(4) {
                display: table-cell;
            }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .table {
                font-size: 12px;
        }

            .table thead th,
            .table tbody td {
                padding: 8px 10px !important;
            }
        }

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
    }

            .content-card {
                padding: 16px !important;
                border-radius: 8px !important;
            }

            .drawer {
                max-width: 100%;
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

            .mobile-card {
                padding: 12px;
            }

            .mobile-card-content {
                grid-template-columns: 1fr;
                gap: 8px;
            }
    }
</style>
@endsection

@section('content')
    <div class="page-container">
        <!-- Loading Spinner -->
        @include('layoutsapp.partials.loading', ['size' => 'medium', 'overlay' => true])
    <!-- Section Table -->
    <div id="table-section">
            <div class="page-header">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div style="width: 100%;">
                        <h1 class="page-title">Établissements Sanitaires</h1>
                        <p class="page-subtitle">Gérez vos établissements sanitaires</p>
                </div>
                    <div class="header-actions">
                    <button type="button" class="btn btn-outline-success" onclick="exportToExcel()">
                            <i class="fas fa-file-excel me-2"></i><span class="d-none d-md-inline">Exporter
                                Excel</span><span class="d-md-none">Excel</span>
                    </button>
                        <button type="button" class="btn btn-primary" onclick="showForm()">
                            <i class="fas fa-plus me-2"></i><span class="d-none d-md-inline">Nouvel
                                établissement</span><span class="d-md-none">Nouveau</span>
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
                                        <input type="checkbox" class="form-check-input" id="selectAll"
                                            onchange="toggleAllCheckboxes(this)">
                                    </div>
                                </th>
                                <th>N°</th>
                                <th>Direction Régionale</th>
                                <th>District Sanitaire</th>
                                <th>Établissement</th>
                                <th>Code</th>
                                <th>Responsable</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards View -->
                <div class="mobile-cards" id="mobile-cards">
            </div>

                <div id="pagination-container" class="mt-4"></div>
        </div>
    </div>

    <!-- Section Formulaire -->
    <div id="form-section" class="d-none">
            <div class="page-header">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                        <h1 class="page-title" id="formTitle">Nouvel Établissement</h1>
                        <p class="page-subtitle" id="formSubtitle">Ajouter un nouvel établissement sanitaire</p>
                </div>
                    <button class="btn btn-secondary" onclick="showTable()">
                        <i class="fas fa-arrow-left me-2"></i><span class="d-none d-md-inline">Retour à la liste</span><span
                            class="d-md-none">Retour</span>
                </button>
            </div>
        </div>

            <div class="content-card">
                <form id="supervisionForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Direction Régionale</label>
                            <select class="form-control" name="direction_regionale" id="direction_regionale" required>
                                <option value="">Sélectionnez une direction régionale</option>
                                <option value="IRFCI">IRFCI</option>
                                <option value="ABIDJAN 1">ABIDJAN 1</option>
                                <option value="ABIDJAN 2">ABIDJAN 2</option>
                                <option value="AGNEBY-TIASSA">AGNEBY-TIASSA</option>
                                <option value="BAFING">BAFING</option>
                                <option value="BAGOUE">BAGOUE</option>
                                <option value="BELIER">BELIER</option>
                                <option value="BERE">BERE</option>
                                <option value="BOUNKANI">BOUNKANI</option>
                                <option value="CAVALLY">CAVALLY</option>
                                <option value="FOLON">FOLON</option>
                                <option value="GBEKE">GBEKE</option>
                                <option value="GBOKLE">GBOKLE</option>
                                <option value="GONTOUGO">GONTOUGO</option>
                                <option value="GRANDS PONTS">GRANDS PONTS</option>
                                <option value="GUEMON">GUEMON</option>
                                <option value="GÔH">GÔH</option>
                                <option value="HAMBOL">HAMBOL</option>
                                <option value="HAUT SASSANDRA">HAUT SASSANDRA</option>
                                <option value="IFFOU">IFFOU</option>
                                <option value="INDENIE-DUABLIN">INDENIE-DUABLIN</option>
                                <option value="KABADOUGOU">KABADOUGOU</option>
                                <option value="LÔH-DJIBOUA">LÔH-DJIBOUA</option>
                                <option value="LOH-DJIBOUA">LOH-DJIBOUA</option>
                                <option value="MARAHOUE">MARAHOUÉ</option>
                                <option value="ME">ME</option>
                                <option value="MORONOU">MORONOU</option>
                                <option value="N'ZI">N'ZI</option>
                                <option value="NAWA">NAWA</option>
                                <option value="PORO">PORO</option>
                                <option value="SAN PEDRO">SAN PEDRO</option>
                                <option value="SUD-COMOE">SUD-COMOE</option>
                                <option value="TCHOLOGO">TCHOLOGO</option>
                                <option value="TONKPI">TONKPI</option>
                                <option value="WORODOUGOU">WORODOUGOU</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">District Sanitaire</label>
                            <select class="form-control" name="district_sanitaire" id="district_sanitaire" required>
                                <option value="">Sélectionnez un District</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                                <label class="form-label">Établissement Sanitaire</label>
                            <input type="text" class="form-control" name="etablissement_sanitaire"
                                id="etablissement_sanitaire" required>
                            </div>

                        <div class="col-md-6">
                            <label class="form-label">Catégorie de l'établissement</label>
                            <select class="form-control" name="categorie_etablissement" id="categorie_etablissement"
                                required>
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="CENTRE SANTE RURAL">CENTRE SANTÉ RURAL</option>
                                <option value="CENTRE SANTÉ URBAIN">CENTRE SANTÉ URBAIN</option>
                                <option value="CENTRE SPECIALISÉ">CENTRE SPECIALISÉ</option>
                                <option value="DISPENSAIRE RURAL">DISPENSAIRE RURAL</option>
                                <option value="EPHD">ETABLISSEMENT PUBLIC HOSPITALIER DEPARTEMENTAL (EPHD)-(HÔPITAL GENERAL)
                                </option>
                                <option value="EPHN">ETABLISSEMENT PUBLIC HOSPITALIER NATIONAL (EPHN)-(CHU ET INSTITUT)
                                </option>
                                <option value="EPHR">ETABLISSEMENT PUBLIC HOSPITALIER REGIONAL (EPHR)-(CHR)</option>
                                <option value="FSU">FSU</option>
                                <option value="FSU COM">FSU COM</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                                <label class="form-label">Code Établissement Sanitaire</label>
                            <input type="text" class="form-control" name="code_etablissement" id="code_etablissement"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Période supervisée</label>
                            <input type="text" class="form-control" name="periode" id="periode"
                                placeholder="Sélectionnez une période" required readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Périodicité de la supervision</label>
                            <select class="form-control" name="periodicite" id="periodicite" required>
                                <option value="">Sélectionnez une période</option>
                                <option value="Annuelle">Annuelle</option>
                                <option value="Mensuelle">Mensuelle</option>
                                <option value="Semestrielle">Semestrielle</option>
                                <option value="Trimestrielle">Trimestrielle</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                                <label class="form-label">Date/heure de début</label>
                            <input type="text" class="form-control datepicker" name="date_debut" id="date_debut" required>
                        </div>

                        <div class="col-md-6">
                                <label class="form-label">Date/heure de fin</label>
                            <input type="text" class="form-control datepicker" name="date_fin" id="date_fin" required>
                        </div>

                        <div class="col-md-6">
                                <label class="form-label">Nom du Responsable</label>
                            <input type="text" class="form-control" name="responsable" id="responsable" required>
                        </div>

                                <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-md-6">
                                        <label class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" name="telephone" id="telephone" required>
                                </div>
                                <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary" onclick="showTable()">
                            <i class="fas fa-times me-2"></i>Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;"></div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cet établissement ? Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Drawer -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
    <div class="drawer" id="detailDrawer">
        <div class="drawer-header">
            <h2 class="drawer-title">Détails de l'établissement</h2>
            <button class="drawer-close" onclick="closeDrawer()">
                <i class="fas fa-times"></i>
            </button>
    </div>
        <div class="drawer-body" id="drawerBody">
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
<script>
    const API_ENDPOINTS = {
        GET_ETABLISSEMENTS: '/api/etablissements',
        SAVE_ETABLISSEMENT: '/api/etablissements/save',
        DELETE_ETABLISSEMENT: '/api/etablissements/delete'
    };

    const STORAGE_KEYS = {
        ETABLISSEMENTS: 'cached_etablissements',
        PENDING_ETABLISSEMENTS: 'pending_etablissements'
    };

    function showForm() {
        document.getElementById('table-section').classList.add('d-none');
        document.getElementById('form-section').classList.remove('d-none');
        document.getElementById('supervisionForm').reset();
    }

    function showTable() {
        document.getElementById('form-section').classList.add('d-none');
        document.getElementById('table-section').classList.remove('d-none');
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
            const deleteBtn = document.getElementById('deleteSelectedBtn');
            if (deleteBtn) {
                deleteBtn.classList.toggle('d-none', !anyChecked);
            }
    }

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
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.parentElement.parentElement.remove()"></button>
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

    class CacheManager {
        static set(key, data) {
            try {
                localStorage.setItem(key, JSON.stringify(data));
            } catch (error) {
                console.error(`Erreur lors de la mise en cache pour ${key}:`, error);
            }
        }

        static get(key) {
            try {
                const data = localStorage.getItem(key);
                return data ? JSON.parse(data) : null;
            } catch (error) {
                console.error(`Erreur lors de la récupération du cache pour ${key}:`, error);
                return null;
            }
        }

        static getPendingEtablissements() {
            return this.get(STORAGE_KEYS.PENDING_ETABLISSEMENTS) || [];
        }

        static addPendingEtablissement(etablissement) {
            const pending = this.getPendingEtablissements();
            pending.push(etablissement);
            this.set(STORAGE_KEYS.PENDING_ETABLISSEMENTS, pending);
        }

        static removePendingEtablissement(id) {
            const pending = this.getPendingEtablissements();
            const updated = pending.filter(item => item.id !== id);
            this.set(STORAGE_KEYS.PENDING_ETABLISSEMENTS, updated);
        }
    }

    class EtablissementManager {
        static currentPage = 1;
        static totalPages = 0;

        static formatDate(dateStr) {
            if (!dateStr) return '';
            try {
                const date = new Date(dateStr);
                return date.toLocaleString('fr-FR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            } catch (e) {
                return dateStr;
            }
        }

        static isCodeEtablissementUnique(code) {
            const cachedEtablissements = CacheManager.get(STORAGE_KEYS.ETABLISSEMENTS) || [];
            const pendingEtablissements = CacheManager.getPendingEtablissements();
            const allEtablissements = [...cachedEtablissements, ...pendingEtablissements];
            return !allEtablissements.some(etab =>
                etab.code_etablissement.toLowerCase() === code.toLowerCase()
            );
        }

        static async loadEtablissements(page = 1) {
            try {
                const tbody = document.getElementById('table-body');
                    const mobileCards = document.getElementById('mobile-cards');
                const paginationContainer = document.getElementById('pagination-container');
                if (!tbody || !paginationContainer) {
                    // Masquer le spinner même si les éléments n'existent pas
                    if (typeof window.hideLoadingWithTimeout === 'function') {
                        window.hideLoadingWithTimeout();
                    } else if (typeof window.hideLoading === 'function') {
                        window.hideLoading();
                    }
                    return;
                }

                tbody.innerHTML = '';
                    if (mobileCards) mobileCards.innerHTML = '';
                paginationContainer.innerHTML = '';

                let etablissements = [];
                const pendingEtablissements = CacheManager.getPendingEtablissements();

                if (navigator.onLine) {
                    try {
                        // Créer un AbortController pour le timeout
                        const controller = new AbortController();
                        const timeoutId = setTimeout(() => controller.abort(), 8000); // Timeout de 8 secondes
                        
                        const response = await fetch(`${API_ENDPOINTS.GET_ETABLISSEMENTS}?page=${page}`, {
                            signal: controller.signal
                        });
                        clearTimeout(timeoutId);
                        const data = await response.json();
                        if (data.success) {
                            etablissements = data.data.data;
                            this.currentPage = data.data.current_page;
                            this.totalPages = data.data.last_page;
                            CacheManager.set(STORAGE_KEYS.ETABLISSEMENTS, etablissements);
                            this.renderPagination(data.data);
                        } else {
                            console.warn('Réponse API non réussie:', data);
                            const cachedData = CacheManager.get(STORAGE_KEYS.ETABLISSEMENTS);
                            if (cachedData) {
                                etablissements = cachedData;
                                AlertManager.showWarning('Utilisation des données en cache');
                            }
                        }
                    } catch (error) {
                        console.error('Erreur serveur:', error);
                        const cachedData = CacheManager.get(STORAGE_KEYS.ETABLISSEMENTS);
                        if (cachedData) {
                            etablissements = cachedData;
                            AlertManager.showWarning('Utilisation des données en cache');
                        } else {
                            // Pas de données en cache, afficher un message
                            AlertManager.showWarning('Aucune donnée disponible');
                        }
                    }
                } else {
                    const cachedData = CacheManager.get(STORAGE_KEYS.ETABLISSEMENTS);
                    if (cachedData) {
                        etablissements = cachedData;
                    } else {
                        AlertManager.showWarning('Mode hors ligne - Aucune donnée en cache');
                    }
                }

                const allEtablissements = [...etablissements, ...pendingEtablissements];
                allEtablissements.forEach((etablissement, index) => {
                    this.addRowToTable(etablissement, index, pendingEtablissements);
                        this.addMobileCard(etablissement, index, pendingEtablissements);
                });

                if (!navigator.onLine && pendingEtablissements.length > 0) {
                    AlertManager.showWarning(`${pendingEtablissements.length} établissement(s) en attente de synchronisation`);
                }

                // Masquer le spinner une fois le chargement terminé
                if (typeof window.hideLoadingWithTimeout === 'function') {
                    window.hideLoadingWithTimeout();
                } else if (typeof window.hideLoading === 'function') {
                    window.hideLoading();
                } else {
                    console.error('Fonction hideLoading non disponible');
                }
            } catch (error) {
                console.error('Erreur:', error);
                AlertManager.showError('Erreur lors du chargement des établissements');
                // Masquer le spinner même en cas d'erreur
                if (typeof window.hideLoadingWithTimeout === 'function') {
                    window.hideLoadingWithTimeout();
                } else if (typeof window.hideLoading === 'function') {
                    window.hideLoading();
                } else {
                    console.error('Fonction hideLoading non disponible');
                }
            }
        }

        static renderPagination(paginationData) {
            const paginationContainer = document.getElementById('pagination-container');
            if (!paginationContainer) return;

            const currentPage = paginationData.current_page;
            const lastPage = paginationData.last_page;

            let paginationHTML = `
            <nav aria-label="Pagination des établissements">
                <ul class="pagination pagination-circle justify-content-center">
        `;

            paginationHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="EtablissementManager.loadEtablissements(${currentPage - 1})" ${currentPage === 1 ? 'tabindex="-1" aria-disabled="true"' : ''}>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        `;

            paginationData.links.forEach(link => {
                if (link.url && !link.label.includes('Previous') && !link.label.includes('Next')) {
                    const pageNum = parseInt(link.label);
                    paginationHTML += `
                    <li class="page-item ${link.active ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="EtablissementManager.loadEtablissements(${pageNum})">
                            ${link.label}
                        </a>
                    </li>
                `;
                }
            });

            paginationHTML += `
            <li class="page-item ${currentPage === lastPage ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="EtablissementManager.loadEtablissements(${currentPage + 1})" ${currentPage === lastPage ? 'tabindex="-1" aria-disabled="true"' : ''}>
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

        static addRowToTable(etablissement, index, pendingEtablissements) {
            const tbody = document.getElementById('table-body');
            if (!tbody || !etablissement) return;

            const row = document.createElement('tr');
            const isPending = pendingEtablissements?.some(p => p.id === etablissement.id);
                const etabId = etablissement.id || etablissement.code_etablissement || index;

                // Stocker l'établissement dans un attribut data
                row.setAttribute('data-etablissement', JSON.stringify(etablissement));

            row.innerHTML = `
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" onchange="updateDeleteButton()">
                </div>
            </td>
            <td>${index + 1}</td>
                    <td>${etablissement.direction_regionale || ''}</td>
                    <td>${etablissement.district_sanitaire || ''}</td>
                    <td style="cursor: pointer; color: var(--primary-color);" onclick="EtablissementManager.openDrawerFromRow(this.closest('tr'))">${etablissement.etablissement_sanitaire || ''}</td>
                    <td>${etablissement.code_etablissement || ''}</td>
                    <td>${etablissement.responsable || ''}</td>
                    <td>
                        ${isPending ? '<span class="badge bg-warning me-2">En attente</span>' : ''}
                        <button class="btn btn-primary btn-sm" onclick="EtablissementManager.openDrawerFromRow(this.closest('tr'))" title="Voir détails">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="EtablissementManager.showDeleteModal(this)" title="Supprimer">
                            <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
            tbody.appendChild(row);
        }

            static openDrawerFromRow(row) {
                const etabData = row.getAttribute('data-etablissement');
                if (etabData) {
                    try {
                        const etablissement = JSON.parse(etabData);
                        this.openDrawer(etablissement);
                    } catch (e) {
                        console.error('Erreur parsing:', e);
                    }
                }
        }

        static async handleSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const codeEtablissement = formData.get('code_etablissement');

            if (!this.isCodeEtablissementUnique(codeEtablissement)) {
                AlertManager.showError('Ce code d\'établissement existe déjà');
                return;
            }

            const etablissement = {
                direction_regionale: formData.get('direction_regionale'),
                district_sanitaire: formData.get('district_sanitaire'),
                etablissement_sanitaire: formData.get('etablissement_sanitaire'),
                categorie_etablissement: formData.get('categorie_etablissement'),
                code_etablissement: codeEtablissement,
                periode: formData.get('periode'),
                periodicite: formData.get('periodicite'),
                date_debut: formData.get('date_debut'),
                date_fin: formData.get('date_fin'),
                responsable: formData.get('responsable'),
                telephone: formData.get('telephone'),
                email: formData.get('email')
            };

            try {
                if (navigator.onLine) {
                    const response = await fetch(API_ENDPOINTS.SAVE_ETABLISSEMENT, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(etablissement)
                    });

                    const responseData = await response.json();

                    if (!response.ok) {
                        if (responseData.errors) {
                            const errorMessages = Object.values(responseData.errors).flat().join('\n');
                            throw new Error(errorMessages);
                        }
                        throw new Error(responseData.message || 'Erreur lors de l\'enregistrement');
                    }

                    AlertManager.showSuccess('Établissement enregistré avec succès');
                } else {
                    etablissement.id = Date.now();
                    etablissement.timestamp = new Date().toISOString();
                    CacheManager.addPendingEtablissement(etablissement);
                    AlertManager.showSuccess('Établissement sauvegardé localement - En attente de synchronisation');
                }

                form.reset();
                showTable();
                await this.loadEtablissements();
            } catch (error) {
                console.error('Erreur:', error);
                AlertManager.showError(error.message || 'Erreur lors de l\'enregistrement');
            }
        }

        static async syncPendingEtablissements() {
            const pending = CacheManager.getPendingEtablissements();
            if (!pending.length) return;

            let successfulSyncs = [];
            let errors = [];

            for (const etablissement of pending) {
                try {
                        const { id, timestamp, ...etablissementData } = etablissement;
                    const response = await fetch(API_ENDPOINTS.SAVE_ETABLISSEMENT, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(etablissementData)
                    });

                    const responseData = await response.json();

                    if (response.ok && responseData.success) {
                        successfulSyncs.push(etablissement.id);
                    } else {
                        errors.push({
                            id: etablissement.id,
                            error: responseData.message || 'Erreur serveur'
                        });
                    }
                } catch (error) {
                    console.error('Erreur de synchronisation:', error);
                    errors.push({
                        id: etablissement.id,
                        error: error.message
                    });
                }
            }

            if (successfulSyncs.length > 0) {
                let remainingPending = CacheManager.getPendingEtablissements().filter(
                    etablissement => !successfulSyncs.includes(etablissement.id)
                );
                CacheManager.set(STORAGE_KEYS.PENDING_ETABLISSEMENTS, remainingPending);

                try {
                    const response = await fetch(API_ENDPOINTS.GET_ETABLISSEMENTS);
                    const data = await response.json();
                    if (data.success) {
                        CacheManager.set(STORAGE_KEYS.ETABLISSEMENTS, data.data.data);
                    }
                } catch (error) {
                    console.error('Erreur lors du rechargement des données:', error);
                }

                AlertManager.showSuccess(
                    successfulSyncs.length === pending.length ?
                    'Tous les établissements ont été synchronisés' :
                    `${successfulSyncs.length} établissement(s) synchronisé(s)`
                );
            }

            if (errors.length > 0) {
                AlertManager.showWarning(`${errors.length} établissement(s) n'ont pas pu être synchronisés`);
            }

            await this.loadEtablissements();
        }

        static showDeleteModal(button) {
            const modalElement = document.getElementById('deleteModal');
            if (!modalElement) return;
            
            // Stocker le bouton pour la suppression
            modalElement.dataset.deleteButton = 'true';
            modalElement._deleteButton = button;
            
            // Initialiser le modal MDB
            let modal;
            if (modalElement._mdbModal) {
                modal = modalElement._mdbModal;
            } else {
                modal = new mdb.Modal(modalElement);
                modalElement._mdbModal = modal;
            }
            
            // Gérer le bouton de confirmation
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            if (confirmBtn) {
                // Supprimer tous les anciens gestionnaires
                const newConfirmBtn = confirmBtn.cloneNode(true);
                confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
                
                // Ajouter le nouveau gestionnaire
                newConfirmBtn.onclick = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    if (modalElement._deleteButton) {
                        this.deleteRow(modalElement._deleteButton);
                    }
                    modal.hide();
                };
            }
            
            modal.show();
        }

        static async deleteRow(button) {
            if (!button) return;

            const row = button.closest('tr');
            const card = button.closest('.mobile-card');
            
            // Récupérer l'ID de l'établissement
            let etablissementId = null;
            if (row) {
                const etabData = row.getAttribute('data-etablissement');
                if (etabData) {
                    try {
                        const etab = JSON.parse(etabData);
                        etablissementId = etab.id;
                    } catch (e) {
                        console.error('Erreur parsing:', e);
                    }
                }
    }

            // Si pas d'ID dans la row, chercher dans la card
            if (!etablissementId && card) {
                const codeElement = card.querySelector('.mobile-card-value');
                if (codeElement) {
                    const code = codeElement.textContent.trim();
                    // Chercher dans toutes les rows pour trouver l'ID
                    const allRows = document.querySelectorAll('#table-body tr');
                    for (const r of allRows) {
                        const data = r.getAttribute('data-etablissement');
                        if (data) {
        try {
                                const etab = JSON.parse(data);
                                if (etab.code_etablissement === code) {
                                    etablissementId = etab.id;
                                    break;
                                }
                            } catch (e) {
                                console.error('Erreur parsing:', e);
                            }
                        }
                    }
                }
            }
            
            // Si toujours pas d'ID, c'est probablement un élément en attente (pas encore sauvegardé)
            if (!etablissementId) {
                // Supprimer juste du DOM
                if (row) row.remove();
                if (card) card.remove();
                updateDeleteButton();
                AlertManager.showSuccess('Établissement supprimé');
                return;
            }
            
            // Appel API pour supprimer de la base de données
            try {
                if (navigator.onLine) {
                    const response = await fetch(`${API_ENDPOINTS.DELETE_ETABLISSEMENT}/${etablissementId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok && data.success) {
                        // Supprimer du DOM
                        if (row) row.remove();
                        if (card) card.remove();
                        updateDeleteButton();
                        AlertManager.showSuccess('Établissement supprimé avec succès');
                        
                        // Recharger la liste pour mettre à jour la pagination
                        await this.loadEtablissements(this.currentPage);
                    } else {
                        AlertManager.showError(data.message || 'Erreur lors de la suppression');
                    }
                } else {
                    // Mode hors ligne - supprimer du DOM seulement
                    if (row) row.remove();
                    if (card) card.remove();
                    updateDeleteButton();
                    AlertManager.showWarning('Mode hors ligne - Suppression locale uniquement');
                }
            } catch (error) {
                console.error('Erreur lors de la suppression:', error);
                AlertManager.showError('Erreur lors de la suppression de l\'établissement');
            }
        }

        static addMobileCard(etablissement, index, pendingEtablissements) {
            const mobileCards = document.getElementById('mobile-cards');
            if (!mobileCards || !etablissement) return;

            const isPending = pendingEtablissements?.some(p => p.id === etablissement.id);
            const card = document.createElement('div');
            card.className = 'mobile-card';
            card.onclick = () => this.openDrawer(etablissement);

            card.innerHTML = `
                <div class="mobile-card-header">
                    <h3 class="mobile-card-title">${etablissement.etablissement_sanitaire || 'N/A'}</h3>
                    ${isPending ? '<span class="mobile-card-badge bg-warning text-white">En attente</span>' : ''}
                </div>
                <div class="mobile-card-content">
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Direction Régionale</span>
                        <span class="mobile-card-value">${etablissement.direction_regionale || 'N/A'}</span>
                    </div>
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">District Sanitaire</span>
                        <span class="mobile-card-value">${etablissement.district_sanitaire || 'N/A'}</span>
                    </div>
                    <div class="mobile-card-item">
                        <span class="mobile-card-label">Code</span>
                        <span class="mobile-card-value">${etablissement.code_etablissement || 'N/A'}</span>
                    </div>
                </div>
            `;
            mobileCards.appendChild(card);
        }

        static openDrawer(etablissement) {
            const drawer = document.getElementById('detailDrawer');
            const overlay = document.getElementById('drawerOverlay');
            const drawerBody = document.getElementById('drawerBody');

            if (!drawer || !overlay || !drawerBody) return;

            drawerBody.innerHTML = `
                <div class="drawer-section">
                    <h3 class="drawer-section-title">Informations générales</h3>
                    <div class="drawer-item">
                        <span class="drawer-label">Établissement</span>
                        <span class="drawer-value">${etablissement.etablissement_sanitaire || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Direction Régionale</span>
                        <span class="drawer-value">${etablissement.direction_regionale || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">District Sanitaire</span>
                        <span class="drawer-value">${etablissement.district_sanitaire || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Catégorie</span>
                        <span class="drawer-value">${etablissement.categorie_etablissement || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Code</span>
                        <span class="drawer-value">${etablissement.code_etablissement || 'N/A'}</span>
                    </div>
                </div>

                <div class="drawer-section">
                    <h3 class="drawer-section-title">Période de supervision</h3>
                    <div class="drawer-item">
                        <span class="drawer-label">Période</span>
                        <span class="drawer-value">${etablissement.periode || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Périodicité</span>
                        <span class="drawer-value">${etablissement.periodicite || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Date de début</span>
                        <span class="drawer-value">${this.formatDate(etablissement.date_debut)}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Date de fin</span>
                        <span class="drawer-value">${this.formatDate(etablissement.date_fin)}</span>
                    </div>
                </div>

                <div class="drawer-section">
                    <h3 class="drawer-section-title">Contact</h3>
                    <div class="drawer-item">
                        <span class="drawer-label">Responsable</span>
                        <span class="drawer-value">${etablissement.responsable || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Téléphone</span>
                        <span class="drawer-value">${etablissement.telephone || 'N/A'}</span>
                    </div>
                    <div class="drawer-item">
                        <span class="drawer-label">Email</span>
                        <span class="drawer-value">${etablissement.email || 'N/A'}</span>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-danger" onclick="EtablissementManager.showDeleteModalFromDrawer('${etablissement.id || etablissement.code_etablissement}')">
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
            
            // Trouver l'établissement et son ID
            let etablissementId = null;
            let etablissement = null;
            
            const rows = document.querySelectorAll('#table-body tr');
            for (const row of rows) {
                const etabData = row.getAttribute('data-etablissement');
                if (etabData) {
                    try {
                        const etab = JSON.parse(etabData);
                        if ((etab.id && etab.id.toString() === identifier) || 
                            (etab.code_etablissement && etab.code_etablissement === identifier)) {
                            etablissementId = etab.id;
                            etablissement = etab;
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
                if (!etablissementId) {
                    // Pas d'ID, supprimer juste du DOM
                    const cards = document.querySelectorAll('.mobile-card');
                    const rows = document.querySelectorAll('#table-body tr');
                    
                    cards.forEach(card => {
                        const code = card.querySelector('.mobile-card-value')?.textContent;
                        if (code === identifier) {
                            card.remove();
                }
            });

                    rows.forEach(row => {
                        const etabData = row.getAttribute('data-etablissement');
                        if (etabData) {
                            try {
                                const etab = JSON.parse(etabData);
                                if ((etab.id && etab.id.toString() === identifier) || 
                                    (etab.code_etablissement && etab.code_etablissement === identifier)) {
                                    row.remove();
                                }
                            } catch (e) {
                                console.error('Erreur parsing:', e);
                            }
                        }
                    });
                    
                    updateDeleteButton();
                    AlertManager.showSuccess('Établissement supprimé');
                    modal.hide();
                    return;
                }
                
                // Appel API pour supprimer de la base de données
                try {
                    if (navigator.onLine) {
                        const response = await fetch(`${API_ENDPOINTS.DELETE_ETABLISSEMENT}/${etablissementId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    });

                        const data = await response.json();
                        
                        if (response.ok && data.success) {
                            // Supprimer du DOM
                            const cards = document.querySelectorAll('.mobile-card');
                            const rows = document.querySelectorAll('#table-body tr');
                            
                            cards.forEach(card => {
                                const code = card.querySelector('.mobile-card-value')?.textContent;
                                if (code === identifier) {
                                    card.remove();
                                }
                            });
                            
                            rows.forEach(row => {
                                const etabData = row.getAttribute('data-etablissement');
                                if (etabData) {
                                    try {
                                        const etab = JSON.parse(etabData);
                                        if ((etab.id && etab.id.toString() === identifier) || 
                                            (etab.code_etablissement && etab.code_etablissement === identifier)) {
                                            row.remove();
                                        }
                                    } catch (e) {
                                        console.error('Erreur parsing:', e);
                                    }
                                }
                            });
                            
                            updateDeleteButton();
                            AlertManager.showSuccess('Établissement supprimé avec succès');
                            
                            // Recharger la liste
                            await EtablissementManager.loadEtablissements(EtablissementManager.currentPage);
                        } else {
                            AlertManager.showError(data.message || 'Erreur lors de la suppression');
                        }
                    } else {
                        AlertManager.showWarning('Mode hors ligne - Suppression locale uniquement');
                    }
                } catch (error) {
                    console.error('Erreur lors de la suppression:', error);
                    AlertManager.showError('Erreur lors de la suppression de l\'établissement');
                }
                
                modal.hide();
            };
            
            modal.show();
        }
    }

    function closeDrawer() {
        const drawer = document.getElementById('detailDrawer');
        const overlay = document.getElementById('drawerOverlay');
        if (drawer) drawer.classList.remove('open');
        if (overlay) overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    function exportToExcel() {
        AlertManager.showWarning('Fonctionnalité d\'export Excel à implémenter');
    }

    const directionToDistricts = {
        "IRFCI": ["IRF ADZOPE", "IRF MANIKRO"],
        "ABIDJAN 1": ["ABOBO EST", "ABOBO OUEST", "ANYAMA", "YOPOUGON-EST", "YOPOUGON-OUEST SONGON"],
        "ABIDJAN 2": ["ADJAME-PLATEAU-ATTECOUBE", "COCODY BINGERVILLE", "KOUMASSI", "TREICHVILLE-MARCORY"],
        "AGNEBY-TIASSA": ["AGBOVILLE", "SIKENSI", "TIASSALE"],
        "BAFING": ["KORO", "OUANINOU", "TOUBA"],
        "BAGOUE": ["BOUNDIALI", "KOUTO", "TENGRELA"],
        "BELIER": ["DIDIEVI", "TIEBISSOU", "TOUMODI", "YAMOUSSOUKRO"],
        "BERE": ["DIANRA", "KOUNAHIRI", "MANKONO"],
        "BOUNKANI": ["BOUNA", "DOROPO", "NASSIAN", "TEHINI"],
        "CAVALLY": ["BLOLEQUIN", "GUIGLO", "TAI", "TOULEPLEU"],
        "FOLON": ["KANIASSO", "MINIGNAN"],
        "GBEKE": ["BECOMI", "BOTRO", "BOUAKE NORD-EST", "BOUAKE NORD-OUEST", "BOUAKE-SUD", "SAKASSOU"],
        "GBOKLE": ["FRESCO", "SASSANDRA"],
        "GONTOUGO": ["BONDOUKOU", "KOUN-FAO", "SANDEGUE", "TANDA", "TRANSUA"],
        "GRANDS PONTS": ["DABOU", "GRAND-LAHOU", "JACQUEVILLE"],
        "GUEMON": ["BANGOLO", "DUEKOUE", "KOUIBLY"],
        "GÔH": ["GAGNOA 1", "GAGNOA 2", "OUUME"],
        "HAMBOL": ["DABAKALA", "KATIOLA", "NIAKARAMADOUGOU"],
        "HAUT SASSANDRA": ["DALOA", "ISSIA", "VAVOUA", "ZOUKOUGBEU"],
        "IFFOU": ["DAOUKRO", "MBAHIAKRO", "PRIKRO"],
        "INDENIE-DUABLIN": ["ABENGOUROU", "AGNIBILEKROU", "BETTIE"],
        "KABADOUGOU": ["MADINANI", "ODIENNE"],
        "LÔH-DJIBOUA": ["DIVO", "GUITRY", "LAKOTA"],
        "MARAHOUE": ["BOUAFLE", "SIN-FRA", "ZUENOULA"],
            "ME": ["ADZOPE", "AKOUPE", "ALEPE", "YAKASSE-ATTOBROU"],
        "MORONOU": ["ARRAH", "BONGOUANOU", "M'BATTO"],
        "N'ZI": ["BOCANDA", "DIMBOKRO", "KOUASSI KOUASSIKRO"],
        "NAWA": ["BUYO", "GUEYO", "MEAGUI", "SOUBRE"],
        "PORO": ["DIKODOUGOU", "KORHOGO 1", "KORHOGO 2", "M'BENGUE", "SINEMATIALI"],
        "SAN PEDRO": ["SAN PEDRO", "TABOU"],
        "SUD-COMOE": ["ABOISSO", "ADIAKE", "GRAND-BASSAM", "TIAPOUM"],
        "TCHOLOGO": ["FERKESSEDOUGOU", "KONG", "OUANGOLODOUGOU"],
        "TONKPI": ["BIANKOUMA", "DANANE", "MAN", "ZOUAN-HOUNIEN"],
        "WORODOUGOU": ["KANI", "SEGUELA"]
    };

        // Fonctions pour gérer le loading spinner (globales pour être accessibles partout)
        window.showLoading = function() {
            const spinner = document.getElementById('loadingSpinner');
            if (spinner) {
                // Retirer la classe hidden et le style display
                spinner.classList.remove('hidden');
                spinner.style.removeProperty('display');
                // Réactiver les animations
                const segments = spinner.querySelectorAll('.spinner-segment');
                segments.forEach((segment, index) => {
                    segment.style.animation = `spinner-segment-fade 1.2s cubic-bezier(0.4, 0, 0.2, 1) infinite`;
                    segment.style.animationDelay = `${index * 0.033}s`;
                });
                console.log('Loading affiché');
            } else {
                console.error('Élément loadingSpinner introuvable');
            }
        };

        window.hideLoading = function() {
            const spinner = document.getElementById('loadingSpinner');
            if (spinner) {
                // Arrêter toutes les animations
                const segments = spinner.querySelectorAll('.spinner-segment');
                segments.forEach(segment => {
                    segment.style.animation = 'none';
                });
                // Masquer le spinner - utiliser les deux méthodes pour être sûr
                spinner.classList.add('hidden');
                spinner.style.setProperty('display', 'none', 'important');
                console.log('Loading masqué');
            } else {
                console.error('Élément loadingSpinner introuvable pour masquer');
            }
        };

        // Timeout de sécurité pour masquer le loading après 10 secondes maximum
        let loadingTimeout;
        window.showLoadingWithTimeout = function() {
            window.showLoading();
            // Annuler le timeout précédent s'il existe
            if (loadingTimeout) {
                clearTimeout(loadingTimeout);
            }
            // Définir un nouveau timeout de sécurité
            loadingTimeout = setTimeout(() => {
                console.warn('Timeout de sécurité: masquage automatique du loading');
                window.hideLoading();
            }, 10000); // 10 secondes maximum
        };

        window.hideLoadingWithTimeout = function() {
            if (loadingTimeout) {
                clearTimeout(loadingTimeout);
                loadingTimeout = null;
            }
            window.hideLoading();
        };

        document.addEventListener('DOMContentLoaded', async () => {
            // Vérifier que l'élément loading existe
            const spinnerCheck = document.getElementById('loadingSpinner');
            if (!spinnerCheck) {
                console.error('ERREUR: L\'élément loadingSpinner n\'existe pas dans le DOM');
            } else {
                console.log('Élément loadingSpinner trouvé dans le DOM');
            }

            // Afficher le spinner au chargement initial
            window.showLoadingWithTimeout();

            // Attendre un peu pour s'assurer que le DOM est prêt
            await new Promise(resolve => setTimeout(resolve, 100));

            // Initialisation Flatpickr
            flatpickr(".datepicker", {
                locale: "fr",
                enableTime: true,
                dateFormat: "Y-m-d H:i:s",
                time_24hr: true,
                allowInput: true,
                minuteIncrement: 1,
            });

            flatpickr("#periode", {
                locale: "fr",
                mode: "range",
                dateFormat: "Y-m-d",
                allowInput: true,
                altInput: true,
                altFormat: "d/m/Y",
            });

            // Gestion direction/district
        const directionSelect = document.getElementById("direction_regionale");
        const districtSelect = document.getElementById("district_sanitaire");

            if (directionSelect && districtSelect) {
                directionSelect.addEventListener("change", function () {
            const selectedDirection = this.value;
            districtSelect.innerHTML = '<option value="">Sélectionnez un District</option>';
            if (directionToDistricts[selectedDirection]) {
                        directionToDistricts[selectedDirection].forEach(function (district) {
                    const option = document.createElement("option");
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            }
        });
            }

            // Formulaire
            const form = document.getElementById('supervisionForm');
            if (form) {
                form.addEventListener('submit', (event) => EtablissementManager.handleSubmit(event));
            }

            // Chargement initial
            try {
                await EtablissementManager.loadEtablissements();
            } catch (error) {
                console.error('Erreur lors du chargement initial:', error);
                // S'assurer que le spinner est masqué même en cas d'erreur
                if (typeof window.hideLoadingWithTimeout === 'function') {
                    window.hideLoadingWithTimeout();
                } else if (typeof window.hideLoading === 'function') {
                    window.hideLoading();
                }
            }

            // Gestion connexion
            window.addEventListener('online', async () => {
                AlertManager.showSuccess('Connexion rétablie');
                try {
                    const pending = CacheManager.getPendingEtablissements();
                    if (pending.length > 0) {
                        await EtablissementManager.syncPendingEtablissements();
                    }
                    await EtablissementManager.loadEtablissements();
                } catch (error) {
                    console.error('Erreur lors de la synchronisation:', error);
                    AlertManager.showError('Erreur lors de la synchronisation des données');
                }
            });

            window.addEventListener('offline', () => {
                AlertManager.showWarning('Mode hors ligne activé - Les données seront synchronisées automatiquement');
            });
        });
    </script>
@endsection