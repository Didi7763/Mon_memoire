@extends('layouts.app')

@section('title', 'Liste des Attributions')

@section('main-content')
<div class="container">
    <h2 class="my-4">Liste des Attributions</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Bouton pour ajouter une attribution -->
    <div class="mb-3 text-end">
        <a href="{{ route('attributions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Attribuer un Actif
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Actif</th>
                <th>Utilisateur</th>
                <th>Admin</th>
                <th>Date d'Attribution</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attributions as $attribution)
            <tr>
                <td>{{ $attribution->id }}</td>
                <td>{{ $attribution->actif->NomAct ?? 'N/A' }}</td>
                <td>{{ $attribution->utilisateur->NomUser ?? 'N/A' }}</td>
                <td>{{ $attribution->admin->NomAdmin ?? 'N/A' }}</td>
                <td>{{ $attribution->DatAttAct }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
