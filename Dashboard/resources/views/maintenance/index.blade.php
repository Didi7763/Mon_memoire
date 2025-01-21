@extends('layouts.app')

@section('title')
Liste des Maintenances effectuées
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
            <h2 class="text-xl font-bold">Liste des maintenances effectuées</h2>
            <a href="{{ route('maintenance.create') }}" class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                <i class="bi bi-plus-circle"></i>
                Ajouter une nouvelle maintenance
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full">
            <table class="w-full text-xs">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-3">Numéro</th>
                        <th class="text-left p-3">Actifs</th>
                        <th class="text-left p-3">Description</th>
                        <th class="text-left p-3">Type</th>
                        <th class="text-left p-3">Date</th>
                        <th class="text-left p-3">Nom technicien</th>
                        <th class="text-left p-3">Coût</th>
                        <th class="text-left p-3">Prochaine maintenance</th>
                        <th class="text-left p-3">Commentaires</th>
                        <th class="text-left p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($maintenances as $maintenance)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $maintenance->NumMaint }}</td>
                        <td class="p-3">{{ $maintenance->actif->NomAct }}</td>
                        <td class="p-3">{{ $maintenance->DesMaint }}</td>
                        <td class="p-3">{{ $maintenance->TypMaint }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($maintenance->DatMaint)->format('d/m/Y') }}</td>
                        <td class="p-3">{{ $maintenance->NomTechMaint }}</td>
                        <td class="p-3">{{ number_format($maintenance->CoutMaint, 0, '.', ' ') }} FCFA</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($maintenance->DatProchMaint)->format('d/m/Y') }}</td>
                        <td class="p-3">{{ $maintenance->ComtMaint }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <!-- Bouton "Modifier" plus petit -->
                                <a href="{{ route('maintenance.edit', $maintenance->NumMaint) }}" class="px-2 py-1 bg-yellow-500 text-white rounded-lg text-xs hover:bg-yellow-600 transition-colors">Modifier</a>
                                <!-- Bouton "Supprimer" plus petit -->
                                <form action="{{ route('maintenance.destroy', $maintenance->NumMaint) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded-lg text-xs hover:bg-red-600 transition-colors">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="p-3 text-center">Aucune maintenance trouvée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($maintenances->hasPages())
            <div class="flex justify-center mt-4">
                {{ $maintenances->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Script pour gérer le chargeur -->
<script>
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
</script>

@endsection
