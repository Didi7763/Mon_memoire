<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Application')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Fonts et icônes -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @yield('custom-css-add')

    <style>
        /* Styles pour le sidebar et le panel-right */
        #sidebar {
            width: 20vw; /* 20% de la largeur par défaut */
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1000; /* S'assurer qu'il est au-dessus du contenu */
            overflow-y: auto; /* Permettre le défilement si le contenu est trop long */
            transition: width 0.3s ease; /* Animation fluide */
        }

        #right-panel {
            margin-left: 20vw; /* Commence après le sidebar */
            width: 80vw; /* 80% de la largeur par défaut */
            min-height: 100vh; /* Prend toute la hauteur */
            transition: margin-left 0.3s ease, width 0.3s ease; /* Animation fluide */
        }

        /* Styles pour le sidebar réduit */
        .sidebar-collapsed {
            width: 10vw !important; /* 10% de la largeur lorsque réduit */
        }

        .sidebar-collapsed + #right-panel {
            margin-left: 10vw !important; /* Ajuster le panel-right */
            width: 90vw !important; /* 90% de la largeur lorsque réduit */
        }

        /* Masquer les textes des liens et centrer les icônes lorsque le sidebar est réduit */
        .sidebar-collapsed .link-text {
            display: none; /* Masquer le texte */
        }

        .sidebar-collapsed .flex.items-center {
            justify-content: center; /* Centrer les icônes */
            padding: 0.5rem !important; /* Réduire le padding */
        }

        /* Ajuster le padding des sous-menus */
        .sidebar-collapsed .ml-6 {
            margin-left: 0 !important; /* Supprimer la marge des sous-menus */
        }

        .sidebar-collapsed .p-3 {
            padding: 0.5rem !important; /* Réduire le padding des liens principaux */
        }

        .sidebar-collapsed .p-2 {
            padding: 0.25rem !important; /* Réduire le padding des sous-liens */
        }

        /* Personnalisation de la barre de défilement */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Masquer les éléments avec x-cloak */
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="font-quicksand bg-gray-100">
    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 bg-white shadow-lg">
        <div class="p-4">
            <!-- Image CARENA réduite -->
            <img src="{{ asset('images/logo_carena-removebg-preview.png') }}" alt="Logo CARENA" class="w-32 mx-auto">
        </div>
        <ul class="mt-4 space-y-2">
            <!-- Tableau de bord -->
            <li>
                <a href="{{ route('mondash') }}" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('mondash') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-speedometer2 mr-2"></i>
                    <span class="link-text">Tableau de bord</span>
                </a>
            </li>

            <!-- Actifs -->
            <li id="actifs-parent">
                <a href="#" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->is('actif*') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-display mr-2"></i>
                    <span class="link-text">Actifs</span>
                </a>
                <ul class="ml-6 mt-2 space-y-1">
                    <li id="actifs-donnees">
                        <a href="{{ route('donnees.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('donnees.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-database mr-2"></i>
                            <span class="link-text">Actifs de données</span>
                        </a>
                    </li>
                    <li id="actifs-logiciel">
                        <a href="{{ route('logiciel.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('logiciel.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-terminal mr-2"></i>
                            <span class="link-text">Actif logiciel</span>
                        </a>
                    </li>
                    <li id="actifs-materiel">
                        <a href="{{ route('materiel.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('materiel.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-cpu mr-2"></i>
                            <span class="link-text">Actif matériel</span>
                        </a>
                    </li>
                    <li id="actifs-categorie">
                        <a href="{{ route('categorie.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('categorie.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-card-checklist mr-2"></i>
                            <span class="link-text">Catégorie matériel</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Utilisateur -->
            <li id="utilisateur-parent">
                <a href="#" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->is('utilisateur*') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-person mr-2"></i>
                    <span class="link-text">Utilisateur</span>
                </a>
                <ul class="ml-6 mt-2 space-y-1">
                    <li id="utilisateur-employe">
                        <a href="{{ route('User_Employe.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('User_Employe.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-person-badge mr-2"></i>
                            <span class="link-text">Employé</span>
                        </a>
                    </li>
                    <li id="utilisateur-service">
                        <a href="{{ route('User_Service.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('User_Service.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-gear mr-2"></i>
                            <span class="link-text">Service</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Fournisseur -->
            <li>
                <a href="{{ route('fournisseurs.index') }}" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('fournisseurs.*') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-truck mr-2"></i>
                    <span class="link-text">Fournisseur</span>
                </a>
            </li>

            <!-- Attribution -->
            <li>
                <a href="{{ route('attributions.index') }}" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('attributions.index') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-award mr-2"></i>
                    <span class="link-text">Attribution</span>
                </a>
            </li>

            <!-- Maintenance -->
            <li>
                <a href="{{ route('maintenance.index') }}" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('maintenance.*') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-tools mr-2"></i>
                    <span class="link-text">Maintenance</span>
                </a>
            </li>

            <!-- Historique -->
            <li>
                <a href="{{ route('historiques.index') }}" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->is('historiques') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-clock-history mr-2"></i>
                    <span class="link-text">Historique</span>
                </a>
            </li>

            <!-- Compte -->
            <li id="compte-parent">
                <a href="#" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->is('compte*') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-person-circle mr-2"></i>
                    <span class="link-text">Compte</span>
                </a>
                <ul class="ml-6 mt-2 space-y-1">
                    <li id="compte-nouveau">
                        <a href="{{ route('user.create') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('compte.nouveau') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-person-plus mr-2"></i>
                            <span class="link-text">Nouveau Compte</span>
                        </a>
                    </li>
                    <li id="compte-profil">
    <a href="{{ route('compte.profil') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('compte.profil') ? 'bg-blue-100' : '' }}">
        <i class="bi bi-person-lines-fill mr-2"></i>
        <span class="link-text">Mon Profil</span>
    </a>
