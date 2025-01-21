@extends('layouts.app')

@section('title', 'Ajouter un Actif de Données')

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

    /* Personnalisation CSS pour le formulaire */
    .form-container {
        background: #fff;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        max-height: 70dvh;
        overflow: auto;
    }
    .btn-primary{
        margin: 1vh 0;
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
            <h2 class="text-xl font-bold">Formulaire d'actif de données</h2>
            <a href="{{ route('donnees.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                Retour à la liste des données
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full max-h-[70vh] overflow-auto">
            <form action="{{ route('donnees.store') }}" method="POST">
                @csrf
                <!-- Conteneur de grille pour les champs du formulaire -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Champ 1 -->
                    <div class="mb-4">
                        <label for="IdAct" class="block text-sm font-medium text-gray-700">ID Actif</label>
                        <input type="text" id="IdAct" name="IdAct" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 2 -->
                    <div class="mb-4">
                        <label for="NomAct" class="block text-sm font-medium text-gray-700">Nom de l'actif</label>
                        <input type="text" id="NomAct" name="NomAct" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 3 -->
                    <div class="mb-4">
                        <label for="FormatData" class="block text-sm font-medium text-gray-700">Format de la donnée</label>
                        <input type="text" id="FormatData" name="FormatData" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 4 -->
                    <div class="mb-4">
                        <label for="SourceData" class="block text-sm font-medium text-gray-700">Source de la donnée</label>
                        <input type="text" id="SourceData" name="SourceData" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 5 -->
                    <div class="mb-4">
                        <label for="ResponsabeData" class="block text-sm font-medium text-gray-700">Responsable</label>
                        <input type="text" id="ResponsabeData" name="ResponsabeData" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 6 -->
                    <div class="mb-4">
                        <label for="NivSensData" class="block text-sm font-medium text-gray-700">Niveaux de sensibilité</label>
                        <select id="NivSensData" name="NivSensData" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option selected>Choix du niveaux</option>
                            <option value="Public">Donnée publique</option>
                            <option value="Interne">Donnée Interne</option>
                            <option value="Confidentiel">Donnée confidentielle</option>
                            <option value="Discrets">Donnée discrète</option>
                        </select>
                    </div>

                    <!-- Champ 7 -->
                    <div class="mb-4">
                        <label for="StatData" class="block text-sm font-medium text-gray-700">Statut</label>
                        <select id="StatData" name="StatData" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option selected>Selectionne le statut</option>
                            <option value="en création">Donnée en création</option>
                            <option value="active">Donnée active</option>
                            <option value="stockée">Donnée stockée</option>
                            <option value="obsolète">Donnée obsolète</option>
                            <option value="supprimée">Donnée supprimée</option>
                        </select>
                    </div>

                    <!-- Champ 8 : Commentaire (sur une seule ligne) -->
                    <div class="mb-4">
                        <label for="ComtAct" class="block text-sm font-medium text-gray-700">Commentaire</label>
                        <input type="text" id="ComtAct" name="ComtAct"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        Ajouter
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
</script>
@endsection
