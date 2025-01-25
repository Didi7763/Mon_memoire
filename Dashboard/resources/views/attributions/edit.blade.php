@extends('layouts.app')

@section('title', 'Modifier une attribution')

@section('custom-css-add')
<style>
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 3vh;
        margin-bottom: 5vh;
        padding: 2vh;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        padding: 0.5vh 1vw;
        display: flex;
        align-items: center;
        gap: 0.5vw;
    }

    .form-container {
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    input[readonly],select[readonly] {
        cursor: not-allowed;
        background-color: #f0f0f0; /* Optionnel : Changer l'apparence pour montrer que c'est non modifiable */
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
            <h2 class="text-xl font-bold">Modifier une attribution</h2>
            <a href="{{ route('attributions.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                Retour à la liste des attributions
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full">
            <form action="{{ route('attributions.update', $attributions->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Champ 1 : Actif -->
                <div class="mb-4">
                    <label for="IdAct" class="block text-sm font-medium text-gray-700">Actif</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" name="IdAct" id="IdAct" required>
                        <option value="" disabled {{ old('IdAct', $attributions->IdAct) == null ? 'selected' : '' }}>Choisir un Actif</option>
                        @foreach($actifs as $actif)
                            <option value="{{ $actif->IdAct }}" {{ old('IdAct', $attributions->IdAct) == $actif->IdAct ? 'selected' : '' }}>
                                {{ $actif->NomAct }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Champ 2 : Utilisateur -->
                <div class="mb-4">
                    <label for="CodeUser" class="block text-sm font-medium text-gray-700">Utilisateur</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" name="CodeUser" id="CodeUser" required>
                        <option value="" disabled {{ old('CodeUser', $attributions->CodeUser) == null ? 'selected' : '' }}>Choisir un Utilisateur</option>
                        @foreach($utilisateurs as $utilisateur)
                            <option value="{{ $utilisateur->CodeUser }}" {{ old('CodeUser', $attributions->CodeUser) == $utilisateur->CodeUser ? 'selected' : '' }}>
                                {{ $utilisateur->NomCompUser }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Champ 3 : Admin -->
                <div class="mb-4">
                    <label for="NumAdmin" class="block text-sm font-medium text-gray-700">Admin</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" name="NumAdmin" id="NumAdmin" required readonly>
                        <option value="" disabled {{ old('NumAdmin', $attributions->NumAdmin) == null ? 'selected' : '' }}>Choisir un Admin</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('NumAdmin', $attributions->NumAdmin) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Champ 4 : Date d'attribution -->
                <div class="mb-4">
                    <label for="DatAttAct" class="block text-sm font-medium text-gray-700">Date d'attribution</label>
                    <input type="date" id="DatAttAct" name="DatAttAct" value="{{ old('DatAttAct', $attributions->DatAttAct) }}" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        Enregistrer
                    </button>
                </div>
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
