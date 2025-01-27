@extends('layouts.app')

@section('title', 'Mondash')

@section('main-content')
<div class="p-8 overflow-y-auto" style="max-height: calc(100vh - 64px);">
    <!-- Chargeur centré par rapport à #main-content et décalé de 50px vers la droite -->
    <div id="loader" class="flex justify-center items-center h-full w-full" style="position: absolute; top: 50%; left: 57%; transform: translate(calc(50px - 50%), -50%); z-index: 1000;">
        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500"></div>
    </div>

    <!-- Contenu principal (caché initialement) -->
    <div id="main-content" class="relative" style="min-height: 75vh; display: none; opacity: 0;">
        <div class="container mx-auto ">
            <h1 class="text-center text-2xl font-bold">Dashboard</h1>

            <!-- Section des indicateurs principaux -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
    <div class="bg-blue-500 text-white rounded-lg shadow p-4">
        <h5 class="text-lg font-semibold">Utilisateurs</h5>
        <p class="text-2xl">{{ $countUtilisateurs }}</p>
    </div>
    <div class="bg-green-500 text-white rounded-lg shadow p-4">
        <h5 class="text-lg font-semibold">Données</h5>
        <p class="text-2xl">{{ $countDonnees }}</p>
    </div>
    <div class="bg-yellow-500 text-white rounded-lg shadow p-4">
        <h5 class="text-lg font-semibold">Matériels</h5>
        <p class="text-2xl">{{ $countMateriels }}</p>
    </div>
    <div class="bg-red-500 text-white rounded-lg shadow p-4">
        <h5 class="text-lg font-semibold">Logiciels</h5>
        <p class="text-2xl">{{ $countLogiciels }}</p>
    </div>
    <div class="bg-purple-500 text-white rounded-lg shadow p-4">
        <h5 class="text-lg font-semibold">Employés</h5>
        <p class="text-2xl">{{ $countEmployes }}</p>
    </div>
    <div class="bg-pink-500 text-white rounded-lg shadow p-4">
        <h5 class="text-lg font-semibold">Fournisseurs</h5>
        <p class="text-2xl">{{ $countFournisseurs }}</p>
    </div>
</div>



            <!-- Section des graphiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
                <!-- Graphique linéaire -->
                <div class="flex flex-col justify-center items-center">
                    <h5 class="text-center text-lg font-semibold mb-2">Évolution des utilisateurs</h5>
                    <div class="w-full max-w-lg h-64">
                        <canvas id="userChart" class="w-full h-full"></canvas>
                    </div>
                </div>

                <!-- Graphique en camembert -->
                <div class="flex flex-col justify-center items-center">
                    <h5 class="text-center text-lg font-semibold mb-2">Répartition des ressources</h5>
                    <div class="w-full max-w-md h-64">
                        <canvas id="resourceChart" class="w-full h-full" style="display: none;"></canvas>
                    </div>
                </div>
            </div>



            <!-- Section des graphiques supplémentaires -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
    <!-- Section des actifs par type -->
    <div class="mt-5">
        <h5 class="text-lg font-semibold mb-2">Répartition des actifs par type</h5>
        <div class="w-full max-w-lg h-64">
            <canvas id="actifsChart" class="w-full h-full"></canvas>
        </div>
    </div>


    <!-- Graphique des logiciels par type de licence -->
    <div class="flex flex-col justify-center items-center">
        <h5 class="text-center text-lg font-semibold mb-2">Répartition des logiciels par type de licence</h5>
        <div class="w-full max-w-lg h-64">
            <canvas id="logicielsChart" class="w-full h-full"></canvas>
        </div>
    </div>
</div>


<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
    <!-- Graphique des données par niveau de sensibilité -->
    <div class="flex flex-col justify-center items-center">
        <h5 class="text-center text-lg font-semibold mb-2">Répartition des données par niveau de sensibilité</h5>
        <div class="w-full max-w-lg h-64">
            <canvas id="donneesChart" class="w-full h-full"></canvas>
        </div>
    </div>

