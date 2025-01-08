@extends('layouts.app')

@section('title', 'Liste des attributions')

@section('custom-css-add')
<style>
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 3vh;
        margin-bottom: 5vh;
        padding: 2vh;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
    <li class="has-submenu">
        <a href="#actifs" class="active"><i class="bi bi-display"></i>Actifs</a>
        <ul class="submenu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-database"></i>Actifs de données</a></li>
            <li><a class="dropdown-item active" href="#"><i class="bi bi-terminal"></i>Actif logiciel</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-cpu"></i>Actif matériel</a></li>
        </ul>
    </li>
</ul>
@endsection

@section('main-content')
<div class="header-container">
    <h2>Liste des attributions</h2>
    <a href="{{ route('attributions.create') }}" class="btn btn-primary btn-add">
        <i class="bi bi-plus-circle"></i>
        Attribuer un actif
    </a>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Actif</th>
                <th>Utilisateur</th>
                <th>Admin</th>
                <th>Date d'attribution</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attributions as $attribution)
            <tr>
                <td>{{ $attribution->id }}</td>
                <td>{{ $attribution->actif->NomAct ?? 'N/A' }}</td>
                <td>{{ $attribution->utilisateur->NomUser ?? 'N/A' }}</td>
                <td>{{ $attribution->admin->NomAdmin ?? 'N/A' }}</td>
                <td>{{ $attribution->DatAttAct }}</td>
                <td class="action-buttons">
                    <a href="{{ route('User_Employe.edit', $attribution->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('User_Employe.destroy', $attribution->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette attribution ?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Aucune attribution trouvée</td>
            </tr>
            @endforelse
        </tbody>
    </table>


</div>

   
</div>
@endsection
