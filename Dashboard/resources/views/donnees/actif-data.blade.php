@php
    // Récupérer les accès et permissions de l'utilisateur depuis la session
    $ListAccApp = session('ListAccApp', []);
    $ListPermApp = session('ListPermApp', []);
@endphp
@extends('layouts.app')

@section('title', 'Liste des Actifs de Données')

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

.status-interne {
    background: #e3f2fd;
    color: #1976d2;
}

.status-public {
    background: #e8f5e9;
    color: #2e7d32;
}

.status-discret {
    background: #fce4ec;
    color: #c2185b;
}

.status-confidentiel {
    background: #efebe9;
    color: #5d4037;
}

.status-default {
    background: #f5f5f5;
    color: #757575;
}
</style>
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
            <h2 class="text-xl font-bold">Liste des Actifs de Données</h2>
            <a href="{{ route('donnees.create') }}"
               class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
               onclick="return checkPermission('create')">
                <i class="bi bi-plus-circle"></i>
                Ajouter une donnée
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full">
            <table class="w-full text-xs">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-3">Identifiant</th>
                        <th class="text-left p-3">Nom</th>
                        <th class="text-left p-3">Format</th>
                        <th class="text-left p-3">Source</th>
                        <th class="text-left p-3">Responsable</th>
                        <th class="text-left p-3">Sensibilté</th>
                        <th class="text-left p-3">Date de réception</th>
                        <th class="text-left p-3">Dernière mise à jour</th>
                        <th class="text-left p-3">Commentaire</th>
                        <th class="text-left p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donnees as $donnee)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $donnee->actif->IdAct }}</td>
                        <td class="p-3">{{ $donnee->actif->NomAct }}</td>
                        <td class="p-3">{{ $donnee->FormatData }}</td>
                        <td class="p-3">{{ $donnee->SourceData }}</td>
                        <td class="p-3">{{ $donnee->ResponsabeData }}</td>
                        <td class="p-3">
                            <span class="status-badge
                                @switch($donnee->NivSensData)
                                    @case('Interne') status-interne @break
                                    @case('Discrets') status-discret @break
                                    @case('Public') status-public @break
                                    @case('Confidentiel') status-confidentiel @break
                                    @default status-default
                                @endswitch">
                                {{ $donnee->NivSensData }}
                            </span>
                        </td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($donnee->DatRecpData)->format('d/m/Y') }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($donnee->DatMajData)->format('d/m/Y') }}</td>
                        <td class="p-3">{{ $donnee->actif->ComtAct }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <a href="{{ route('donnees.edit', $donnee->id) }}"
                                   class="px-2 py-1 bg-yellow-500 text-white rounded-lg text-xs hover:bg-yellow-600 transition-colors"
                                   onclick="return checkPermission('edit')">
                                    Modifier
                                </a>

                                <form action="{{ route('donnees.destroy', $donnee->id) }}" method="POST" onsubmit="return checkPermission('delete') && confirm('Confirmer la suppression ?')">
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
                        <td colspan="10" class="p-3 text-center">Aucune donnée trouvée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($donnees->hasPages())
            <div class="flex justify-center mt-4">
                {{ $donnees->links() }}
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
