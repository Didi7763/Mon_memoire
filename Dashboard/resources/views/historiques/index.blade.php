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
                <!-- Élément 1 -->
                <div x-data="{ open: true }" class="border rounded-lg bg-white shadow-md">
                    <button @click="open = !open" class="w-full p-4 text-left font-semibold bg-gray-100 hover:bg-gray-200 rounded-t-lg flex justify-between items-center">
                        Un ordinateur a été ajouté
                        <span class="transform transition-transform" :class="{ 'rotate-180': open }">▼</span>
                    </button>
                    <div x-show="open" x-collapse class="p-4 border-t">
                        L'ordinateur de [Nom de l'utilisateur] a été ajouté le [Date].
                    </div>
                </div>

                <!-- Élément 2 -->
                <div x-data="{ open: false }" class="border rounded-lg bg-white shadow-md">
                    <button @click="open = !open" class="w-full p-4 text-left font-semibold bg-gray-100 hover:bg-gray-200 rounded-t-lg flex justify-between items-center">
                        Titre 2
                        <span class="transform transition-transform" :class="{ 'rotate-180': open }">▼</span>
                    </button>
                    <div x-show="open" x-collapse class="p-4 border-t">
                        Contenu du dépliant 2. Tu peux mettre ici des détails sur l'historique.
                    </div>
                </div>

                <!-- Élément 3 -->
                <div x-data="{ open: false }" class="border rounded-lg bg-white shadow-md">
                    <button @click="open = !open" class="w-full p-4 text-left font-semibold bg-gray-100 hover:bg-gray-200 rounded-t-lg flex justify-between items-center">
                        Titre 3
                        <span class="transform transition-transform" :class="{ 'rotate-180': open }">▼</span>
                    </button>
                    <div x-show="open" x-collapse class="p-4 border-t">
                        Contenu du dépliant 3. Tu peux mettre ici des détails sur l'historique.
                    </div>
                </div>
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
