<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        /* Sidebar styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #343a40;
            color: white;
        }

        .sidebar .nav-link {
            color: white;
            padding: 10px 20px;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        /* Main content adjustments */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Notification badge */
        .badge {
            font-size: 0.8rem;
            padding: 5px 8px;
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand fw-bold" href="#">CARENA</a>

            <!-- Search Bar -->
            <form class="d-flex ms-auto me-4">
                <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Rechercher</button>
            </form>

            <!-- Navbar Items -->
            <ul class="navbar-nav align-items-center">
                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell fs-4"></i>
                        <span class="badge bg-danger rounded-pill position-absolute" style="top: 8px; right: 8px;">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
                        <li><a class="dropdown-item" href="#">Notification 1</a></li>
                        <li><a class="dropdown-item" href="#">Notification 2</a></li>
                        <li><a class="dropdown-item text-center fw-bold" href="#">Voir tout</a></li>
                    </ul>
                </li>

                <!-- Profile -->
                <li class="nav-item dropdown ms-3">
                    <a class="nav-link d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://via.placeholder.com/40" alt="Profil" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                        <span>Mon Profil</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#">Paramètres</a></li>
                        <li><a class="dropdown-item" href="#">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column p-3">
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="bi bi-grid me-2"></i> Tableau de bord</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="bi bi-box-seam me-2"></i> Actifs</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="bi bi-people me-2"></i> Utilisateurs</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="bi bi-truck me-2"></i> Fournisseurs</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="bi bi-card-checklist me-2"></i> Attributions</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="bi bi-clock-history me-2"></i> Historique</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