</li>
                                <li id="compte-deconnexion">
                                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="flex items-center  p-2 text-blue-900 hover:bg-blue-50 rounded-lg">
                    <i class="bi bi-box-arrow-right mr-2"></i>
                    <span class="link-text">Déconnexion</span>
                </button>
            </form>
                        </li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Right Panel -->
    <div id="right-panel" class="bg-gray-50 min-h-screen" style="height: 100vh;">
        <!-- Navbar -->
        <nav class="bg-white shadow p-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <!-- Bouton du menu -->
                    <button onclick="toggleSidebar()" class="text-2xl text-blue-900 focus:outline-none">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                <div class="flex items-center space-x-6">
                    <!-- Search Bar -->
                    <form class="flex items-center">
                        <input type="text" placeholder="Rechercher..." class="p-2 border border-gray-300 rounded-l w-48 h-10">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r h-10 w-12">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>

                    <!-- Dark Mode -->
                    <i class="bi bi-brightness-high-fill text-3xl cursor-pointer dark-mode-toggle"></i>

                    <!-- Notification -->
                    <div class="relative">
                        <i class="bi bi-bell-fill text-3xl cursor-pointer text-blue-500"></i>
                        <span class="absolute -top-1 right-0 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">1</span>
                    </div>

                    <!-- Avatar avec dropdown -->
                    <div x-data="{ open: false }" class="relative group mr-4">
                        <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="w-10 h-10 rounded-full">
                        <i class="bi bi-circle-fill text-green-500 absolute top-0 right-0 text-xs"></i>
                        <!-- Icône du dropdown -->
                        <div @mouseenter="open = true" @mouseleave="open = false" class="w-6 h-6 cursor-pointer flex items-center justify-center absolute -left-0.5 top-6 bottom-0 right-0 ml-8">
                            <i class="bi bi-caret-down-fill text-gray-500 text-sm"></i>
                        </div>
                        <!-- Liste du dropdown -->
                        <ul x-show="open" @mouseenter="open = true" @mouseleave="open = false" class="absolute top-full mt-2 right-0 w-48 bg-white shadow-lg rounded-lg z-50" x-cloak>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">Nouveau Compte</a></li>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">Mon Profil</a></li>
                            <li>
                                <!-- Formulaire de déconnexion -->
                                    <form action="{{ route('logout') }}" method="POST" class="block w-full">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                                            Déconnexion
                                        </button>
                                    </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="p-8 overflow-y-auto" style="max-height: calc(100vh - 64px);">
            @yield('main-content')
        </div>
    </div>

    <!-- Optional Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('sidebar-collapsed');
        }

        // Activer le module parent si un sous-module est actif
        document.addEventListener('DOMContentLoaded', function() {
            const modules = [
                { parent: 'actifs-parent', children: ['actifs-donnees', 'actifs-logiciel', 'actifs-materiel', 'actifs-categorie'] },
                { parent: 'utilisateur-parent', children: ['utilisateur-employe', 'utilisateur-service'] },
                { parent: 'compte-parent', children: ['compte-nouveau', 'compte-profil', 'compte-deconnexion'] }
            ];

            modules.forEach(module => {
                module.children.forEach(childId => {
                    const childElement = document.getElementById(childId);
                    if (childElement && childElement.querySelector('a.bg-blue-100')) {
                        const parentElement = document.getElementById(module.parent);
                        if (parentElement) {
                            parentElement.querySelector('a').classList.add('bg-blue-100');
                        }
                    }
                });
            });
        });
    </script>
        <script src="{{ asset('js/darkMode.js') }}"></script>

</body>
</html>
