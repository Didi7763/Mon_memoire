<!-- resources/views/materiels/create.blade.php -->
@extends('layouts.app')

@section('title', 'Ajouter un actif logiciel')

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
            <h2 class="text-xl font-bold">Formulaire d'actif logiciel</h2>
            <a href="{{ route('logiciel.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                Retour à la liste des logiciels
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full max-h-[70vh] overflow-auto">
            <form action="{{ route('logiciel.store') }}" method="POST">
                @csrf
                <!-- Conteneur de grille pour les champs du formulaire -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Champ 1 : ID Actif -->
                    <div class="mb-4">
                        <label for="IdAct" class="block text-sm font-medium text-gray-700">ID Actif</label>
                        <input type="text" id="IdAct" name="IdAct" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 2 : Nom du logiciel -->
                    <div class="mb-4">
                        <label for="NomAct" class="block text-sm font-medium text-gray-700">Nom du logiciel</label>
                        <input type="text" id="NomAct" name="NomAct" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 3 : Version du logiciel -->
                    <div class="mb-4">
                        <label for="VersionLog" class="block text-sm font-medium text-gray-700">Version du logiciel</label>
                        <input type="text" id="VersionLog" name="VersionLog" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 4 : Type de licence -->
                    <div class="mb-4">
                        <label for="TypLicLog" class="block text-sm font-medium text-gray-700">Type de licence</label>
                        <select id="TypLicLog" name="TypLicLog" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="Libre">Logiciel Libre (Open Source)</option>
                            <option value="Propriétaire">Logiciel Propriétaire</option>
                            <option value="Gratuiciel">Logiciel Gratuiciel</option>
                            <option value="SaaS">Licence Saas</option>
                            <option value="Réseau">Licence Réseau</option>
                        </select>
                    </div>

                    <!-- Champ 5 : Nombre de licence -->
                    <div class="mb-4">
                        <label for="NbrLicLog" class="block text-sm font-medium text-gray-700">Nombre de licence</label>
                        <input type="number" id="NbrLicLog" name="NbrLicLog" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 6 : Nombre minimal de licence -->
                    <div class="mb-4">
                        <label for="NbrMinLicLog" class="block text-sm font-medium text-gray-700">Nombre minimal de licence</label>
                        <input type="number" id="NbrMinLicLog" name="NbrMinLicLog" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 7 : Clé de licence -->
                    <div class="mb-4">
                        <label for="CleLicLog" class="block text-sm font-medium text-gray-700">Clé de licence</label>
                        <input type="text" id="CleLicLog" name="CleLicLog" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 8 : Date d'installation -->
                    <div class="mb-4">
                        <label for="DatAchLog" class="block text-sm font-medium text-gray-700">Date d'installation</label>
                        <input type="date" id="DatAchLog" name="DatAchLog" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 9 : Date d'expiration de Licence -->
                    <div class="mb-4">
                        <label for="DatExpLog" class="block text-sm font-medium text-gray-700">Date d'expiration de Licence</label>
                        <input type="date" id="DatExpLog" name="DatExpLog" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 10 : Fournisseur -->
                    <div class="mb-4">
                        <label for="IdFour" class="block text-sm font-medium text-gray-700">Fournisseur</label>
                        <select id="IdFour" name="IdFour" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>-- Sélectionnez le fournisseur --</option>
                            @foreach ($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->IdFour }}">{{ $fournisseur->NomFour }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Champ 11 : Commentaire -->
                    <div class="mb-4">
                        <label for="ComtAct" class="block text-sm font-medium text-gray-700">Commentaire</label>
                        <input type="text" id="ComtAct" name="ComtAct"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
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