<!-- Section des employés par statut -->
    <div class="mt-5">
        <h5 class="text-lg font-semibold mb-2">Répartition des employés par statut</h5>
        <div class="w-full max-w-lg h-64">
            <canvas id="employesChart" class="w-full h-full"></canvas>
        </div>
    </div>
</div>
<!-- Section des fournisseurs par type de produit -->
<div class="mt-5">
    <h5 class="text-lg font-semibold mb-2">Répartition des fournisseurs par type de produit</h5>
    <div class="w-full max-w-lg h-64">
        <canvas id="fournisseursChart" class="w-full h-full"></canvas>
    </div>
</div>



<!-- Section des indicateurs principaux -->

















 <!-- Section des tops -->
 <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-5">
    <div>
        <h5 class="text-lg font-semibold mb-2">Top 5 Matériels</h5>
        <ul class="bg-white rounded-lg shadow divide-y divide-gray-200">
            @forelse($topMateriels as $materiel)
                <li class="p-3">
                    {{ $materiel->MarqMat }} {{ $materiel->ModMarq }}
                    (Qté: {{ $materiel->QteMat }})
                </li>
            @empty
                <li class="p-3">Aucun matériel trouvé.</li>
            @endforelse
        </ul>
    </div>
    <div>
        <h5 class="text-lg font-semibold mb-2">Top 5 Données</h5>
        <ul class="bg-white rounded-lg shadow divide-y divide-gray-200">
            @forelse($topDonnees as $donnee)
                <li class="p-3">
                    {{ $donnee->SourceData }}
                    ({{ $donnee->DatRecpData }})
                </li>
            @empty
                <li class="p-3">Aucune donnée trouvée.</li>
            @endforelse
        </ul>
    </div>
    <div>
        <h5 class="text-lg font-semibold mb-2">Top 5 Logiciels</h5>
        <ul class="bg-white rounded-lg shadow divide-y divide-gray-200">
            @forelse($topLogiciels as $logiciel)
                <li class="p-3">
                    {{ $logiciel->VersionLog }}
                    (Licences: {{ $logiciel->NbrLicLog }})
                </li>
            @empty
                <li class="p-3">Aucun logiciel trouvé.</li>
            @endforelse
        </ul>
    </div>
</div>

<!-- Section des logiciels critiques -->
<div class="mt-5">
    <h5 class="text-lg font-semibold mb-2">Logiciels Critiques</h5>
    <ul class="bg-white rounded-lg shadow divide-y divide-gray-200">
        @forelse($logicielsCritiques as $logiciel)
            <li class="p-3">
                {{ $logiciel->VersionLog }}
                (Licences: {{ $logiciel->NbrLicLog }})
            </li>
        @empty
            <li class="p-3">Aucun logiciel critique trouvé.</li>
        @endforelse
    </ul>
</div>

<!-- Section des catégories de matériels en rupture de stock -->
<div class="mt-5">
    <h5 class="text-lg font-semibold mb-2">Catégories de Matériels en Rupture de Stock</h5>
    <ul class="bg-white rounded-lg shadow divide-y divide-gray-200">
        @forelse($categoriesRuptureStock as $categorie)
            <li class="p-3">
                {{ $categorie->NomCatMat }}
                (Stock: {{ $categorie->QteStockMat }} / Min: {{ $categorie->QteMinStockMat }})
            </li>
        @empty
            <li class="p-3">Aucune catégorie en rupture de stock trouvée.</li>
        @endforelse
    </ul>
</div>

<!-- Section des maintenances imminentes -->
<div class="mt-5">
    <h5 class="text-lg font-semibold mb-2">Maintenances Imminentes (dans les 15 prochains jours)</h5>
    <ul class="bg-white rounded-lg shadow divide-y divide-gray-200">
        @forelse($maintenancesImminentes as $maintenance)
            <li class="p-3">
                {{ $maintenance->actif->NomAct }}
                (Date: {{ $maintenance->DatProchMaint }})
            </li>
        @empty
            <li class="p-3">Aucune maintenance imminente trouvée.</li>
        @endforelse
    </ul>
