@extends('layouts.app')

@section('title')
Liste des Actifs Matériels
@endsection

@section('custom-css-add')
<style>
    .right-panel{
        overflow: hidden;
        overflow-y: none;
    }
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
        width:78vw;
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
        width:78vw;
    }

    .status-badge {
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        margin: 0;
    }

    .status-stock { background: #e3f2fd; color: #1976d2; }
    .status-affecte { background: #e8f5e9; color: #2e7d32; }
    .status-panne { background: #fce4ec; color: #c2185b; }
    .status-maintenance { background: #fff3e0; color: #f57c00; }
    .status-reforme { background: #efebe9; color: #5d4037; }

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
    <li> <a href="#tableau de bord" ><i class="bi bi-speedometer2"></i>Tableau de bord</a></li>
    <li class="has-submenu"><a href="#actifs" class="active"><i class="bi bi-display"></i>Actifs</a>
        <ul class="submenu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-database"></i>Actifs de données</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-terminal"></i>Actif logiciel</a></li>
            <li><a class="dropdown-item active" href="#"><i class="bi bi-cpu"></i>Actif matériel</a></li>
        </ul>
    </li>
    <!-- Reste du sidebar identique à votre code -->
</ul>
@endsection

@section('main-content')


<div class="header-container">
    <h2>Liste des Actifs Matériels</h2>
    <a href="{{ route('materiel.create') }}" class="btn btn-primary btn-add">
        <i class="bi bi-plus-circle"></i>
        Ajouter un actif matériel
    </a>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>N° Série</th>
                <th>Statut</th>
                <th>Date de reception</th>
                <th>Délai d'utilisation</th>
                <th>Fournisseur</th>
                <th>Catégorie</th>
                <th>Commentaire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materiels as $materiel)
            <tr>
                <td>{{ $materiel->actif->IdAct }}</td>
                <td>{{ $materiel->actif->NomAct }}</td>
                <td>{{ $materiel->MarqMat }}</td>
                <td>{{ $materiel->ModMarq }}</td>
                <td>{{ $materiel->NumSerieMat }}</td>
                <td>
                    <span class="status-badge
                        @switch($materiel->StatMat)
                            @case('En stock') status-stock @break
                            @case('Affecté') status-affecte @break
                            @case('panne') status-panne @break
                            @case('reparation') status-maintenance @break
                            @case('Réformé') status-reforme @break
                        @endswitch">
                        {{ $materiel->StatMat }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($materiel->DatAcqMat )->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($materiel->DatAcqMat)->addYears($materiel->DureVieMat)->format('d/m/Y') }}</td>
                <td>{{ $materiel->fournisseur->NomFour }}</td>
                <td>{{ $materiel->categorie->NomCatMat }}</td>
                <td>{{ $materiel->actif->ComtAct }}</td>
                    <td class="action-buttons">
                        <a href="{{route('materiel.edit', $materiel->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('materiel.destroy', $materiel->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Aucun actif matériel trouvé</td>
                </tr>
            @endforelse
        </tbody>

    </table>

    @if($materiels->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $materiels->links() }}
    </div>
    @endif
</div>

@endsection
