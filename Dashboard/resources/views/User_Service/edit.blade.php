@extends('layouts.app')

@section('title', 'Modifier un service')

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
            <h2 class="text-xl font-bold">Modifier un utilisateur-Service</h2>
            <a href="{{ route('User_Service.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                Retour à la liste des services
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full">
            <form action="{{ route('User_Service.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Champ 1 : Code -->
                    <div class="mb-4">
                        <label for="CodeUser" class="block text-sm font-medium text-gray-700">Code</label>
                        <input type="text" id="CodeUser" name="CodeUser" value="{{ $service->utilisateur->CodeUser }}" required readonly
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-100">
                    </div>

                    <!-- Champ 2 : Nom du service -->
                    <div class="mb-4">
                        <label for="NomCompUser" class="block text-sm font-medium text-gray-700">Nom du service</label>
                        <input type="text" id="NomCompUser" name="NomCompUser" value="{{ $service->utilisateur->NomCompUser }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 3 : Description -->
                    <div class="mb-4">
                        <label for="DesServ" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" id="DesServ" name="DesServ" value="{{ $service->DesServ }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 4 : Responsable -->
                    <div class="mb-4">
                        <label for="NpnomRespServ" class="block text-sm font-medium text-gray-700">Responsable</label>
                        <input type="text" id="NpnomRespServ" name="NpnomRespServ" value="{{ $service->NpnomRespServ }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 5 : Contact -->
                    <div class="mb-4">
                        <label for="ContactUser" class="block text-sm font-medium text-gray-700">Contact</label>
                        <input type="tel" id="ContactUser" name="ContactUser" value="{{ $service->utilisateur->ContactUser }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 6 : Email -->
                    <div class="mb-4">
                        <label for="EmailUser" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="EmailUser" name="EmailUser" value="{{ $service->utilisateur->EmailUser }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
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
