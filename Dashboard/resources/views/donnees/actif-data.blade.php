@extends('layouts.app')

@section('title', 'Liste des Actifs de Données')

@section('custom-css-add')
<style>
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 3dvh;
        margin-bottom: 5dvh;
        padding: 2dvh;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-add {
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-container {
        background: #fff;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .action-btn {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }
</style>
@endsection

@section('main-content')

<div class="header-container">
    <h2>Liste des Actifs de Données</h2>
    <a href="{{ route('donnees.create') }}" class="btn btn-primary btn-add">
        <i class="bi bi-plus-circle"></i>
        Ajouter une donnée
    </a>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Format</th>
                <th>Source</th>
                <th>Responsable</th>
                <th>Statut</th>
                <th>Date de reception</th>
                <th>Dernière mise à jour</th>
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
                <td>{{ $donnee->DatMajData }}</td>
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
                <td colspan="7" class="text-center">Aucune donnée trouvée</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($donnees->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $donnees->links() }}
    </div>
    @endif
</div>
@endsection
