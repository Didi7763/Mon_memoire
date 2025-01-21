@extends('layouts.app')

@section('title', 'Modifier une maintenance')

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
        padding: 0.5dvh 1dvw;
        display: flex;
        align-items: center;
        gap: 0.5dvw;
    }

    .form-container {
        background: #fff;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        max-height: 70dvh;
        overflow: auto;
    }

    .btn-primary {
        margin: 1vh 0;
    }

    input[readonly] {
        cursor: not-allowed;
        background-color: #f0f0f0;
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
            <h2 class="text-xl font-bold">Modifier une maintenance</h2>
            <a href="{{ route('maintenance.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                Retour à la liste des maintenances
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full">
            <form action="{{ route('maintenance.update', $maintenance->NumMaint ?? '') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Champ 1 : Numéro -->
                    <div class="mb-4">
                        <label for="NumMaint" class="block text-sm font-medium text-gray-700">Numéro</label>
                        <input type="text" id="NumMaint" name="NumMaint" value="{{ $maintenance->NumMaint }}" required readonly
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-100">
                    </div>

                    <!-- Champ 2 : Description -->
                    <div class="mb-4">
                        <label for="DesMaint" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" id="DesMaint" name="DesMaint" value="{{ $maintenance->DesMaint }}" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 3 : Type de maintenance -->
                    <div class="mb-4">
                        <label for="TypMaint" class="block text-sm font-medium text-gray-700">Type de maintenance</label>
                        <select id="TypMaint" name="TypMaint" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled {{ empty($maintenance->TypMaint) ? 'selected' : '' }}>Type de maintenance</option>
                            <option value="corrective" {{ $maintenance->TypMaint === 'corrective' ? 'selected' : '' }}>Maintenance corrective</option>
                            <option value="préventive" {{ $maintenance->TypMaint === 'préventive' ? 'selected' : '' }}>Maintenance préventive</option>
                            <option value="prédictive" {{ $maintenance->TypMaint === 'prédictive' ? 'selected' : '' }}>Maintenance prédictive</option>
                            <option value="curative" {{ $maintenance->TypMaint === 'curative' ? 'selected' : '' }}>Maintenance curative</option>
                            <option value="évolutif" {{ $maintenance->TypMaint === 'évolutif' ? 'selected' : '' }}>Maintenance évolutive</option>
                        </select>
                    </div>

                    <!-- Champ 4 : Date de maintenance -->
                    <div class="mb-4">
                        <label for="DatMaint" class="block text-sm font-medium text-gray-700">Date de maintenance</label>
                        <input type="date" id="DatMaint" name="DatMaint" value="{{ $maintenance->DatMaint }}" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 5 : Nom du technicien -->
                    <div class="mb-4">
                        <label for="NomTechMaint" class="block text-sm font-medium text-gray-700">Nom du technicien</label>
                        <input type="text" id="NomTechMaint" name="NomTechMaint" value="{{ $maintenance->NomTechMaint }}" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 6 : Coût -->
                    <div class="mb-4">
                        <label for="CoutMaint" class="block text-sm font-medium text-gray-700">Coût</label>
                        <input type="number" id="CoutMaint" name="CoutMaint" value="{{ $maintenance->CoutMaint }}" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 7 : Date de prochaine maintenance -->
                    <div class="mb-4">
                        <label for="DatProchMaint" class="block text-sm font-medium text-gray-700">Date de prochaine maintenance</label>
                        <input type="date" id="DatProchMaint" name="DatProchMaint" value="{{ $maintenance->DatProchMaint }}"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 8 : Actif -->
                    <div class="mb-4">
                        <label for="IdAct" class="block text-sm font-medium text-gray-700">Actif</label>
                        <select id="IdAct" name="IdAct" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled>-- Sélectionnez un actif --</option>
                            @foreach ($actifs as $actif)
                                <option value="{{ $actif->IdAct }}" {{ $maintenance->IdAct == $actif->IdAct ? 'selected' : '' }}>
                                    {{ $actif->NomAct }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Champ 9 : Commentaire -->
                    <div class="mb-4">
                        <label for="ComtMaint" class="block text-sm font-medium text-gray-700">Commentaire</label>
                        <textarea id="ComtMaint" name="ComtMaint" rows="1"
                                  class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ $maintenance->ComtMaint ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        Enregistrer
                    </button>
                </div>

                <!-- Gestion des erreurs -->
                @if ($errors->any())
                    <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
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
