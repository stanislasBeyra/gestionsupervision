<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush p-3">
            <!-- Dashboard principal Mobile -->
            <div class="list-group-item mb-2">
                <a href="/dashboard" class="list-group-item-action d-flex align-items-center px-0">
                    <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Menu Supervision Mobile -->
            <div class="list-group-item mb-2">
                <a class="submenu-toggle d-flex align-items-center justify-content-between px-0"
                    data-mdb-toggle="collapse"
                    href="#supervisionSubmenuMobile"
                    role="button"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-desktop fa-fw me-3"></i>
                        <span>Supervision</span>
                    </div>

                </a>
                <div class="collapse" id="supervisionSubmenuMobile">
                <div class="submenu-collapse mt-2">
                        <a href="/created" class="submenu-item mb-2">Vue d'ensemble</a>
                        <a href="/environnementElement" class="submenu-item mb-2">Element d'environment</a>
                        <a href="/conpetanceElement" class="submenu-item">Element de competance</a>
                    </div>
                </div>
            </div>

            <!-- Menu Analytics Mobile -->
            <div class="list-group-item mb-2">
                <a class="submenu-toggle d-flex align-items-center justify-content-between px-0"
                    data-mdb-toggle="collapse"
                    href="#analyticsSubmenu"
                    role="button"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tools fa-fw me-3"></i>
                        <span>Outil de supervision</span>
                    </div>
                </a>
                <div class="collapse" id="analyticsSubmenu">
                    <div class="submenu-collapse mt-2">
                        <a href="/etablissementsanitaire" class="submenu-item mb-2">Etablissement sanitaire</a>
                        <a href="/identifiantsuperviser" class="submenu-item mb-2">Identifiants supervisés</a>
                        <a href="/idenfiantsuperviseurs" class="submenu-item">Identifiants superviseurs</a>
                    </div>
                </div>
            </div>

            <div class="list-group-item mb-2">
                <a href="/synthesesupervision" class="list-group-item-action d-flex align-items-center px-0">
                    <i class="fas fa-chart-pie fa-fw me-3"></i>
                    <span>Synthèse supervision</span>
                </a>
            </div>
            <div class="list-group-item mb-2">
                <a href="/problemeprioritaire" class="list-group-item-action d-flex align-items-center px-0">
                    <i class="fas fa-exclamation-circle fa-fw me-3"></i>
                    <span>Problèmes prioritaires</span>
                </a>
            </div>
            
        </div>
    </div>
</div>