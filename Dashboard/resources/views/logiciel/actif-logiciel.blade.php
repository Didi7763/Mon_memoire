@extends('layouts.app')

@section('title')
Liste des Actifs Logiciels
@endsection

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

@section('sidebar')
<ul>
    <li><a href="#tableau de bord"><i class="bi bi-speedometer2"></i>Tableau de bord</a></li>
    <li class="has-submenu"><a href="#actifs" class="active"><i class="bi bi-display"></i>Actifs</a>
        <ul class="submenu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-database"></i>Actifs de données</a></li>
            <li><a class="dropdown-item active" href="#"><i class="bi bi-terminal"></i>Actif logiciel</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-cpu"></i>Actif matériel</a></li>
        </ul>
    </li>
    <!-- Reste du sidebar identique à votre code -->
</ul>
@endsection

@section('main-content')
<div class="header-container">
    <h2>Liste des Actifs Logiciels</h2>
    <a href="{{ route('logiciel.create') }}" class="btn btn-primary btn-add">
        <i class="bi bi-plus-circle"></i>
        Ajouter un actif logiciel
    </a>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Version</th>
                <th>Type</th>
                <th>Nombre</th>
                <th>Clé</th>
                <th>Date d'installation</th>
                <th>Date d'expiration</th>
                <th>Commentaire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logiciels as $logiciel)
            <tr>
                <td>{{ $logiciel->actif->IdAct }}</td>
                <td>{{ $logiciel->actif->NomAct }}</td>
                <td>{{ $logiciel->VersionLog }}</td>
                <td>{{ $logiciel->TypLicLog }}</td>
                <td>{{ $logiciel->NbrLicLog }}</td>
                <td>{{ $logiciel->CleLicLog }}</td>
                <td>{{ \Carbon\Carbon::parse($logiciel->DatAchLog)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($logiciel->DatExpLog)->format('d/m/Y') }}</td>
                <td>{{ $logiciel->actif->ComtAct }}</td>
                <td>
                    <!-- Modification de l'action avec un lien vers l'édition -->
                    <a href="{{ route('logiciel.edit', $logiciel->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <!-- Formulaire pour la suppression -->
                    <form action="{{ route('logiciel.destroy', $logiciel->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Aucun actif logiciel trouvé</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($logiciels->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $logiciels->links() }}
    </div>
    @endif
</div>
@endsection