</div>

        </div>
    </div>
</div>


<!-- Script pour Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Données pour le graphique linéaire
    const userEvolutionData = @json($userEvolution->pluck('count'));
    const userEvolutionLabels = @json($userEvolution->pluck('date'));

    // Graphique linéaire
    const ctx1 = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: userEvolutionLabels,
            datasets: [{
                label: 'Utilisateurs actifs',
                data: userEvolutionData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1,
                pointRadius: 2,
                pointHoverRadius: 4
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true
        }
    });

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
    }, 0); // Démarrer
    // Graphique des données par niveau de sensibilité
    const donneesData = @json($repartitionDonnees->pluck('count'));
    const donneesLabels = @json($repartitionDonnees->pluck('NivSensData'));
    const ctx3 = document.getElementById('donneesChart').getContext('2d');
    const donneesChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: donneesLabels,
            datasets: [{
                label: 'Données par niveau de sensibilité',
                data: donneesData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true
        }
    });

    // Graphique des logiciels par type de licence
    const logicielsData = @json($repartitionLogiciels->pluck('count'));
    const logicielsLabels = @json($repartitionLogiciels->pluck('TypLicLog'));
    const ctx4 = document.getElementById('logicielsChart').getContext('2d');
    const logicielsChart = new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: logicielsLabels,
            datasets: [{
                label: 'Logiciels par type de licence',
                data: logicielsData,
                backgroundColor: ['#ff6f61', '#6b5b95', '#88b04b', '#f7cac9']
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true
        }
    });

    // Graphique des actifs par type
    const actifsData = @json($repartitionActifs->pluck('count'));
    const actifsLabels = @json($repartitionActifs->pluck('type'));
    const ctx5 = document.getElementById('actifsChart').getContext('2d');
    const actifsChart = new Chart(ctx5, {
        type: 'pie',
        data: {
            labels: actifsLabels,
            datasets: [{
                label: 'Actifs par type',
                data: actifsData,
                backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56']
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true
        }
    });

    // Graphique des employés par statut
    const employesData = @json($repartitionEmployes->pluck('count'));
    const employesLabels = @json($repartitionEmployes->pluck('StatEmp'));
    const ctx6 = document.getElementById('employesChart').getContext('2d');
    const employesChart = new Chart(ctx6, {
        type: 'bar',
        data: {
            labels: employesLabels,
            datasets: [{
                label: 'Employés par statut',
                data: employesData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true
        }
    });

    // Graphique des fournisseurs par type de produit
    const fournisseursData = @json($repartitionFournisseurs->pluck('count'));
    const fournisseursLabels = @json($repartitionFournisseurs->pluck('TypProdFournit'));
    const ctx7 = document.getElementById('fournisseursChart').getContext('2d');
    const fournisseursChart = new Chart(ctx7, {
        type: 'pie',
        data: {
            labels: fournisseursLabels,
            datasets: [{
                label: 'Fournisseurs par type de produit',
                data: fournisseursData,
                backgroundColor: ['#4bc0c0', '#9966ff', '#ff9f40', '#ffcd56']
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true
        }
    });

    // Initialiser le graphique en camembert après 6 secondes
    setTimeout(() => {
        const ctx2 = document.getElementById('resourceChart').getContext('2d');
        const resourceChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Matériels', 'Logiciels', 'Données'],
                datasets: [{
                    data: [{{ $countMateriels }}, {{ $countLogiciels }}, {{ $countDonnees }}],
                    backgroundColor: ['#ffc107', '#dc3545', '#28a745']
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                animation: {
                    duration: 2000, // Durée de l'animation en millisecondes
                }
            }
        });

        // Afficher le graphique en camembert
        document.getElementById('resourceChart').style.display = 'block';
    }, 6000); // Délai de 6 secondes avant d'initialiser le graphique
</script>
@endsection
