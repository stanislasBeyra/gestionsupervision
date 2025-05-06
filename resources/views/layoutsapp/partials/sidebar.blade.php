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
                        <div class="ps-4 submenu-content">
                            <a href="/etablissementsanitaire" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Etablissement sanitaire</a>
                            <a href="/identifiantsuperviser" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Identifiants supervisés</a>
                            <a href="/identifiantsuperviseurs" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Identifiants superviseurs</a>
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
                        <div class="ps-4 submenu-content">
                            <a href="/created" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Vue d'ensemble</a>
                            <a href="/environnementElement" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Element d'environment</a>
                            <a href="/conpetanceElement" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Element de competance</a>
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

<!-- Menu Desktop (Sidebar) -->
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky d-flex flex-column" style="height: calc(100vh - 56px);">
        <!-- Contenu principal avec défilement -->
        <div class="flex-grow-1 overflow-auto">
            <div class="list-group list-group-flush mx-3 mt-4">
                <!-- Dashboard principal -->
                <div class="list-group-item mb-2">
                    <a href="/dashboard" class="list-group-item-action d-flex align-items-center px-0 no-blue-effect">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                

                <!-- Menu Analytics -->
                <div class="list-group-item mb-2">
                    <div class="d-flex align-items-center justify-content-between px-0 custom-toggle no-blue-effect" 
                         data-target="analyticsSubmenu">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-tools fa-fw me-3"></i>
                            <span>Outil de supervision</span>
                        </div>
                        <span class="custom-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </div>
                    <div class="custom-collapse mt-2" id="analyticsSubmenu">
                        <div class="ps-4 submenu-content">
                            <a href="/etablissementsanitaire" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Etablissement sanitaire</a>
                            <a href="/identifiantsuperviser" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Identifiants supervisés</a>
                            <a href="/identifiantsuperviseurs" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Identifiants superviseurs</a>
                        </div>
                    </div>
                </div>

                <!-- Menu Supervision -->
                <div class="list-group-item mb-2">
                    <div class="d-flex align-items-center justify-content-between px-0 custom-toggle no-blue-effect" 
                         data-target="supervisionSubmenu">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-desktop fa-fw me-3"></i>
                            <span>Supervision</span>
                        </div>
                        <span class="custom-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </div>
                    <div class="custom-collapse mt-2" id="supervisionSubmenu">
                        <div class="ps-4 submenu-content">
                            <a href="/created" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Vue d'ensemble</a>
                            <a href="/environnementElement" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Element d'environment</a>
                            <a href="/conpetanceElement" class="d-block mb-2 text-decoration-none no-blue-effect menu-item">Element de competance</a>
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

        <!-- Bouton de téléchargement fixé en bas -->
        <div class="border-top mt-2 p-2 bg-light">
            <a href="#" class="btn btn-sm btn-secondary w-100 d-flex align-items-center justify-content-center shadow-sm no-blue-effect" id="sidebarDownloadBtn" style="font-size: 0.7rem; box-shadow: 0 1px 1px rgba(0,0,0,0.1);">
                <i class="fas fa-download me-1"></i>
                Télécharger les données
            </a>
        </div>
    </div>
</nav>

<!-- CSS for animations and removing blue effect -->
<style>
/* Hide collapse containers by default */
.custom-collapse {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s cubic-bezier(0, 1, 0, 1);
}

/* Show when the .show class is present */
.custom-collapse.show {
    max-height: 1000px;
    transition: max-height 0.5s ease-in-out;
}

/* Styles for dropdown items */
.custom-toggle {
    cursor: pointer;
    user-select: none;
    color: #4f4f4f;
    transition: all 0.3s ease;
}

/* Submit animation */
.submenu-content {
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.custom-collapse.show .submenu-content {
    opacity: 1;
    transform: translateY(0);
}

/* Staggered animation for menu items */
.menu-item {
    opacity: 0;
    transform: translateX(-10px);
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.custom-collapse.show .menu-item:nth-child(1) {
    transition-delay: 0.1s;
}

.custom-collapse.show .menu-item:nth-child(2) {
    transition-delay: 0.2s;
}

.custom-collapse.show .menu-item:nth-child(3) {
    transition-delay: 0.3s;
}

.custom-collapse.show .menu-item {
    opacity: 1;
    transform: translateX(0);
}

/* Remove blue effect class */
.no-blue-effect {
    background-color: transparent !important;
}

.no-blue-effect:hover, 
.no-blue-effect:focus,
.no-blue-effect:active,
.no-blue-effect.active {
    background-color: transparent !important;
    color: inherit !important;
    box-shadow: none !important;
    border-color: transparent !important;
}

/* Override specific MDB blue color */
.list-group-item, 
.list-group-item-action, 
.list-group-item:hover, 
.list-group-item:focus,
.list-group-item.active,
.list-group-item-action:hover,
.list-group-item-action:focus,
.list-group-item-action.active {
    background-color: transparent !important;
    color: inherit !important;
    border: none !important;
}

/* Disable Bootstrap and MDB blue color */
.active, .selected, .bg-primary, .bg-info, .bg-primary-subtle {
    background-color: transparent !important;
    color: inherit !important;
}

/* Arrow animation */
.custom-arrow i {
    transition: transform 0.4s ease;
}

.custom-toggle.active .custom-arrow i {
    transform: rotate(180deg);
}

/* Remove effects when active */
[aria-selected="true"], [aria-expanded="true"] {
    background-color: transparent !important;
    color: inherit !important;
}
</style>

<!-- JavaScript for custom collapse implementation with animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Disable MDB if needed
    if (typeof mdb !== 'undefined') {
        document.querySelectorAll('.custom-collapse').forEach(el => {
            el.classList.remove('collapse');
        });
    }
    
    // Implementation of custom collapse behavior
    document.querySelectorAll('.custom-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all elements
            document.querySelectorAll('.custom-toggle').forEach(t => {
                if (t !== this && t.classList.contains('active')) {
                    t.classList.remove('active');
                    const targetId = t.getAttribute('data-target');
                    const el = document.getElementById(targetId);
                    if (el) {
                        el.classList.remove('show');
                    }
                }
            });
            
            // Toggle active state for this element
            this.classList.toggle('active');
            
            // Toggle collapse
            const targetId = this.getAttribute('data-target');
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.classList.toggle('show');
            }
            
            // Remove classes that might add blue effect
            this.classList.remove('bg-primary', 'bg-info', 'text-white', 'active');
        });
    });
    
    // Function to remove blue effects
    function removeBlueEffects() {
        // Remove classes that add blue effects
        document.querySelectorAll('*').forEach(el => {
            if (el.classList.contains('bg-primary') || 
                el.classList.contains('bg-info') || 
                el.classList.contains('blue') ||
                el.classList.contains('active-menu-item')) {
                el.classList.remove('bg-primary', 'bg-info', 'blue', 'active-menu-item');
            }
        });
    }
    
    // Run periodically to ensure blue effects are removed
    removeBlueEffects();
    setInterval(removeBlueEffects, 100);
    
    // Intercept events that might add blue effect classes
    document.addEventListener('click', function() {
        setTimeout(removeBlueEffects, 10);
    });
});
</script>