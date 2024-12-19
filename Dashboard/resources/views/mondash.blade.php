@extends('layouts.app')

@section('title', 'Mondash')

@section('main-content')
<div class="container mt-5">
    <h1 class="text-center">Dashboard</h1>

    <!-- Section des indicateurs principaux -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs</h5>
                    <p class="card-text">{{ $countUtilisateurs }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Données</h5>
                    <p class="card-text">{{ $countDonnees }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Matériels</h5>
                    <p class="card-text">{{ $countMateriels }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Logiciels</h5>
                    <p class="card-text">{{ $countLogiciels }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section des tops -->
    <div class="row mt-5">
        <div class="col-md-4">
            <h5>Top 5 Matériels</h5>
            <ul class="list-group">
                @forelse($topMateriels as $materiel)
                    <li class="list-group-item">
                        {{ $materiel->MarqMat }} {{ $materiel->ModMarq }} 
                        (Qté: {{ $materiel->QteMat }})
                    </li>
                @empty
                    <li class="list-group-item">Aucun matériel trouvé.</li>
                @endforelse
            </ul>
        </div>
        <div class="col-md-4">
            <h5>Top 5 Données</h5>
            <ul class="list-group">
                @forelse($topDonnees as $donnee)
                    <li class="list-group-item">
                        {{ $donnee->SourceData }} 
                        ({{ $donnee->DatRecpData }})
                    </li>
                @empty
                    <li class="list-group-item">Aucune donnée trouvée.</li>
                @endforelse
            </ul>
        </div>
        <div class="col-md-4">
            <h5>Top 5 Logiciels</h5>
            <ul class="list-group">
                @forelse($topLogiciels as $logiciel)
                    <li class="list-group-item">
                        {{ $logiciel->VersionLog }} 
                        (Licences: {{ $logiciel->NbrLicLog }})
                    </li>
                @empty
                    <li class="list-group-item">Aucun logiciel trouvé.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<div class="container mt-5">
    <!-- Section des graphiques -->
    <div class="row mt-5">
        <!-- Graphique linéaire -->
        <div class="col-md-6 d-flex justify-content-center">
            <div style="width: 100%; max-width: 500px; height: 300px;">
                <h5 class="text-center">Évolution des utilisateurs</h5>
                <canvas id="userChart" width="500" height="300"></canvas>
            </div>
        </div>

        <!-- Graphique en camembert -->
        <div class="col-md-6 d-flex justify-content-center">
            <div style="width: 100%; max-width: 400px; height: 300px;">
                <h5 class="text-center">Répartition des ressources</h5>
                <canvas id="resourceChart" width="400" height="300"></canvas>
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

    // Graphique en camembert
    const ctx2 = document.getElementById('resourceChart').getContext('2d');
    const resourceChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Matériels', 'Logiciels', 'Données'],
            datasets: [{
                data: [{{ $countMateriels }} , {{ $countLogiciels }}, {{ $countDonnees }}],
                backgroundColor: ['#ffc107', '#dc3545', '#28a745']
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true
        }
    });
</script>
@endsection