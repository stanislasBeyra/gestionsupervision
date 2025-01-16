<div class="sidebar d-none d-md-block">
    <div class="pt-4 pb-3 text-center">
        <h3 class="text-white mb-0">MTN</h3>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="/">
                <i class="fas fa-chart-pie me-2"></i>
                Dashboard
            </a>
        </li>

        <!-- Menu Supervisions -->
        <li class="nav-item">
            <a class="nav-link" href="#" id="supervisionMenu" role="button" aria-expanded="false">
                <i class="fas fa-tasks me-2"></i>
                Supervisions
            </a>
            <ul class="nav flex-column" id="supervisionDropdown" style="display: none;">
                <li class="nav-item">
                    <a class="nav-link" href="/supervision">Vue d'ensemble</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/supervision/ajouter">Éléments de l'environnement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/supervision/archives">Éléments de compétence</a>
                </li>
            </ul>
        </li>

        <!-- Menu Outil de supervision -->
        <li class="nav-item">
            <a class="nav-link" href="#" id="outilsMenu" role="button" aria-expanded="false">
                <i class="fas fa-chart-bar me-2"></i>
                Outil de supervision
            </a>
            <ul class="nav flex-column" id="outilsDropdown" style="display: none;">
                <li class="nav-item">
                    <a class="nav-link" href="/outildesupervision">Etablissement Sanitaire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/lessupervisee">Id des supervisés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/outildesupervision/archives">Archives</a>
                </li>
            </ul>
        </li>

        <!-- Autres éléments du menu -->
        <li class="nav-item">
            <a class="nav-link" href="/synthesesupervision">
                <i class="fas fa-chart-line me-2"></i>
                synthèse de supervision
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-shopping-cart me-2"></i>
                Orders
            </a>
        </li>
    </ul>
</div>

<script>
    // Ajouter un événement pour afficher ou masquer le menu déroulant Supervisions
    document.getElementById('supervisionMenu').addEventListener('click', function(e) {
        e.preventDefault();
        var dropdown = document.getElementById('supervisionDropdown');
        dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
    });

    // Ajouter un événement pour afficher ou masquer le menu déroulant Outils de supervision
    document.getElementById('outilsMenu').addEventListener('click', function(e) {
        e.preventDefault();
        var dropdown = document.getElementById('outilsDropdown');
        dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
    });
</script>