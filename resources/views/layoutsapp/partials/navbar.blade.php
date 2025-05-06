<style>
    .navbar{
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important; /* Ombre très légère */

    }
</style>

<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="offcanvas"
            data-mdb-target="#offcanvasExample" aria-controls="offcanvasExample">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="#">
        <img src="{{ url('app-icons.svg') }}" height="55" alt="Logo partenairesmtn" loading="lazy" />        </a>

        <!-- Search form -->
        <!-- <form class="d-none d-md-flex input-group w-auto my-auto">
            <input autocomplete="off" type="search" class="form-control rounded"
                placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
            <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
        </form> -->

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
            <!-- Notification dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
                    role="button" data-mdb-dropdown-init aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <!-- <span class="badge rounded-pill badge-notification bg-danger">1</span> -->
                </a>
                <!-- <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Some news</a></li>
                    <li><a class="dropdown-item" href="#">Another news</a></li>
                    <li><a class="dropdown-item" href="#">Something else</a></li>
                </ul> -->
            </li>

            <!-- Avatar -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                    id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle"
                        height="22" alt="" loading="lazy" />
                </a>
                <!-- <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Mon profil</a></li>
                    <li><a class="dropdown-item" href="#">Paramètres</a></li>
                    <li><a class="dropdown-item" href="#">Déconnexion</a></li>
                </ul> -->
            </li>
        </ul>
    </div>
</nav>
