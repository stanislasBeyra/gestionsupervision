<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
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