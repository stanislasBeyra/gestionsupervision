<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky d-flex flex-column" style="height: calc(100vh - 56px);">
        <!-- Contenu principal avec défilement -->
        <div class="flex-grow-1 overflow-auto">
            <div class="list-group list-group-flush mx-3 mt-4">
                <!-- Dashboard principal -->
                <div class="list-group-item mb-2">
                    <a href="/dashboard" class="list-group-item-action d-flex align-items-center px-0">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <!-- Menu Supervision -->
                <div class="list-group-item mb-2">
                    <a class="submenu-toggle d-flex align-items-center justify-content-between px-0"
                        data-mdb-toggle="collapse"
                        href="#supervisionSubmenu"
                        role="button"
                        aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-desktop fa-fw me-3"></i>
                            <span>Supervision</span>
                        </div>
                    </a>
                    <div class="collapse" id="supervisionSubmenu" aria-expanded="false">
                        <div class="submenu-collapse mt-2">
                            <a href="/created" class="submenu-item mb-2">Vue d'ensemble</a>
                            <a href="/environnementElement" class="submenu-item mb-2">Element d'environment</a>
                            <a href="/conpetanceElement" class="submenu-item">Element de competance</a>
                        </div>
                    </div>
                </div>

                <!-- Menu Analytics -->
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

        <!-- Bouton de téléchargement fixé en bas -->
        <div class="border-top mt-2 p-2 bg-light">
            <a href="#" class="btn btn-sm btn-secondary w-100 d-flex align-items-center justify-content-center shadow-sm" id="sidebarDownloadBtn" style="font-size: 0.7rem; box-shadow: 0 1px 1px rgba(0,0,0,0.1);">
                <i class="fas fa-download me-1"></i>
                Télécharger les données
            </a>
        </div>
    </div>
</nav>