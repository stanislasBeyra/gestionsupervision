<!-- Menu Mobile (Offcanvas) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0 d-flex flex-column" style="height: calc(100% - 56px);">
        <div class="flex-grow-1 overflow-auto">
            <div class="list-group list-group-flush p-3">
                <!-- Dashboard principal Mobile -->
                <div class="list-group-item mb-2">
                    <a href="/dashboard" class="list-group-item-action d-flex align-items-center px-0 no-blue-effect">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <!-- Menu Analytics Mobile -->
                <div class="list-group-item mb-2">
                    <div class="d-flex align-items-center justify-content-between px-0 custom-toggle no-blue-effect" 
                         data-target="analyticsSubmenuMobile">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-tools fa-fw me-3"></i>
                            <span>Outil de supervision</span>
                        </div>
                        <span class="custom-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </div>
                    <div class="custom-collapse mt-2" id="analyticsSubmenuMobile">
                        <div class="ps-4">
                            <a href="/etablissementsanitaire" class="d-block mb-2 text-decoration-none no-blue-effect">Etablissement sanitaire</a>
                            <a href="/identifiantsuperviser" class="d-block mb-2 text-decoration-none no-blue-effect">Identifiants supervisés</a>
                            <a href="/identifiantsuperviseurs" class="d-block mb-2 text-decoration-none no-blue-effect">Identifiants superviseurs</a>
                        </div>
                    </div>
                </div>

                <!-- Menu Supervision Mobile -->
                <div class="list-group-item mb-2">
                    <div class="d-flex align-items-center justify-content-between px-0 custom-toggle no-blue-effect" 
                         data-target="supervisionSubmenuMobile">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-desktop fa-fw me-3"></i>
                            <span>Supervision</span>
                        </div>
                        <span class="custom-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </div>
                    <div class="custom-collapse mt-2" id="supervisionSubmenuMobile">
                        <div class="ps-4">
                            <a href="/created" class="d-block mb-2 text-decoration-none no-blue-effect">Vue d'ensemble</a>
                            <a href="/environnementElement" class="d-block mb-2 text-decoration-none no-blue-effect">Element d'environment</a>
                            <a href="/conpetanceElement" class="d-block mb-2 text-decoration-none no-blue-effect">Element de competance</a>
                        </div>
                    </div>
                </div>

                

                <div class="list-group-item mb-2">
                    <a href="/synthesesupervision" class="list-group-item-action d-flex align-items-center px-0 no-blue-effect">
                        <i class="fas fa-chart-pie fa-fw me-3"></i>
                        <span>Synthèse supervision</span>
                    </a>
                </div>
                <div class="list-group-item mb-2">
                    <a href="/problemeprioritaire" class="list-group-item-action d-flex align-items-center px-0 no-blue-effect">
                        <i class="fas fa-exclamation-circle fa-fw me-3"></i>
                        <span>Problèmes prioritaires</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer fixe en bas avec bouton de téléchargement -->
        <div class="border-top mt-2 p-3 bg-light">
            <a href="#" class="btn btn-secondary w-100 d-flex align-items-center justify-content-center shadow-sm no-blue-effect" id="downloadBtn" style="font-size: 0.7rem; box-shadow: 0 1px 1px rgba(0,0,0,0.1);">
                <i class="fas fa-download me-2"></i>
                Télécharger les données
            </a>
        </div>
    </div>
</div>