<!DOCTYPE html>
<html lang="fr">

<head>
    @include('layouts.appconfig') <!-- Fichier de configuration -->
    <title>@yield('title', 'Dashboard')</title>

    <style>
        /* Variables de couleurs personnalisées */
        :root {
            --primary-gradient: linear-gradient(45deg, #2962ff 0%, #1976d2 100%);
            --secondary-gradient: linear-gradient(45deg, #4a5568 0%, #2d3748 100%);
            --warning-gradient: linear-gradient(45deg, #ed8936 0%, #dd6b20 100%);
            --success-gradient: linear-gradient(45deg, #48bb78 0%, #2f855a 100%);
            --hover-overlay: rgba(255, 255, 255, 0.1);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 16.66667%;
            z-index: 1030;
            background: var(--primary-gradient);
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Contenu principal */
        .main-content {
            margin-left: 16%;
            width: calc(100% - 16.66667%);
            min-height: 100vh;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        /* Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 99;
            width: 100%;
            color: white;
            background: var(--primary-gradient);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-toggler {
            padding: 0.5rem;
            font-size: 1.2rem;
            display: none;
            border: none;
        }

        /* Dropdowns */
        .dropdown-menu {
            z-index: 1000;
            display: none;
            min-width: 10rem;
            background-color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu.show {
            display: block !important;
        }

        .nav-item.dropdown {
            position: relative;
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }

        /* Navigation */
        .nav-link {
            color: white;
            padding: 0.8rem 1rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: var(--hover-overlay);
            color: white;
        }

        .navbar .nav-link {
            color: #000;
        }

        .navbar .nav-link:hover {
            background: none;
            color: #e66a0a;
        }

        /* Badges et notifications */
        .nav-link .badge {
            z-index: 2;
        }

        /* Offcanvas */
        .offcanvas {
            max-width: 280px;
            z-index: 1040;
            background: white;
        }

        .offcanvas-backdrop {
            z-index: 1035;
        }

        .offcanvas .nav-link {
            color: #000;
            padding: 0.8rem 1rem;
            transition: background-color 0.3s;
        }

        .offcanvas .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .offcanvas .nav-link.active {
            background: var(--primary-gradient);
            color: white;
        }

        /* Cartes statistiques */
        .stat-card {
            transition: transform 0.2s, box-shadow 0.3s;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            border: none !important;
            background: white;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
        }

        /* Boîtes d'icônes */
        .icon-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .icon-box.bg-primary {
            background: var(--primary-gradient) !important;
        }

        .icon-box.bg-secondary {
            background: var(--secondary-gradient) !important;
        }

        .icon-box.bg-warning {
            background: var(--warning-gradient) !important;
        }

        .icon-box.bg-success {
            background: var(--success-gradient) !important;
        }

        /* Couleurs de texte */
        .text-primary {
            color: #e66a0a !important;
        }

        .text-secondary {
            color: #4a5568 !important;
        }

        .text-warning {
            color: #ed8936 !important;
        }

        .text-success {
            color: #48bb78 !important;
        }

        /* Media queries */
        @media (max-width: 991.98px) {
            .sidebar {
                width: 25%;
            }

            .main-content {
                margin-left: 25%;
                width: calc(100% - 25%);
            }
        }

        @media (max-width: 767.98px) {
            .navbar-toggler {
                display: block;
            }

            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                padding-top: 1rem;
            }

            .navbar {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .navbar-brand {
                margin-right: auto;
            }

            .page-title {
                font-size: 20px;
            }
        }

        .toast-container {
            z-index: 1050;
        }

        .toast {
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
        }

        .toast.showing,
        .toast.show {
            opacity: 1;
        }

        .toast.hide {
            display: none;
        }

        .toast-body {
            font-size: 0.9rem;
            padding: 0.75rem 1rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="">
        <div class="row">
            @include('layouts.partials.sidebar')
            @include('layouts.partials.mobile-sidebar')

            <div class="main-content">
                @include('layouts.partials.navbar')

                <main class="p-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @include('layouts.partials.script')
</body>

</html>