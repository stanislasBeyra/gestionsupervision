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
                        <a href="#" class="submenu-item mb-2">Element d'environment</a>
                        <a href="#" class="submenu-item">Element de competance</a>
                    </div>
                </div>
            </div>

            <!-- Menu Analytics Mobile -->
            <div class="list-group-item mb-2">
                <a class="submenu-toggle d-flex align-items-center justify-content-between px-0"
                    data-mdb-toggle="collapse"
                    href="#analyticsSubmenuMobile"
                    role="button"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-chart-line fa-fw me-3"></i>
                        <span>Analytics</span>
                    </div>

                </a>
                <div class="collapse" id="analyticsSubmenuMobile">
                    <div class="submenu-collapse mt-2">
                        <a href="#" class="submenu-item mb-2">Trafic</a>
                        <a href="#" class="submenu-item mb-2">Performance</a>
                        <a href="#" class="submenu-item">SEO</a>
                    </div>
                </div>
            </div>

            <!-- Menu Utilisateurs Mobile -->
            <div class="list-group-item mb-2">
                <a class="submenu-toggle d-flex align-items-center justify-content-between px-0"
                    data-mdb-toggle="collapse"
                    href="#usersSubmenuMobile"
                    role="button"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-fw me-3"></i>
                        <span>Utilisateurs</span>
                    </div>

                </a>
                <div class="collapse" id="usersSubmenuMobile">
                    <div class="submenu-collapse mt-2">
                        <a href="#" class="submenu-item mb-2">Liste</a>
                        <a href="#" class="submenu-item mb-2">Rôles</a>
                        <a href="#" class="submenu-item">Permissions</a>
                    </div>
                </div>
            </div>

            <!-- Menu Configuration Mobile -->
            <div class="list-group-item mb-2">
                <a class="submenu-toggle d-flex align-items-center justify-content-between px-0"
                    data-mdb-toggle="collapse"
                    href="#settingsSubmenuMobile"
                    role="button"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-cog fa-fw me-3"></i>
                        <span>Configuration</span>
                    </div>

                </a>
                <div class="collapse" id="settingsSubmenuMobile">
                    <div class="submenu-collapse mt-2">
                        <a href="#" class="submenu-item mb-2">Général</a>
                        <a href="#" class="submenu-item mb-2">Sécurité</a>
                        <a href="#" class="submenu-item">Notifications</a>
                    </div>
                </div>
            </div>

            <!-- Menu Rapports Mobile -->
            <div class="list-group-item mb-2">
                <a class="submenu-toggle d-flex align-items-center justify-content-between px-0"
                    data-mdb-toggle="collapse"
                    href="#reportsSubmenuMobile"
                    role="button"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-alt fa-fw me-3"></i>
                        <span>Rapports</span>
                    </div>

                </a>
                <div class="collapse" id="reportsSubmenuMobile">
                    <div class="submenu-collapse mt-2">
                        <a href="#" class="submenu-item mb-2">Journalier</a>
                        <a href="#" class="submenu-item mb-2">Mensuel</a>
                        <a href="#" class="submenu-item">Annuel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>