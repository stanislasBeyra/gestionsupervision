<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Application')</title>

    <!-- PWA méta tags -->
    <link rel="manifest" href="{{ asset('manifest.json') }}"> 
     {{-- <link rel="manifest" href="{{ route('manifest') }}"> --}}
    <meta name="theme-color" content="#2563eb">

    <!-- <link rel="manifest" href="/manifest.json"> -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Supervision Sanitaire">
    <meta name="apple-mobile-web-app-title" content="Supervision">
    <meta name="theme-color" content="#2563eb">
    <meta name="msapplication-navbutton-color" content="#2563eb">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-starturl" content="/">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #FBFBFB;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        @media (min-width: 992px) {
            main {
                padding-left: 260px;
            }

            #sidebarMenu {
                display: block !important;
            }

            .offcanvas {
                display: none;
            }
        }

        @media (max-width: 991.98px) {
            .sidebar {
                display: none;
            }

            #sidebarMenu {
                display: none !important;
            }

            main {
                padding-left: 0 !important;
            }
        }

        .offcanvas {
            transition: transform 0.3s ease-in-out;
            width: 80% !important;
        }
    </style>
    @yield('styles')
</head>