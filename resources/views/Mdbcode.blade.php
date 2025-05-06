<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css" rel="stylesheet" />
    <style>
       body {
            background-color:#FBFBFB;
        }

        @media (min-width: 992px) {
            main {
                padding-left: 240px;
            }
            #sidebarMenu {
                display: block !important;
            }
            .offcanvas {
                display: none;
            }
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%); */
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                display: none;
            }
            #sidebarMenu {
                display: none !important;
            }
        }

        .offcanvas {
            transition: transform 0.3s ease-in-out;
            width: 80% !important;
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* Styles pour les sous-menus */
        .collapse:not(.show) {
            display: none !important;
        }

        .submenu-collapse {
            padding-left: 2rem;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin: 0.5rem 0;
        }

        .collapse.show {
            display: block !important;
        }

        .collapsing {
            height: 0;
            overflow: hidden;
            transition: height 0.35s ease;
        }

        .submenu-item {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            color: #4f4f4f;
            text-decoration: none;
            display: block;
            transition: all 0.3s;
        }

        .submenu-item:hover {
            background-color: rgba(0,0,0,0.05);
            color: #1266f1;
        }

        .list-group-item {
            border: none;
            padding: 0.5rem 0;
        }

        .submenu-toggle {
            position: relative;
            width: 100%;
            text-align: left;
            padding: 0.5rem 1rem;
            color: #4f4f4f;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
        }

        .submenu-toggle:hover {
            background-color: rgba(0,0,0,0.05);
            color: #1266f1;
        }

        .submenu-toggle::after {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f107";
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
        }

        .submenu-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        .submenu-icon-text {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar .active {
            border-radius: 5px;
            /* box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%); */
            background-color: #1266f1 !important;
            color: white !important;
        }
    </style>
</head>

<body >
    <header>
        <!-- Sidebar Desktop -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar  collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <!-- Menu Dashboard -->
                    <div class="list-group-item">
                        <a class="submenu-toggle d-flex align-items-center" data-mdb-toggle="collapse" href="#dashboardSubmenu" role="button" aria-expanded="false">
                            <div class="submenu-icon-text">
                                <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                        <div class="collapse" id="dashboardSubmenu" aria-expanded="false">
                            <div class="submenu-collapse">
                                <a href="#" class="submenu-item">Vue d'ensemble</a>
                                <a href="#" class="submenu-item">Statistiques</a>
                                <a href="#" class="submenu-item">Rapports</a>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Analytics -->
                    <div class="list-group-item">
                        <a class="submenu-toggle d-flex align-items-center" href="#analyticsSubmenu" data-mdb-toggle="collapse">
                            <div class="submenu-icon-text">
                                <i class="fas fa-chart-line fa-fw me-3"></i>
                                <span>Analytics</span>
                            </div>
                        </a>
                        <div class="collapse" id="analyticsSubmenu">
                            <div class="submenu-collapse">
                                <a href="#" class="submenu-item">Trafic</a>
                                <a href="#" class="submenu-item">Performance</a>
                                <a href="#" class="submenu-item">SEO</a>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Utilisateurs -->
                    <div class="list-group-item">
                        <a class="submenu-toggle d-flex align-items-center" href="#usersSubmenu" data-mdb-toggle="collapse">
                            <div class="submenu-icon-text">
                                <i class="fas fa-users fa-fw me-3"></i>
                                <span>Utilisateurs</span>
                            </div>
                        </a>
                        <div class="collapse" id="usersSubmenu">
                            <div class="submenu-collapse">
                                <a href="#" class="submenu-item">Liste</a>
                                <a href="#" class="submenu-item">Rôles</a>
                                <a href="#" class="submenu-item">Permissions</a>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Configuration -->
                    <div class="list-group-item">
                        <a class="submenu-toggle d-flex align-items-center" href="#settingsSubmenu" data-mdb-toggle="collapse">
                            <div class="submenu-icon-text">
                                <i class="fas fa-cog fa-fw me-3"></i>
                                <span>Configuration</span>
                            </div>
                        </a>
                        <div class="collapse" id="settingsSubmenu">
                            <div class="submenu-collapse">
                                <a href="#" class="submenu-item">Général</a>
                                <a href="#" class="submenu-item">Sécurité</a>
                                <a href="#" class="submenu-item">Notifications</a>
                            </div>
                        </div>
                    </div>

                    <!-- Autres menus -->
                    <div class="list-group-item">
                        <a class="submenu-toggle d-flex align-items-center" href="#reportsSubmenu" data-mdb-toggle="collapse">
                            <div class="submenu-icon-text">
                                <i class="fas fa-file-alt fa-fw me-3"></i>
                                <span>Rapports</span>
                            </div>
                        </a>
                        <div class="collapse" id="reportsSubmenu">
                            <div class="submenu-collapse">
                                <a href="#" class="submenu-item">Journalier</a>
                                <a href="#" class="submenu-item">Mensuel</a>
                                <a href="#" class="submenu-item">Annuel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Offcanvas Mobile -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="list-group list-group-flush">
                    <!-- Menu Dashboard Mobile -->
                    <div class="list-group-item">
                        <a class="submenu-toggle d-flex align-items-center" href="#dashboardSubmenuMobile" data-mdb-toggle="collapse">
                            <div class="submenu-icon-text">
                                <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                        <div class="collapse" id="dashboardSubmenuMobile">
                            <div class="submenu-collapse">
                                <a href="#" class="submenu-item">Vue d'ensemble</a>
                                <a href="#" class="submenu-item">Statistiques</a>
                                <a href="#" class="submenu-item">Rapports</a>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Analytics Mobile -->
                    <div class="list-group-item">
                        <a class="submenu-toggle d-flex align-items-center" href="#analyticsSubmenuMobile" data-mdb-toggle="collapse">
                            <div class="submenu-icon-text">
                                <i class="fas fa-chart-line fa-fw me-3"></i>
                                <span>Analytics</span>
                            </div>
                        </a>
                        <div class="collapse" id="analyticsSubmenuMobile">
                            <div class="submenu-collapse">
                                <a href="#" class="submenu-item">Trafic</a>
                                <a href="#" class="submenu-item">Performance</a>
                                <a href="#" class="submenu-item">SEO</a>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Utilisateurs Mobile -->
                    <div class="list-group-item">
                        <a class="submenu-toggle d-flex align-items-center" href="#usersSubmenuMobile" data-mdb-toggle="collapse">
                            <div class="submenu-icon-text">
                                <i class="fas fa-users fa-fw me-3"></i>
                                <span>Utilisateurs</span>
                            </div>
                        </a>
                        <div class="collapse" id="usersSubmenuMobile">
                            <div class="submenu-collapse">
                                <a href="#" class="submenu-item">Liste</a>
                                <a href="#" class="submenu-item">Rôles</a>
                                <a href="#" class="submenu-item">Permissions</a>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Configuration Mobile -->
                    <div class="list-group-item">
                        <a class="submenu-toggle d-flex align-items-center" href="#settingsSubmenuMobile" data-mdb-toggle="collapse">
                            <div class="submenu-icon-text">
                                <i class="fas fa-cog fa-fw me-3"></i>
                                <span>Configuration</span>
                            </div>
                        </a>
                        <div class="collapse" id="settingsSubmenuMobile">
                            <div class="submenu-collapse">
                                <a href="#" class="submenu-item">Général</a>
                                <a href="#" class="submenu-item">Sécurité</a>
                                <a href="#" class="submenu-item">Notifications</a>
                            </div>
                        </div>
                    </div>

                    <!-- Autres menus Mobile -->
                    <div class="list-group-item">
                        <a class="submenu-toggle d-flex align-items-center" href="#reportsSubmenuMobile" data-mdb-toggle="collapse">
                            <div class="submenu-icon-text">
                                <i class="fas fa-file-alt fa-fw me-3"></i>
                                <span>Rapports</span>
                            </div>
                        </a>
                        <div class="collapse" id="reportsSubmenuMobile">
                            <div class="submenu-collapse">
                                <a href="#" class="submenu-item">Journalier</a>
                                <a href="#" class="submenu-item">Mensuel</a>
                                <a href="#" class="submenu-item">Annuel</a>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="offcanvas"
                    data-mdb-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="25" alt="" loading="lazy" />
                </a>

                <!-- Search form -->
                <form class="d-none d-md-flex input-group w-auto my-auto">
                    <input autocomplete="off" type="search" class="form-control rounded"
                        placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
                    <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                </form>

                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <!-- Notification dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
                            role="button" data-mdb-dropdown-init aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Some news</a></li>
                            <li><a class="dropdown-item" href="#">Another news</a></li>
                            <li><a class="dropdown-item" href="#">Something else</a></li>
                        </ul>
                    </li>

                    <!-- Icon -->
                    <li class="nav-item">
                        <a class="nav-link me-3 me-lg-0" href="#">
                            <i class="fas fa-fill-drip"></i>
                        </a>
                    </li>

                    <!-- Icon -->
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>

                    <!-- Icon dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdown"
                            role="button" data-mdb-dropdown-init aria-expanded="false">
                            <i class="united kingdom flag m-0"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#"><i class="united kingdom flag"></i>English
                                    <i class="fa fa-check text-success ms-2"></i></a>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="#"><i class="poland flag"></i>Polski</a></li>
                            <li><a class="dropdown-item" href="#"><i class="china flag"></i>中文</a></li>
                            <li><a class="dropdown-item" href="#"><i class="japan flag"></i>日本語</a></li>
                            <li><a class="dropdown-item" href="#"><i class="germany flag"></i>Deutsch</a></li>
                            <li><a class="dropdown-item" href="#"><i class="france flag"></i>Français</a></li>
                            <li><a class="dropdown-item" href="#"><i class="spain flag"></i>Español</a></li>
                            <li><a class="dropdown-item" href="#"><i class="russia flag"></i>Русский</a></li>
                            <li><a class="dropdown-item" href="#"><i class="portugal flag"></i>Português</a></li>
                        </ul>
                    </li>

                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                            id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle"
                                height="22" alt="" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Mon profil</a></li>
                            <li><a class="dropdown-item" href="#">Paramètres</a></li>
                            <li><a class="dropdown-item" href="#">Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main  style="margin-top: 58px">
        <div class="container pt-4">
            <section>
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div class="align-self-center">
                                        <i class="fas fa-pencil-alt text-info fa-3x"></i>
                                    </div>
                                    <div class="text-end">
                                        <h3>278</h3>
                                        <p class="mb-0">New Posts</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Autres cartes statistiques -->
                </div>
            </section>
        </div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.umd.min.js"></script>
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
            <!-- // Configuration des options de l'offcanvas
            const offcanvasElement = document.getElementById('offcanvasExample');
            const offcanvas = new mdb.Offcanvas(offcanvasElement, {
                backdrop: true,
                keyboard: true,
                focus: true
            });

            // Gestion du bouton close
            const closeButton = document.querySelector('[data-mdb-dismiss="offcanvas"]');
            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    offcanvas.hide();
                });
            }

            // Gestion du bouton toggle
            const toggleButton = document.querySelector('.navbar-toggler');
            if (toggleButton) {
                toggleButton.addEventListener('click', function() {
                    offcanvas.toggle();
                });
            }

            // Initialisation des dropdowns
            document.querySelectorAll('[data-mdb-dropdown-init]').forEach((element) => {
                new mdb.Dropdown(element);
            });

            // Initialisation des collapses pour les sous-menus
            const collapseElements = document.querySelectorAll('.submenu-collapse, [id^="dashboardSubmenu"], [id^="analyticsSubmenu"], [id^="usersSubmenu"], [id^="settingsSubmenu"], [id^="reportsSubmenu"]');
            collapseElements.forEach((element) => {
                new mdb.Collapse(element);
            });

            // Gestion des liens des sous-menus
            document.querySelectorAll('.submenu-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    const collapse = mdb.Collapse.getInstance(targetElement);
                    if (collapse) {
                        collapse.toggle();
                    }
                });
            });

            // Gestion des flèches
            document.querySelectorAll('.submenu-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';
                    this.setAttribute('aria-expanded', !isExpanded);
                });
            });

            // Gestion du redimensionnement
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992 && offcanvasElement.classList.contains('show')) {
                    offcanvas.hide();
                }
            });
        }); -->
    </script>
    </script>
</body>
</html>