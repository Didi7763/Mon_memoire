<!DOCTYPE html>
<html lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--w3schools css-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!--font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lato:wght@300;400;700&family=Open+Sans:wght@300;400;600;700&family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Kurale&family=Nerko+One&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <!--Bootstrapp css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--custom css-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('custom-css-add')
    <title>@yield('title')</title>

    <body>
        <!-- Sidebar -->
        <div class="w3-sidebar w3-bar-block" id="sidebar">
            <h3 class="w3-bar-item">CARENA</h3>
                <ul>
                    <li> <a href="#tableau de bord" class="active"><i class="bi bi-speedometer2"></i>Tableau de bord</a></li>
                    <li class="has-submenu"><a href="#actifs"><i class="bi bi-display"></i>Actifs</a>
                        <ul class="submenu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-database"></i>Actifs de données</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-terminal"></i>Actif logiciel</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-cpu"></i>Actif matériel</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#utilisateur"><i class="bi bi-person"></i>Utilisateur</a>
                        <ul class="submenu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-badge"></i>Employé</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i>Service</a></li>
                        </ul>
                    </li>
                    <li><a href="#fournisseur"><i class="bi bi-truck"></i>Fournisseur</a></li>
                    <li><a href="#attribution"><i class="bi bi-award"></i>Attribution</a></li>
                    <li><a href="#maintenance"><i class="bi bi-tools"></i>Maintenance</a></li>
                    <li><a href="#historique"><i class="bi bi-clock-history"></i>Historique</a></li>
                    <li class="has-submenu"><a href="#compte"><i class="bi bi-person-circle"></i>Compte</a>
                        <ul class="submenu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-plus"></i>Nouveau Compte</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-lines-fill"></i>Mon Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i>Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
        </div>

        <!-- rigth panel (le coté droit) -->
        <div class="rigth-panel">

            <!--navbar (barre horizontale)-->
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
                            <!--le fichier doit etre en format png-->
                            <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="avatar">
                            <i class="bi bi-circle-fill"></i>
                            <i class="bi bi-caret-down-fill"></i>
                        </div>
                    </div>

                </div>
            </nav>

            <div class="w3-container w3-light-grey" id="contentpage">
               @yield('main-content')
            </div>

        </div>

    </body>
</html>
