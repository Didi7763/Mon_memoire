@php
    // Récupérer les accès et permissions de l'utilisateur depuis la session
    $ListAccApp = session('ListAccApp', []);
    $ListPermApp = session('ListPermApp', []);
@endphp

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
            width: 20vw;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1000;
            overflow-y: auto;
            transition: width 0.3s ease;
        }

        #right-panel {
            margin-left: 20vw;
            width: 80vw;
            min-height: 100vh;
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        .sidebar-collapsed {
            width: 10vw !important;
        }

        .sidebar-collapsed + #right-panel {
            margin-left: 10vw !important;
            width: 90vw !important;
        }

        .sidebar-collapsed .link-text {
            display: none;
        }

        .sidebar-collapsed .flex.items-center {
            justify-content: center;
            padding: 0.5rem !important;
        }

        .sidebar-collapsed .ml-6 {
            margin-left: 0 !important;
        }

        .sidebar-collapsed .p-3 {
            padding: 0.5rem !important;
        }

        .sidebar-collapsed .p-2 {
            padding: 0.25rem !important;
        }

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

        [x-cloak] {
            display: none !important;
        }

        .bi-eye-fill {
    transition: color 0.2s ease-in-out;
}

.bi-eye-fill:hover {
    color: #1e40af; /* Une teinte plus foncée de bleu */
}
    </style>
</head>

