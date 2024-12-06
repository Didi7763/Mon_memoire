@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Tableau de bord</h1>
            <div class="card">
                <div class="card-header">
                    <h3>Statistiques</h3>
                </div>
                <div class="card-body">
                    <p>Bienvenue sur votre tableau de bord</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h4>Utilisateurs</h4>
                                    <p>150</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h4>Revenus</h4>
                                    <p>$25,000</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h4>Nouveaux clients</h4>
                                    <p>45</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
