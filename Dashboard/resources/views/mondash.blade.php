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
                    <h5 class="card-title">Actifs</h5>
                    <p class="card-text">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Matériels</h5>
                    <p class="card-text">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Logiciels</h5>
                    <p class="card-text">0</p>
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
@endsection
