@extends('layouts.app')

@section('title', 'Liste des Historiques')

@section('main-content')
<div class="container">
    <h2>Liste des Historiques</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Date</th>
                <th>Description</th>
                <th>Actif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historiques as $historique)
            <tr>
                <td>{{ $historique->NumHist }}</td>
                <td>{{ $historique->DatAction }}</td>
                <td>{{ $historique->DesAction }}</td>
                <td>{{ $historique->actif->NomAct ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('historiques.show', $historique->NumHist) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('historiques.edit', $historique->NumHist) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('historiques.destroy', $historique->NumHist) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet historique ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $historiques->links() }}
</div>
@endsection
