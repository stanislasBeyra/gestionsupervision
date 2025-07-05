<style>
    .navbar {
        box-shadow: 0 0.5px 2px rgba(0, 0, 0, 0.05) !important;
        /* Ombre très légère */

    }
</style>

<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="offcanvas" data-mdb-target="#offcanvasExample"
            aria-controls="offcanvasExample">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="#">
            <img src="{{ url('app-icons.svg') }}" height="55" alt="Logo partenairesmtn" loading="lazy" /> </a>



        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">


            <!-- Avatar -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                    id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">
                    @if(auth()->user()->profil_image)
                        <img src="{{ asset('storage/' . auth()->user()->profil_image) }}" 
                             alt="Photo de profil" 
                             class="rounded-circle" 
                             width="32" 
                             height="32" 
                             style="object-fit: cover;"
                             id="navbarProfileImage">
                    @else
                        <i class="fas fa-user-circle fa-lg text-primary" id="navbarProfileIcon"></i>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="/profile">Mon profil</a></li>
                    <li><a class="dropdown-item" href="#">Paramètres</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>