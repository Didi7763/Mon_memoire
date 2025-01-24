@extends('layouts.app')

@section('title')
Liste des comptes utilisateurs
@endsection

@section('custom-css-add')
<style>
    .right-panel{
        overflow: hidden;
        overflow-y: none;
    }
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
        width:78vw;
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
        width:78vw;
    }

    .status-badge {
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        margin: 0;
    }


    .status-actif { background: #e8f5e9; color: #2e7d32; }
    .status-inactif { background: #fce4ec; color: #c2185b; }


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

    .status-dot {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 12px;
    height: 12px;
    background-color: green;
    border: 2px solid white;
    border-radius: 50%;
}
</style>
@endsection

@section('sidebar')
<ul>
    <li> <a href="#tableau de bord" ><i class="bi bi-speedometer2"></i>Tableau de bord</a></li>
    <li class="has-submenu"><a href="#actifs" class="active"><i class="bi bi-display"></i>Actifs</a>
        <ul class="submenu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-database"></i>Actifs de données</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-terminal"></i>Actif logiciel</a></li>
            <li><a class="dropdown-item active" href="#"><i class="bi bi-cpu"></i>Actif matériel</a></li>
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
        <div class="flex justify-between items-center mb-8 p-4 bg-white rounded-lg shadow-sm min-h-[6rem] w-[78vw]">
            <h2 class="text-xl font-bold">Liste des comptes utilisateurs</h2>
            <a href="{{ route('user.create') }}" class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                <i class="bi bi-plus-circle"></i>
                Créer un compte
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-[78vw]">
            <table class="w-full text-xs">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-3">Nom utilisateur</th>
                        <th class="text-left p-3">Email</th>
                        <th class="text-left p-3">photo</th>
                        <th class="text-left p-3">Statut</th>
                        <th class="text-left p-3">Date d'ouverture de compte</th>
                        <th class="text-left p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">
                            <div class="relative inline-block w-fit h-fit">
                                <!-- Image de profil -->
                                <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://www.w3schools.com/w3images/avatar2.png' }}"
                                     alt="Photo de profil"
                                     class="w-5 h-5 rounded-full object-cover
                                           sm:w-6 sm:h-6
                                           md:w-7 md:h-7
                                           lg:w-8 lg:h-8
                                           xl:w-10 xl:h-10">

                                <!-- Point vert (statut en ligne) -->
                                @if($user->is_online)
                                    <span class="absolute top-0 right-0 w-2 h-2 bg-green-500 border-2 border-white rounded-full
                                                sm:w-1.5 sm:h-1.5
                                                md:w-2 md:h-2
                                                lg:w-2.5 lg:h-2.5
                                                xl:w-3 xl:h-3
                                                2xl:w-3.5 2xl:h-3.5">
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @switch($user->StatAdmin)
                                    @case('actif') bg-green-100 text-green-800 @break
                                    @case('inactif') bg-pink-100 text-pink-800 @break
                                @endswitch">
                                {{ $user->StatAdmin }}
                            </span>
                        </td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <!-- Bouton "Modifier" plus petit -->
                                <a href="{{ route('user.edit', $user->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded-lg text-xs hover:bg-yellow-600 transition-colors">Modifier</a>
                                <!-- Bouton "Supprimer" plus petit -->
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded-lg text-xs hover:bg-red-600 transition-colors">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="p-3 text-center">Aucun actif matériel trouvé</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($users->hasPages())
            <div class="flex justify-center mt-4">
                {{ $users->links() }}
            </div>
            @endif
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
