<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-flex align-items-center ms-auto">
            <!-- Notifications Dropdown -->
            <div class="nav-item dropdown me-3">
                <a class="nav-link position-relative text-dark" href="#" id="notificationsDropdown"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell fs-5"></i>
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow"
                    aria-labelledby="notificationsDropdown">
                    <h6 class="dropdown-header">Notifications</h6>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        Nouveau message
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user-plus me-2 text-success"></i>
                        Nouvel utilisateur
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-center small" href="#">Voir tout</a>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#"
                    id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://i.pinimg.com/474x/37/81/ec/3781ec5c95d5598fabd76b796eabb027.jpg"
                        class="rounded-circle me-2" alt="Avatar" width="32" height="32">
                    <!-- <span class="text-white">John Doe</span> -->
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a>
                    </li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>