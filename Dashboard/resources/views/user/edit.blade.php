@extends('layouts.app')

@section('title', 'Modifier le profil')

@section('main-content')
<div class="p-2 overflow-y-auto" style="max-height: calc(100vh - 64px);">
    <div id="main-content" class="relative" style="min-height: 75vh;">
        <div class="flex justify-between items-center mb-8 p-4 bg-white rounded-lg shadow-sm min-h-[6rem]">
            <h2 class="text-xl font-bold">Modifier le profil</h2>
            <a href="{{ route('user.index') }}" class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                <i class="bi bi-plus-circle"></i>
                La liste des comptes
            </a>
        </div>

        @if (session('success'))
            <div id="success-message" class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full max-h-[70vh] overflow-auto">
            <form action="{{ route('users.update2', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Champ 1 : Nom complet -->
                    <div class="">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 2 : Nom de compte utilisateur -->
                    <div class="">
                        <label for="NomCompUser" class="block text-sm font-medium text-gray-700">Nom de compte utilisateur</label>
                        <input type="text" id="NomCompUser" name="NomCompUser" value="{{ $user->NomCompUser }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 3 : Email -->
                    <div class="">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 4 : Mot de passe -->
                    <div class="">
                        <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 5 : Confirmation du mot de passe -->
                    <div class="">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 6 : Statut de l'administrateur -->
                    <div class="">
                        <label for="StatAdmin" class="block text-sm font-medium text-gray-700">Statut de l'administrateur</label>
                        <select id="StatAdmin" name="StatAdmin" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="actif" {{ $user->StatAdmin == 'actif' ? 'selected' : '' }}>Actif</option>
                            <option value="inactif" {{ $user->StatAdmin == 'inactif' ? 'selected' : '' }}>Inactif</option>
                        </select>
                    </div>

                    <!-- Champ 7 : Liste d'accès (toutes les cases sont présentes, mais seules celles de l'utilisateur sont cochées) -->
                    <div class="">
                        <label class="block text-sm font-medium text-gray-700">Liste d'accès</label>
                        <div class="mt-2 space-y-2">
                            @foreach ($allAccessList as $access)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="ListAccApp[]" value="{{ $access }}" class="form-checkbox"
                                           {{ in_array($access, $userAccessList) ? 'checked' : '' }}>
                                    <span class="ml-2">{{ $access }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Champ 8 : Liste des permissions (toutes les cases sont présentes, mais seules celles de l'utilisateur sont cochées) -->
                    <div class="">
                        <label class="block text-sm font-medium text-gray-700">Liste des permissions</label>
                        <div class="mt-2 space-y-2">
                            @foreach ($allPermissionList as $permission)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="ListPermApp[]" value="{{ $permission }}" class="form-checkbox"
                                           {{ in_array($permission, $userPermissionList) ? 'checked' : '' }}>
                                    <span class="ml-2">{{ $permission }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Champ 9 : Téléchargement de la photo de profil -->
                    <div class="">
                        <label for="photo" class="block text-sm font-medium text-gray-700">Photo de profil</label>
                        <input type="file" id="photo" name="photo" accept="image/*"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
