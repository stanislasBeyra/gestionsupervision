<script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.umd.min.js"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>


        <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Configuration de l'offcanvas
            const offcanvasElement = document.getElementById('offcanvasExample');
            const offcanvas = new mdb.Offcanvas(offcanvasElement, {
                backdrop: true,
                keyboard: true,
                focus: true
            });

            // Initialisation des collapses pour les sous-menus
            const collapseList = document.querySelectorAll('.collapse');
            collapseList.forEach((collapse) => {
                // Force la fermeture de tous les sous-menus au démarrage
                collapse.classList.remove('show');
                // Vérifier si l'instance existe déjà avant d'initialiser
                const existingInstance = mdb.Collapse.getInstance(collapse);
                if (!existingInstance) {
                    // Initialise le composant collapse de MDB seulement si aucune instance n'existe
                new mdb.Collapse(collapse, {
                    toggle: false
                });
                }
            });

            // Gestion des clics sur les toggles
            document.querySelectorAll('.submenu-toggle').forEach((toggle) => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const collapse = document.getElementById(targetId);
                    const instance = mdb.Collapse.getInstance(collapse);
                    if (instance) {
                        instance.toggle();
                    }
                    // Met à jour l'état de la flèche
                    this.setAttribute('aria-expanded', 
                        this.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'
                    );
                });
            });

            // Initialisation des dropdowns de la navbar
            document.querySelectorAll('[data-mdb-dropdown-init]').forEach((element) => {
                new mdb.Dropdown(element);
            });

            // Gestion du bouton de fermeture de l'offcanvas
            const closeButton = document.querySelector('[data-mdb-dismiss="offcanvas"]');
            if(closeButton) {
                closeButton.addEventListener('click', function() {
                    offcanvas.hide();
                });
            }

            // Gestion du bouton d'ouverture de l'offcanvas
            const toggleButton = document.querySelector('.navbar-toggler');
            if(toggleButton) {
                toggleButton.addEventListener('click', function() {
                    offcanvas.toggle();
                });
            }

            // Gestion du redimensionnement
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992 && offcanvasElement.classList.contains('show')) {
                    offcanvas.hide();
                }
            });
        });
    </script>
    
    <script>
      
      
        // Script pour gérer l'état actif des liens dans la sidebar et l'offcanvas
        document.addEventListener('DOMContentLoaded', function () {
            // Gestion des liens de la sidebar
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Fermer l'offcanvas sur mobile quand un lien est cliqué
            const offcanvasLinks = document.querySelectorAll('#sidebarMenu .nav-link');
            const offcanvas = new mdb.Offcanvas(document.getElementById('sidebarMenu'));
            offcanvasLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    offcanvas.hide();
                });
            });
        });
    </script>