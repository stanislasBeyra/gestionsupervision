<!-- Sidebar Desktop -->
<nav id="sidebarMenu" class="sidebar collapse d-lg-block">
    <div class="sidebar-content">
        <!-- Logo -->
        <div class="sidebar-logo">
            <i class="fas fa-shield-alt"></i>
            <span>Supervision</span>
        </div>

        <!-- Menu -->
        <div class="sidebar-menu">
            <a href="/dashboard" class="menu-link" data-route="dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <!-- Outil de supervision -->
            <div class="menu-section">
                <div class="menu-link menu-toggle" data-target="outilSubmenu">
                    <i class="fas fa-tools"></i>
                    <span>Outil de supervision</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <div class="submenu" id="outilSubmenu">
                    <a href="/etablissementsanitaire" class="submenu-link" data-route="etablissementsanitaire">Établissement sanitaire</a>
                    <a href="/identifiantsuperviser" class="submenu-link" data-route="identifiantsuperviser">Identifiants supervisés</a>
                    <a href="/identifiantsuperviseurs" class="submenu-link" data-route="identifiantsuperviseurs">Identifiants superviseurs</a>
                </div>
            </div>

            <!-- Supervision -->
            <div class="menu-section">
                <div class="menu-link menu-toggle" data-target="supervisionSubmenu">
                    <i class="fas fa-desktop"></i>
                    <span>Supervision</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <div class="submenu" id="supervisionSubmenu">
                    <a href="/created" class="submenu-link" data-route="created">Vue d'ensemble</a>
                    <a href="/environnementElement" class="submenu-link" data-route="environnementElement">Élément d'environnement</a>
                    <a href="/conpetanceElement" class="submenu-link" data-route="conpetanceElement">Élément de compétence</a>
                </div>
            </div>

            <a href="/synthesesupervision" class="menu-link" data-route="synthesesupervision">
                <i class="fas fa-chart-pie"></i>
                <span>Synthèse supervision</span>
            </a>

            <a href="/problemeprioritaire" class="menu-link" data-route="problemeprioritaire">
                <i class="fas fa-exclamation-circle"></i>
                <span>Problèmes prioritaires</span>
            </a>
        </div>

        <!-- Footer -->
        <div class="sidebar-footer">
            <a href="{{ asset('files/rapport.docx') }}" download class="download-link">
                <i class="fas fa-download"></i>
                <span>Télécharger le fichier Word</span>
            </a>
        </div>
    </div>
</nav>

<!-- Sidebar Mobile -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample">
    <div class="offcanvas-header">
        <div class="mobile-logo">
            <i class="fas fa-shield-alt"></i>
            <span>Supervision</span>
        </div>
        <button type="button" class="btn-close" data-mdb-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mobile-menu">
            <a href="/dashboard" class="mobile-link" data-route="dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <div class="mobile-section">
                <div class="mobile-link mobile-toggle" data-target="mobileOutilSubmenu">
                    <i class="fas fa-tools"></i>
                    <span>Outil de supervision</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <div class="mobile-submenu" id="mobileOutilSubmenu">
                    <a href="/etablissementsanitaire" class="mobile-submenu-link" data-route="etablissementsanitaire">Établissement sanitaire</a>
                    <a href="/identifiantsuperviser" class="mobile-submenu-link" data-route="identifiantsuperviser">Identifiants supervisés</a>
                    <a href="/identifiantsuperviseurs" class="mobile-submenu-link" data-route="identifiantsuperviseurs">Identifiants superviseurs</a>
                </div>
            </div>

            <div class="mobile-section">
                <div class="mobile-link mobile-toggle" data-target="mobileSupervisionSubmenu">
                    <i class="fas fa-desktop"></i>
                    <span>Supervision</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <div class="mobile-submenu" id="mobileSupervisionSubmenu">
                    <a href="/created" class="mobile-submenu-link" data-route="created">Vue d'ensemble</a>
                    <a href="/environnementElement" class="mobile-submenu-link" data-route="environnementElement">Élément d'environnement</a>
                    <a href="/conpetanceElement" class="mobile-submenu-link" data-route="conpetanceElement">Élément de compétence</a>
                </div>
            </div>

            <a href="/synthesesupervision" class="mobile-link" data-route="synthesesupervision">
                <i class="fas fa-chart-pie"></i>
                <span>Synthèse supervision</span>
            </a>

            <a href="/problemeprioritaire" class="mobile-link" data-route="problemeprioritaire">
                <i class="fas fa-exclamation-circle"></i>
                <span>Problèmes prioritaires</span>
            </a>
        </div>

        <div class="mobile-footer">
            <a href="{{ asset('files/rapport.docx') }}" download class="mobile-download-link">
                <i class="fas fa-download"></i>
                <span>Télécharger le fichier Word</span>
            </a>
        </div>
    </div>
</div>

