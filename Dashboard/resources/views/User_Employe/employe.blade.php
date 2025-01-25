@php
    // Récupérer les accès et permissions de l'utilisateur depuis la session
    $ListAccApp = session('ListAccApp', []);
    $ListPermApp = session('ListPermApp', []);
@endphp
@extends('layouts.app')

@section('title')
Liste des employés
@endsection

@section('custom-css-add')
<style>
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 3dvh;
        margin-bottom: 5dvh;
        padding: 2dvh;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-add {
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-container {
        background: #fff;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .action-btn {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .status-badge {
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        margin: 0;
    }

    .status-activite { background: #e3f2fd; color: #1976d2; }
    .status-retraite { background: #e8f5e9; color: #2e7d32; }
    .status-contrat {background: #fbffde; color: #c0c524;}
    .status-suspendu { background: #fce4ec; color: #c2185b; }
    .status-conge { background: #fff3e0; color: #f57c00; }
    .status-formation { background: #efebe9; color: #5d4037; }
</style>
@endsection

@section('sidebar')
<ul>
    <li><a href="#tableau de bord"><i class="bi bi-speedometer2"></i>Tableau de bord</a></li>
    <li class="has-submenu"><a href="#actifs" class="active"><i class="bi bi-display"></i>Actifs</a>
        <ul class="submenu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-database"></i>Actifs de données</a></li>
            <li><a class="dropdown-item active" href="#"><i class="bi bi-terminal"></i>Actif logiciel</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-cpu"></i>Actif matériel</a></li>
        </ul>
    </li>
    <!-- Reste du sidebar identique à votre code -->
</ul>
@endsection

@section('main-content')
<div class="p-8 overflow-y-auto" style="max-height: calc(100vh - 64px);">
    <!-- Chargeur centré par rapport à #main-content et décalé de 50px vers la droite -->
    <div id="loader" class="flex justify-center items-center h-full w-full" style="position: absolute; top: 50%; left: 57%; transform: translate(calc(50px - 50%), -50%); z-index: 1000;">
        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500"></div>
    </div>

    <!-- Contenu principal (caché initialement) -->
    <div id="main-content" class="relative" style="min-height: 75vh; display: none; opacity: 0;">
        <div class="flex justify-between items-center mb-8 p-4 bg-white rounded-lg shadow-sm min-h-[6rem]">
            <h2 class="text-xl font-bold">Liste des utilisateurs (employés)</h2>
            <a href="{{ route('User_Employe.create') }}"
               class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
               onclick="return checkPermission('create')">
                <i class="bi bi-plus-circle"></i>
                Ajouter un nouveau utilisateur
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full">
            <table class="w-full text-xs">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-3">Code</th>
                        <th class="text-left p-3">Nom et Prénoms</th>
                        <th class="text-left p-3">Contact</th>
                        <th class="text-left p-3">Email</th>
                        <th class="text-left p-3">Fonction</th>
                        <th class="text-left p-3">Statut</th>
                        <th class="text-left p-3">Actifs obligatoire</th>
                        <th class="text-left p-3">Services</th>
                        <th class="text-left p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employes as $employe)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $employe->utilisateur->CodeUser }}</td>
                        <td class="p-3">{{ $employe->utilisateur->NomCompUser }}</td>
                        <td class="p-3">{{ $employe->utilisateur->ContactUser }}</td>
                        <td class="p-3">{{ $employe->utilisateur->EmailUser }}</td>
                        <td class="p-3">{{ $employe->FonctEmp }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @switch($employe->StatEmp)
                                    @case('En activité') bg-blue-100 text-blue-800 @break
                                    @case('En congé') bg-orange-100 text-orange-800 @break
                                    @case('Suspendu') bg-pink-100 text-pink-800 @break
                                    @case('En formation') bg-gray-100 text-gray-800 @break
                                    @case('Retraité') bg-green-100 text-green-800 @break
                                    @case('Fin contrat') bg-yellow-100 text-yellow-800 @break
                                @endswitch">
                                {{ $employe->StatEmp }}
                            </span>
                        </td>
                        <td class="p-3">{{ $employe->ListActif }}</td>
                        <td class="p-3">{{ $employe->service->utilisateur->NomCompUser }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <!-- Bouton "Modifier" plus petit -->
                                <a href="{{ route('User_Employe.edit', $employe->id) }}"
                                   class="px-2 py-1 bg-yellow-500 text-white rounded-lg text-xs hover:bg-yellow-600 transition-colors"
                                   onclick="return checkPermission('edit')">
                                    Modifier
                                </a>
                                <!-- Bouton "Supprimer" plus petit -->
                                <form action="{{ route('User_Employe.destroy', $employe->id) }}" method="POST" onsubmit="return checkPermission('delete') && confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-2 py-1 bg-red-500 text-white rounded-lg text-xs hover:bg-red-600 transition-colors">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="p-3 text-center">Aucun employé trouvé</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($employes->hasPages())
            <div class="flex justify-center mt-4">
                {{ $employes->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Script pour gérer le chargeur et les permissions -->
<script>
    // Gestion du chargeur
    setTimeout(() => {
        const loader = document.getElementById('loader');
        const mainContent = document.getElementById('main-content');

        // Faire disparaître le chargeur après 3 secondes
        setTimeout(() => {
            loader.style.opacity = '0';
            loader.style.transition = 'opacity 1s';

            // Attendre que le chargeur disparaisse complètement
            setTimeout(() => {
                // Supprimer le chargeur du DOM
                loader.remove();

                // Faire apparaître le contenu principal progressivement
                mainContent.style.display = 'block';
                setTimeout(() => {
                    mainContent.style.opacity = '1';
                    mainContent.style.transition = 'opacity 1s';
                }, 10); // Petit délai pour s'assurer que le display: block est appliqué
            }, 1000); // Attendre 1 seconde pour que le chargeur disparaisse
        }, 3000); // Délai initial avant de commencer la transition
    }, 0); // Démarrer immédiatement

    // Fonction pour vérifier les permissions
    function checkPermission(permission) {
        const permissions = @json($ListPermApp); // Convertir la liste des permissions en JSON
        if (!permissions.includes(permission)) {
            alert("Vous n'avez pas la permission sur cette action.");
            return false; // Bloquer l'action
        }
        return true; // Autoriser l'action
    }
</script>
@endsection
