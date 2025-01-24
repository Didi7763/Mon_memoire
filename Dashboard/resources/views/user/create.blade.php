<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('title', 'Créer un compte')

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

    /* Style pour le message de succès */
    .alert-success {
        position: absolute; /* Position absolue par rapport au conteneur parent */
        top: 50%; /* Centrer verticalement */
        left: 50%; /* Centrer horizontalement */
        transform: translate(-50%, -50%); /* Décaler de 50% pour un centrage parfait */
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        z-index: 1000;
        animation: fadeOut 2s forwards;
    }

    @keyframes fadeOut {
        0% { opacity: 1; }
        90% { opacity: 1; }
        100% { opacity: 0; display: none; }
    }
</style>
@endsection

@section('main-content')
<div class="p-2 overflow-y-auto" style="max-height: calc(100vh - 64px);">
    <!-- Chargeur centré par rapport à #main-content et décalé de 50px vers la droite -->
    <div id="loader" class="flex justify-center items-center h-full w-full" style="position: absolute; top: 50%; left: 57%; transform: translate(calc(50px - 50%), -50%); z-index: 1000;">
        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500"></div>
    </div>

    <!-- Contenu principal (caché initialement) -->
    <div id="main-content" class="relative" style="min-height: 75vh; display: none; opacity: 0;">
        <div class="flex justify-between items-center mb-8 p-4 bg-white rounded-lg shadow-sm min-h-[6rem]">
            <h2 class="text-xl font-bold">Création de compte</h2>
        </div>

        <!-- Afficher le message de succès -->
        @if (session('success'))
            <div id="success-message" class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire d'inscription -->
        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full max-h-[70vh] overflow-auto">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Conteneur de grille pour les champs du formulaire -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Champ 1 : Nom complet -->
                    <div class="">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input type="text" id="name" name="name" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 2 : Nom de compte utilisateur -->
                    <div class="">
                        <label for="NomCompUser" class="block text-sm font-medium text-gray-700">Nom de compte utilisateur</label>
                        <input type="text" id="NomCompUser" name="NomCompUser" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 3 : Email -->
                    <div class="">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 4 : Mot de passe -->
                    <div class="">
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" id="password" name="password" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 5 : Confirmation du mot de passe -->
                    <div class="">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 6 : Statut de l'administrateur -->
                    <div class="">
                        <label for="StatAdmin" class="block text-sm font-medium text-gray-700">Statut de l'administrateur</label>
                        <select id="StatAdmin" name="StatAdmin" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                        </select>
                    </div>

                    <!-- Champ 7 : Liste d'accès (cases à cocher cochées par défaut) -->
                    <div class="">
                        <label class="block text-sm font-medium text-gray-700">Liste d'accès</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="données" class="form-checkbox" checked>
                                <span class="ml-2">données</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="logiciels" class="form-checkbox" checked>
                                <span class="ml-2">logiciels</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="matériels" class="form-checkbox" checked>
                                <span class="ml-2">matériels</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="catégories" class="form-checkbox" checked>
                                <span class="ml-2">Catégories</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="employes" class="form-checkbox" checked>
                                <span class="ml-2">Employes</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="services" class="form-checkbox" checked>
                                <span class="ml-2">Services</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="fournisseurs" class="form-checkbox" checked>
                                <span class="ml-2">Fournisseurs</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="attribution" class="form-checkbox" checked>
                                <span class="ml-2">Attribution</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="maintenances" class="form-checkbox" checked>
                                <span class="ml-2">Maintenances</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="historiques" class="form-checkbox" checked>
                                <span class="ml-2">Historiques</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="nouveau compte" class="form-checkbox" checked>
                                <span class="ml-2">Nouveau Compte</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListAccApp[]" value="tous comptes" class="form-checkbox" checked>
                                <span class="ml-2">Les comptes</span>
                            </label>
                        </div>
                    </div>

                    <!-- Champ 8 : Liste des permissions (cases à cocher cochées par défaut) -->
                    <div class="">
                        <label class="block text-sm font-medium text-gray-700">Liste des permissions</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListPermApp[]" value="create" class="form-checkbox" checked>
                                <span class="ml-2">Créer</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListPermApp[]" value="edit" class="form-checkbox" checked>
                                <span class="ml-2">Modifier</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="ListPermApp[]" value="delete" class="form-checkbox" checked>
                                <span class="ml-2">Supprimer</span>
                            </label>
                        </div>
                    </div>

                    <!-- Champ 9 : Téléchargement de la photo de profil -->
                    <div class="">
                        <label for="profile_photo_path" class="block text-sm font-medium text-gray-700">Photo de profil</label>
                        <input type="file" id="profile_photo_path" name="profile_photo_path" accept="image/*"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        S'inscrire
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
