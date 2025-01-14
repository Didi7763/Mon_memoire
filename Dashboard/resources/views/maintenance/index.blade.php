@extends('layouts.app')

@section('title')
Liste des Maintenances effectuées
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
    <h2>Liste des maintenances effectuées</h2>
    <a href="{{ route('maintenance.create') }}" class="btn btn-primary btn-add">
        <i class="bi bi-plus-circle"></i>
        Ajouter une nouvelle maintenance
    </a>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Numero</th>
                <th>actifs</th>
                <th>Description</th>
                <th>Type</th>
                <th>Date</th>
                <th>Nom technicien</th>
                <th>coût</th>
                <th>Prochaine maintenance</th>
                <th>Commentaires</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($maintenances as $maintenance)
                <tr>
                    <td>{{ $maintenance->NumMaint }}</td>
                    <td>{{ $maintenance->actif->NomAct }}</td>
                    <td>{{ $maintenance->DesMaint }}</td>
                    <td>{{ $maintenance->TypMaint }}</td>
                    <td>{{ \Carbon\Carbon::parse($maintenance->DatMaint)->format('d/m/Y') }}</td>
                    <td>{{ $maintenance->NomTechMaint }}</td>
                    <td>{{ number_format($maintenance->CoutMaint, 0, '.', ' ') }} FCFA</td>
                    <td>{{ \Carbon\Carbon::parse($maintenance->DatProchMaint)->format('d/m/Y') }}</td>
                    <td>{{ $maintenance->ComtMaint }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('maintenance.edit', $maintenance->NumMaint) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('maintenance.destroy', $maintenance->NumMaint) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Aucune maintenance trouvée</td>
                </tr>
            @endforelse
        </tbody>

    </table>

    @if($maintenances->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $maintenances->links() }}
    </div>
    @endif
</div>
@endsection
