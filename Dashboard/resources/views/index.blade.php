@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2 bg-light">
        <nav class="nav flex-column">
            <a class="nav-link" href="{{ route('dashboard') }}">Tableau de bord</a>
            <a class="nav-link" href="{{ route('actifs') }}">Actifs</a>
            <a class="nav-link" href="{{ route('utilisateurs') }}">Utilisateurs</a>
            <!-- Ajoutez les autres liens ici -->
        </nav>
    </div>
    <div class="col-10">
        <h1>Tableau de Bord</h1>
        <p>Bienvenue sur le tableau de bord.</p>
        <!-- Contenu principal -->
    </div>
</div>
@endsection
