<!-- resources/views/compte/profil.blade.php -->
@extends('layouts.app')

@section('title', 'Mon Profil')

@section('main-content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Mon Profil</h1>
    <div class="bg-white shadow-lg rounded-lg p-6">
        @if($user)
            <!-- Afficher la photo de profil -->
            <div class="mb-6 text-center">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Photo de profil" class="w-32 h-32 rounded-full mx-auto object-cover shadow-md">
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

                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
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
                <div>
                    <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-2">Photo de profil</label>
                    <input type="file" name="profile_photo" id="profile_photo"
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
    </div>
</div>
@endsection