<body class="font-quicksand bg-gray-100">
    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 bg-white shadow-lg">
        <div class="p-4">
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
            @if(in_array('données', $ListAccApp) || in_array('logiciels', $ListAccApp) || in_array('matériels', $ListAccApp) || in_array('catégories', $ListAccApp))
            <li id="actifs-parent">
                <a href="#" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->is('actif*') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-display mr-2"></i>
                    <span class="link-text">Actifs</span>
                </a>
                <ul class="ml-6 mt-2 space-y-1">
                    @if(in_array('données', $ListAccApp))
                    <li id="actifs-donnees">
                        <a href="{{ route('donnees.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('donnees.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-database mr-2"></i>
                            <span class="link-text">Actifs de données</span>
                        </a>
                    </li>
                    @endif
                    @if(in_array('logiciels', $ListAccApp))
                    <li id="actifs-logiciel">
                        <a href="{{ route('logiciel.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('logiciel.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-terminal mr-2"></i>
                            <span class="link-text">Actif logiciel</span>
                        </a>
                    </li>
                    @endif
                    @if(in_array('matériels', $ListAccApp))
                    <li id="actifs-materiel">
                        <a href="{{ route('materiel.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('materiel.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-cpu mr-2"></i>
                            <span class="link-text">Actif matériel</span>
                        </a>
                    </li>
                    @endif
                    @if(in_array('catégories', $ListAccApp))
                    <li id="actifs-categorie">
                        <a href="{{ route('categorie.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('categorie.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-card-checklist mr-2"></i>
                            <span class="link-text">Catégorie matériel</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            <!-- Utilisateur -->
            @if(in_array('employes', $ListAccApp) || in_array('services', $ListAccApp))
            <li id="utilisateur-parent">
                <a href="#" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->is('utilisateur*') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-person mr-2"></i>
                    <span class="link-text">Utilisateur</span>
                </a>
                <ul class="ml-6 mt-2 space-y-1">
                    @if(in_array('employes', $ListAccApp))
                    <li id="utilisateur-employe">
                        <a href="{{ route('User_Employe.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('User_Employe.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-person-badge mr-2"></i>
                            <span class="link-text">Employé</span>
                        </a>
                    </li>
                    @endif
                    @if(in_array('services', $ListAccApp))
                    <li id="utilisateur-service">
                        <a href="{{ route('User_Service.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('User_Service.*') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-gear mr-2"></i>
                            <span class="link-text">Service</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            <!-- Fournisseur -->
            @if(in_array('fournisseurs', $ListAccApp))
            <li>
                <a href="{{ route('fournisseurs.index') }}" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('fournisseurs.*') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-truck mr-2"></i>
                    <span class="link-text">Fournisseur</span>
                </a>
            </li>
            @endif

            <!-- Attribution -->
            @if(in_array('attribution', $ListAccApp))
            <li>
                <a href="{{ route('attributions.index') }}" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('attributions.index') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-award mr-2"></i>
                    <span class="link-text">Attribution</span>
                </a>
            </li>
            @endif

            <!-- Maintenance -->
            @if(in_array('maintenances', $ListAccApp))
            <li>
                <a href="{{ route('maintenance.index') }}" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('maintenance.*') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-tools mr-2"></i>
                    <span class="link-text">Maintenance</span>
                </a>
            </li>
            @endif

            <!-- Historique -->
            @if(in_array('historiques', $ListAccApp))
            <li>
                <a href="{{ route('historiques.index') }}" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->is('historiques') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-clock-history mr-2"></i>
                    <span class="link-text">Historique</span>
                </a>
            </li>
            @endif

            <!-- Compte -->
            <li id="compte-parent">
                <a href="#" class="flex items-center p-3 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->is('compte*') ? 'bg-blue-100' : '' }}">
                    <i class="bi bi-person-circle mr-2"></i>
                    <span class="link-text">Compte</span>
                </a>
                <ul class="ml-6 mt-2 space-y-1">
                    @if(in_array('nouveau compte', $ListAccApp))
                    <li id="compte-nouveau">
                        <a href="{{ route('user.create') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('compte.nouveau') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-person-plus mr-2"></i>
                            <span class="link-text">Nouveau Compte</span>
                        </a>
                    </li>
                    @endif
                    @if(in_array('tous comptes', $ListAccApp))
                    <li id="comptes">
                        <a href="{{ route('user.index') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('compte.nouveau') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-people-fill"></i>
                            <span class="link-text">Les comptes</span>
                        </a>
                    </li>
                    @endif
                    <li id="compte-profil">
                        <a href="{{ route('compte.profil') }}" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg {{ request()->routeIs('compte.profil') ? 'bg-blue-100' : '' }}">
                            <i class="bi bi-person-lines-fill mr-2"></i>
                            <span class="link-text">Mon Profil</span>
                        </a>
                    </li>
                    <li id="compte-deconnexion">
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center p-2 text-blue-900 hover:bg-blue-50 rounded-lg">
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
                    <button onclick="toggleSidebar()" class="text-2xl text-blue-900 focus:outline-none">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                <div class="flex items-center space-x-6">
                    <form class="flex items-center">
                        <input type="text" placeholder="Rechercher..." class="p-2 border border-gray-300 rounded-l w-48 h-10">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r h-10 w-12">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>

                    <i class="bi bi-brightness-high-fill text-3xl cursor-pointer dark-mode-toggle"></i>

                    <div class="relative">
                        <i class="bi bi-bell-fill text-3xl cursor-pointer text-blue-500" onclick="toggleNotifications()"></i>
                        <span id="notification-counter" class="absolute -top-1 right-0 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5 {{ $unreadCount > 0 ? '' : 'hidden' }}">
                            {{ $unreadCount }}
                        </span>
                        <div id="notifications-dropdown" class="hidden absolute right-0 mt-2 w-96 bg-white shadow-lg rounded-lg z-50">
                            <div class="p-2">
                                <h3 class="font-semibold">Notifications</h3>
                                <ul class="space-y-0.5">
                                    @foreach($unreadNotifications as $notification)
                                        <li id="notification-{{ $notification->id }}" class="hover:bg-gray-100 rounded-lg flex justify-between items-center">
                                            <a href="#" class="block flex-grow">
                                                {{ $notification->message }}
                                            </a>
                                            <i class="bi bi-eye-fill text-blue-500 cursor-pointer ml-2" onclick="markAsRead({{ $notification->id }}, event)"></i>
                                        </li>
                                    @endforeach
                                </ul>
                                <button onclick="markAllAsRead()" class="mt-2 w-full text-center text-blue-500 hover:text-blue-700">
                                    Marquer tout comme lu
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Avatar avec dropdown -->
                    <div x-data="{ open: false }" class="relative group mr-4">
                        @php
                            $user = Auth::user();
                            $profilePhotoUrl = $user && $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://www.w3schools.com/w3images/avatar2.png';
                        @endphp
                        <div class="relative">
                            <img src="{{ $profilePhotoUrl }}" alt="Avatar" class="w-10 h-10 rounded-full">
                            <span class="absolute bottom-8 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                        </div>
                        <div @mouseenter="open = true" @mouseleave="open = false" class="w-6 h-6 cursor-pointer flex items-center justify-center absolute -left-0.5 top-6 bottom-0 right-0 ml-8">
                            <i class="bi bi-caret-down-fill text-gray-500 text-sm"></i>
                        </div>
                        <ul x-show="open" @mouseenter="open = true" @mouseleave="open = false" class="absolute top-full mt-2 right-0 w-48 bg-white shadow-lg rounded-lg z-50" x-cloak>
                            <li><a href="{{ route('compte.profil') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">Mon Profil</a></li>
                            <li>
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
    <script src="//unpkg.com/alpinejs" defer></script>

    <script>function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('sidebar-collapsed');
    }

    function toggleNotifications() {
        const dropdown = document.getElementById('notifications-dropdown');
        dropdown.classList.toggle('hidden');
    }

    function updateNotificationCounter() {
        fetch('/notifications/unread-count', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const counterElement = document.getElementById('notification-counter');
            if (data.unreadCount > 0) {
                counterElement.textContent = data.unreadCount;
                counterElement.classList.remove('hidden');
            } else {
                counterElement.textContent = '';
                counterElement.classList.add('hidden');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la mise à jour du compteur de notifications:', error);
        });
    }

    function markAsRead(notificationId, event) {
    if (event) {
        event.stopPropagation();
    }

    fetch(`/notifications/mark-as-read/${notificationId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notificationElement = document.getElementById(`notification-${notificationId}`);
            if (notificationElement) {
                notificationElement.remove();
            }
            updateNotificationCounter();
        }
    })
    .catch(error => {
        console.error('Erreur lors du marquage comme lu:', error);
    });
}

function markAllAsRead() {
    fetch('/notifications/mark-all-as-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notificationsList = document.querySelectorAll('[id^="notification-"]');
            notificationsList.forEach(notification => notification.remove());
            updateNotificationCounter();
            const dropdown = document.getElementById('notifications-dropdown');
            dropdown.classList.add('hidden');
        }
    })
    .catch(error => {
        console.error('Erreur lors du marquage de toutes les notifications comme lues:', error);
    });
}

    // Mettre à jour le compteur toutes les 60 secondes
    setInterval(updateNotificationCounter, 60000);

    // Initialiser le compteur au chargement de la page
    document.addEventListener('DOMContentLoaded', updateNotificationCounter);
    </script>
    <script src="{{ asset('js/darkMode.js') }}"></script>
</body>
</html>
