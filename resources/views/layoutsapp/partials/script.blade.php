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
                // Initialise le composant collapse de MDB
                new mdb.Collapse(collapse, {
                    toggle: false
                });
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
        // Configuration du graphique en barres
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai'],
                datasets: [{
                    label: "Nombre d'incidents",
                    data: [18, 14, 16, 12, 15],
                    backgroundColor: '#3B82F6',
                    borderColor: '#3B82F6',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Configuration du graphique circulaire
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Opérationnel', 'En maintenance', 'Hors service'],
                datasets: [{
                    data: [60, 25, 15],
                    backgroundColor: ['#4CAF50', '#FFA726', '#EF5350'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20
                        }
                    }
                }
            }
        });

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
            const offcanvas = new bootstrap.Offcanvas(document.getElementById('sidebarMenu'));
            offcanvasLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    offcanvas.hide();
                });
            });
        });
    </script>