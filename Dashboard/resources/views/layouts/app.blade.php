<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- W3Schools CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Fonts et icônes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lato:wght@300;400;700&family=Open+Sans:wght@300;400;600;700&family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Kurale&family=Nerko+One&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('custom-css-add')

    <title>@yield('title', 'Application')</title>
</head>
<body>
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block" id="sidebar">
        <!--<h3 class="w3-bar-item">CARENA</h3>-->
        <img src="{{ asset('images/logo_carena-removebg-preview.png') }}" alt="Description de l'image" srcset="">

        <ul>
            <!-- Tableau de bord -->
            <li>
                <a href="{{ route('mondash') }}" class="{{ request()->routeIs('mondash') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>Tableau de bord
                </a>
            </li>

            <!-- Actifs -->
            <li class="has-submenu {{ request()->is('actif*') || request()->routeIs(['donnees.index','donnees.create','donnees.edit','logiciel.create', 'logiciel.edit', 'logiciel.index', 'materiel.index', 'materiel.create', 'materiel.edit', 'categorie.index','categorie.create','categorie.edit']) ? 'active' : '' }}">
                <a href="#" class="{{ request()->is('actif*') || request()->routeIs(['donnees.index','donnees.create','donnees.edit','logiciel.create', 'logiciel.edit', 'logiciel.index', 'materiel.index', 'materiel.create', 'materiel.edit', 'categorie.index','categorie.create','categorie.edit']) ? 'active' : '' }}">
                    <i class="bi bi-display"></i>Actifs
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('donnees.index') }}" class="{{ request()->routeIs('donnees.index') || request()->routeIs('donnees.create') || request()->routeIs('donnees.edit') ? 'active' : '' }}">
                            <i class="bi bi-database"></i>Actifs de données
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logiciel.index') }}" class="{{ request()->routeIs('logiciel.index') || request()->routeIs('logiciel.create') || request()->routeIs('logiciel.edit') ? 'active' : '' }}">
                            <i class="bi bi-terminal"></i>Actif logiciel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('materiel.index') }}" class="{{ request()->routeIs('materiel.index') || request()->routeIs('materiel.create') || request()->routeIs('materiel.edit') ? 'active' : '' }}">
                            <i class="bi bi-cpu"></i>Actif matériel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categorie.index') }}" class="{{ request()->routeIs('categorie.index') || request()->routeIs('categorie.create') || request()->routeIs('categorie.edit') ? 'active' : '' }}">
                            <i class="bi bi-card-checklist"></i>Catégorie matériel
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Utilisateur -->
            <li class="has-submenu {{ request()->is('utilisateur*') || request()->routeIs(['User_Employe.index', 'User_Employe.create', 'User_Employe.edit', 'User_Service.index','User_Service.create', 'User_Service.edit']) ? 'active' : '' }}">
                <a href="#" class="{{ request()->is('utilisateur*') || request()->routeIs(['User_Employe.index', 'User_Employe.create', 'User_Employe.edit', 'User_Service.index','User_Service.create', 'User_Service.edit']) ? 'active' : '' }}">
                    <i class="bi bi-person"></i>Utilisateur
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('User_Employe.index') }}" class="{{ request()->routeIs('User_Employe.index') || request()->routeIs('User_Employe.create') || request()->routeIs('User_Employe.edit') ? 'active' : '' }}">
                            <i class="bi bi-person-badge"></i>Employé
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('User_Service.index') }}" class="{{ request()->routeIs('User_Service.index') || request()->routeIs('User_Service.create') || request()->routeIs('User_Service.edit') ? 'active' : '' }}">
                            <i class="bi bi-gear"></i>Service
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Fournisseur -->
            <li>
                <a href="{{ route('fournisseurs.index') }}" class="{{ request()->routeIs('fournisseurs.index') ? 'active' : '' }}">
                    <i class="bi bi-truck"></i>Fournisseur
                </a>
            </li>

            <!-- Attribution -->
            <li>
                <a href="{{ route('attributions.index') }}" class="{{ request()->routeIs('attributions.index') ? 'active' : '' }}">
                    <i class="bi bi-award"></i>Attribution
                </a>
            </li>

            <!-- Maintenance -->
            <li>
                <a href="{{ route('maintenance.index') }}" class="{{ request()->routeIs('maintenance.index') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i>Maintenance
                </a>
            </li>

            <!-- Historique -->
            <li>
                <a href="{{ route('historiques.index') }}" class="{{ request()->is('historiques') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>Historique
                </a>
            </li>

            <!-- Compte -->
            <li class="has-submenu {{ request()->is('compte*') || request()->is(['nouveau-compte', 'profil', 'deconnexion']) ? 'active' : '' }}">
                <a href="#" class="{{ request()->is('compte*') || request()->is(['nouveau-compte', 'profil', 'deconnexion']) ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i>Compte
                </a>
                <ul class="submenu">
                    <li>
                        <a href="#" class="{{ request()->is('nouveau-compte') ? 'active' : '' }}">
                            <i class="bi bi-person-plus"></i>Nouveau Compte
                        </a>
                    </li>
                    <li>
                        <a href="#" class="{{ request()->is('profil') ? 'active' : '' }}">
                            <i class="bi bi-person-lines-fill"></i>Mon Profil
                        </a>
                    </li>
                    <li>
                        <a href="#" class="{{ request()->is('deconnexion') ? 'active' : '' }}">
                            <i class="bi bi-box-arrow-right"></i>Déconnexion
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>


    <!-- Right Panel -->
    <div class="rigth-panel">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="w3-container" id="header">
                <div class="first-header">
                    <i class="bi bi-list"></i>
                </div>
                <div class="second-header">
                    <div class="sh-search">
                        <form action="">
                            <input type="text" placeholder="Rechercher.." name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="sh-dark-mode">
                        <i class="bi bi-brightness-high-fill"></i>
                    </div>
                    <div class="sh-notification">
                        <i class="bi bi-bell-fill"></i>
                        <span class="counter">1</span>
                    </div>
                    <div class="sh-avatar">
                        <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="avatar">
                        <i class="bi bi-circle-fill"></i>
                        <div class="dropdown">
                            <i class="bi bi-caret-down-fill"></i>
                            <ul class="dropdown-menu">
                                <li><a href="#profile"> <i class="bi bi-person-plus"></i>Nouveau Compte</a></li>
                                <li><a href="#settings"><i class="bi bi-person-lines-fill"></i>Mon Profil</a></li>
                                <li><a href="#logout"><i class="bi bi-box-arrow-right"></i>Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="w3-container w3-light-grey" id="contentpage">
            @yield('main-content')
        </div>
    </div>

    <!-- Optional Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('custom-js-add')
</body>
</html>
