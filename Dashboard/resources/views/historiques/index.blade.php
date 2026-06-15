@extends('layouts.app')

@section('title', 'Liste des Historiques')

@section('custom-css-add')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('main-content')

<div class="p-8 overflow-y-auto" style="max-height: calc(100vh - 64px);">
    <!-- Chargeur centré par rapport à #main-content et décalé de 50px vers la droite -->
    <div id="loader" class="flex justify-center items-center h-full w-full" style="position: absolute; top: 50%; left: 57%; transform: translate(calc(50px - 50%), -50%); z-index: 1000;">
        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500"></div>
    </div>

    <!-- Contenu principal (caché initialement) -->
    <div id="main-content" class="relative" style="min-height: 80vh; display: none; opacity: 0;">
        <div class="w-[80%] mx-auto p-4 bg-white rounded-lg mt-8 mb-8">
            <h1 class="text-2xl font-bold mb-6">Historique des actifs</h1>

            <!-- Accordéon avec Tailwind et Alpine.js -->
            <div class="space-y-4">
                @forelse($historiques as $index => $historique)
                    <div x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }" class="border rounded-lg bg-white shadow-md">
                        <button @click="open = !open" class="w-full p-4 text-left font-semibold bg-gray-100 hover:bg-gray-200 rounded-t-lg flex justify-between items-center">
                            <span>
                                <i class="bi bi-clock-history mr-2 text-blue-500"></i>
                                Action sur : {{ $historique->actif->NomAct ?? 'Actif inconnu' }}
                            </span>
                            <span class="transform transition-transform" :class="{ 'rotate-180': open }">▼</span>
                        </button>
                        <div x-show="open" x-collapse class="p-4 border-t text-gray-700">
                            <p class="mb-2"><strong>Description :</strong> {{ $historique->DesAction }}</p>
                            <p class="text-sm text-gray-500">
                                <i class="bi bi-calendar-event mr-1"></i> Date : {{ \Carbon\Carbon::parse($historique->DatAction)->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500 italic">
                        Aucun historique disponible pour le moment.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $historiques->links() }}
            </div>
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
