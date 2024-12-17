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
                    <p class="card-text">1</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Données</h5>
                    <p class="card-text">7</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Matériels</h5>
                    <p class="card-text">15</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Logiciels</h5>
                    <p class="card-text">10</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section des tops -->
    <div class="row mt-5">
        <div class="col-md-4">
            <h5>Top 5 Matériels</h5>
            <ul class="list-group">
                <li class="list-group-item">Aucun matériel trouvé.</li>
            </ul>
        </div>
        <div class="col-md-4">
            <h5>Top 5 Données</h5>
            <ul class="list-group">
                <li class="list-group-item">Aucune donnée trouvée.</li>
            </ul>
        </div>
        <div class="col-md-4">
            <h5>Top 5 Logiciels</h5>
            <ul class="list-group">
                <li class="list-group-item">Aucun logiciel trouvé.</li>
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
    // Graphique linéaire
    const ctx1 = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
            datasets: [{
                label: 'Utilisateurs actifs',
                data: [3, 5, 8, 12, 10, 14, 20],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1,
                pointRadius: 2, // Cercles petits
                pointHoverRadius: 4
            }]
        },
        options: {
            maintainAspectRatio: false, // Désactive l'aspect ratio par défaut
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
                data: [15, 10, 7],
                backgroundColor: ['#ffc107', '#dc3545', '#28a745']
            }]
        },
        options: {
            maintainAspectRatio: false, // Désactive l'aspect ratio pour le camembert
            responsive: true
        }
    });
</script>

@endsection
