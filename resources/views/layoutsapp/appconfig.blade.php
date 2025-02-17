
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Application')</title>

    <!-- PWA méta tags -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#3b82f6">
    
    <!-- iOS méta tags -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Problèmes">
    
    <!-- iOS icônes -->
    <link rel="apple-touch-icon" href="/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/icon-180x180.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/icons/icon-167x167.png">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css" rel="stylesheet">

    <style>
       body {
            background-color:#FBFBFB;
        }

        /* button{
            box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
        } */

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
            padding-left: 0rem;
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
