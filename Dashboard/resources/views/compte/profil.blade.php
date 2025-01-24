<!-- resources/views/compte/profil.blade.php -->
@extends('layouts.app')

@section('title', 'Mon Profil')

@section('custom-css-add')
<style>
    /* Style pour le message de succès */
    .alert-success {
        position: absolute; /* Position absolue par rapport au parent */
        top: 50%; /* Centrer verticalement */
        left: 50%; /* Centrer horizontalement */
        transform: translate(-50%, -50%); /* Décaler de 50% pour un centrage parfait */
        padding: 15px 30px;
        background-color: #4CAF50; /* Couleur de fond verte */
        color: white; /* Texte blanc */
        border-radius: 5px;
        z-index: 1000; /* S'assurer qu'il est au-dessus des autres éléments */
        animation: fadeOut 2s forwards; /* Animation de disparition */
    }

    /* Animation pour faire disparaître le message */
    @keyframes fadeOut {
        0% { opacity: 1; }
        90% { opacity: 1; }
        100% { opacity: 0; display: none; }
    }
</style>
@endsection
@section('main-content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Mon Profil</h1>
    <div class="bg-white shadow-lg rounded-lg p-6 relative"> <!-- Ajout de relative pour positionner le message -->
        @if($user)
            <!-- Afficher la photo de profil -->
            <div class="mb-6 text-center">
                @if($user->profile_photo_path)
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Photo de profil"
                         class="w-32 h-32 rounded-full mx-auto object-cover object-center-top shadow-md"
                         style="object-position: center top;">
                @else
                    <div class="w-32 h-32 bg-gray-200 rounded-full mx-auto flex items-center justify-center shadow-md">
                        <span class="text-gray-500 text-lg">Aucune photo</span>
                    </div>
                @endif
            </div>

            <!-- Formulaire de mise à jour du profil -->
            <form action="{{ route('compte.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Conteneur de grille pour les champs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nom complet -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    </div>

                    <!-- Photo de profil -->
                    <div class="col-span-2">
                        <label for="profile_photo_path" class="block text-sm font-medium text-gray-700 mb-2">Photo de profil</label>
                        <input type="file" name="profile_photo_path" id="profile_photo_path"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                        <input type="password" name="password" id="password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-8">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                        Mettre à jour
                    </button>
                </div>
            </form>
        @else
            <p class="text-red-500 text-center">Aucun utilisateur connecté.</p>
        @endif

        <!-- Afficher le message de succès -->
        @if (session('success'))
            <div id="success-message" class="alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

<!-- Script pour gérer la disparition du message -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.remove();
            }, 2000);
        }
    });
</script>
@endsection