<style>
    /* Variables */
    :root {
        --sidebar-width: 260px;
        --sidebar-bg: #ffffff;
        --sidebar-text: #334155;
        --sidebar-text-hover: #1e293b;
        --sidebar-active: #2563eb;
        --sidebar-border: #e2e8f0;
        --sidebar-hover: #f1f5f9;
    }

    /* Desktop Sidebar - Important pour override MDB */
    #sidebarMenu.sidebar {
        width: var(--sidebar-width) !important;
        background: var(--sidebar-bg) !important;
        border-right: 1px solid var(--sidebar-border) !important;
        position: fixed !important;
        top: 58px !important;
        left: 0 !important;
        height: calc(100vh - 58px) !important;
        z-index: 1000 !important;
        overflow-y: auto !important;
        padding: 0 !important;
    }

    .sidebar-content {
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
        padding: 24px 0 !important;
    }

    /* Logo */
    .sidebar-logo {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        padding: 0 24px 24px !important;
        border-bottom: 1px solid var(--sidebar-border) !important;
        margin-bottom: 16px !important;
    }

    .sidebar-logo i {
        font-size: 24px;
        color: var(--sidebar-active);
    }

    .sidebar-logo span {
        font-size: 18px;
        font-weight: 600;
        color: var(--sidebar-text-hover);
    }

    /* Menu */
    .sidebar-menu {
        flex: 1 !important;
        padding: 0 16px !important;
    }

    .menu-link {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        padding: 12px 16px !important;
        margin-bottom: 4px !important;
        border-radius: 8px !important;
        color: var(--sidebar-text) !important;
        text-decoration: none !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
        background: transparent !important;
        border: none !important;
    }

    .menu-link:hover {
        background: var(--sidebar-hover) !important;
        color: var(--sidebar-text-hover) !important;
    }

    .menu-link.active {
        background: rgba(37, 99, 235, 0.1) !important;
        color: var(--sidebar-active) !important;
        font-weight: 600 !important;
    }

    .menu-link i {
        width: 20px;
        font-size: 16px;
        text-align: center;
    }

    .menu-toggle {
        cursor: pointer;
    }

    .arrow {
        margin-left: auto;
        font-size: 12px;
        transition: transform 0.3s ease;
    }

    .menu-toggle.active .arrow {
        transform: rotate(180deg);
    }

    /* Submenu */
    .submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        padding-left: 32px;
    }

    .submenu.open {
        max-height: 300px;
    }

    .submenu-link {
        display: block;
        padding: 10px 16px;
        margin-bottom: 2px;
        border-radius: 6px;
        color: var(--sidebar-text);
        text-decoration: none;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .submenu-link:hover {
        background: var(--sidebar-hover);
        color: var(--sidebar-text-hover);
    }

    .submenu-link.active {
        color: var(--sidebar-active);
        font-weight: 600;
    }

    /* Footer */
    .sidebar-footer {
        padding: 16px !important;
        border-top: 1px solid var(--sidebar-border) !important;
        margin-top: auto !important;
    }

    .download-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px;
        background: var(--sidebar-active);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        transition: background 0.2s ease;
    }

    .download-link:hover {
        background: #1d4ed8;
        color: white;
    }

    /* Mobile */
    .mobile-logo {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mobile-logo i {
        font-size: 24px;
        color: var(--sidebar-active);
    }

    .mobile-logo span {
        font-size: 18px;
        font-weight: 600;
        color: var(--sidebar-text-hover);
    }

    .mobile-menu {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .mobile-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 8px;
        color: var(--sidebar-text);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .mobile-link:hover {
        background: var(--sidebar-hover);
        color: var(--sidebar-text-hover);
    }

    .mobile-link.active {
        background: rgba(37, 99, 235, 0.1);
        color: var(--sidebar-active);
        font-weight: 600;
    }

    .mobile-link i {
        width: 20px;
        font-size: 16px;
        text-align: center;
    }

    .mobile-toggle {
        cursor: pointer;
    }

    .mobile-submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        padding-left: 32px;
    }

    .mobile-submenu.open {
        max-height: 300px;
    }

    .mobile-submenu-link {
        display: block;
        padding: 10px 16px;
        margin-bottom: 2px;
        border-radius: 6px;
        color: var(--sidebar-text);
        text-decoration: none;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .mobile-submenu-link:hover {
        background: var(--sidebar-hover);
        color: var(--sidebar-text-hover);
    }

    .mobile-submenu-link.active {
        color: var(--sidebar-active);
        font-weight: 600;
    }

    .mobile-footer {
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid var(--sidebar-border);
    }

    .mobile-download-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px;
        background: var(--sidebar-active);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        transition: background 0.2s ease;
    }

    .mobile-download-link:hover {
        background: #1d4ed8;
        color: white;
    }

    /* Scrollbar */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: var(--sidebar-border);
        border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle submenus
    document.querySelectorAll('.menu-toggle, .mobile-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const submenu = document.getElementById(targetId);
            
            if (submenu) {
                const isOpen = submenu.classList.contains('open');
                
                // Close all other submenus
                document.querySelectorAll('.submenu, .mobile-submenu').forEach(menu => {
                    if (menu !== submenu) {
                        menu.classList.remove('open');
                        menu.previousElementSibling?.classList.remove('active');
                    }
                });
                
                // Toggle current submenu
                submenu.classList.toggle('open');
                this.classList.toggle('active');
            }
        });
    });

    // Set active menu item
    function setActiveMenuItem() {
        const currentPath = window.location.pathname;
        
        // Remove all active classes
        document.querySelectorAll('.menu-link, .submenu-link, .mobile-link, .mobile-submenu-link').forEach(item => {
            item.classList.remove('active');
        });
        
        // Set active based on route
        document.querySelectorAll('[data-route]').forEach(item => {
            const route = item.getAttribute('data-route');
            if (currentPath.includes(route) || currentPath === '/' + route) {
                item.classList.add('active');
                
                // Open parent submenu if it's a submenu item
                const submenuItem = item.closest('.submenu, .mobile-submenu');
                if (submenuItem) {
                    submenuItem.classList.add('open');
                    const toggle = document.querySelector(`[data-target="${submenuItem.id}"]`);
                    if (toggle) {
                        toggle.classList.add('active');
                    }
                }
            }
        });
    }

    // Initialize
    setActiveMenuItem();

    // Update on navigation
    window.addEventListener('popstate', setActiveMenuItem);
    
    document.querySelectorAll('a[href]').forEach(link => {
        link.addEventListener('click', function() {
            setTimeout(setActiveMenuItem, 100);
        });
    });
});
</script>
