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
        margin-bottom: 2rem;
        padding: 1rem;
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
    <a href="/logiciels" class="btn btn-primary btn-add">
        <i class="bi bi-plus-circle"></i>
        Ajouter un actif logiciel
    </a>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Version</th>
                <th>Type de licence</th>
                <th>Nombre de licences</th>
                <th>Clé de licence</th>
                <th>Date d'achat</th>
                <th>Date d'expiration</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logiciels as $logiciel)
            <tr>
                <td>{{ $logiciel->IdAct }}</td>
                <td>{{ $logiciel->VersionLog }}</td>
                <td>{{ $logiciel->TypLicLog }}</td>
                <td>{{ $logiciel->NbrLicLog }}</td>
                <td>{{ $logiciel->CleLicLog }}</td>
                <td>{{ $logiciel->DatAchLog }}</td>
                <td>{{ $logiciel->DatExpLog }}</td>
                <td class="action-buttons">
                    <button class="action-btn btn-info" title="Voir" onclick="window.location.href='{{ route('logiciels.show', $logiciel->id) }}'">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="action-btn btn-warning" title="Modifier" onclick="window.location.href='{{ route('logiciels.edit', $logiciel->id) }}'">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <form action="{{ route('logiciels.destroy', $logiciel->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet actif ?')">
                            <i class="bi bi-trash"></i>
                        </button>
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
