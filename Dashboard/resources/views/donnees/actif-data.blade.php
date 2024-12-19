@extends('layouts.app')

@section('title', 'Liste des Actifs de Données')

@section('main-content')
<div class="container">
    <h2>Liste des Actifs de Données</h2>
    <a href="{{ route('donnees.create') }}" class="btn btn-primary mb-3">Ajouter un Actif</a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Format</th>
                <th>Source</th>
                <th>Responsable</th>
                <th>Statut</th>
                <th>Date Réception</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donnees as $donnee)
            <tr>
                <td>{{ $donnee->IdAct }}</td>
                <td>{{ $donnee->FormatData }}</td>
                <td>{{ $donnee->SourceData }}</td>
                <td>{{ $donnee->ResponsabeData }}</td>
                <td>{{ $donnee->StatData }}</td>
                <td>{{ $donnee->DatRecpData }}</td>
                <td>
                    <a href="{{ route('donnees.edit', $donnee->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('donnees.destroy', $donnee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Aucun actif trouvé</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $donnees->links() }}
    </div>
</div>
@endsection
