@extends('layouts.app')

@section('title')
Liste des employés
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






    .status-badge {
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        margin: 0;
    }

    .status-activite { background: #e3f2fd; color: #1976d2; }
    .status-retraite { background: #e8f5e9; color: #2e7d32; }
    .status-contrat {background: #fbffde; color: #c0c524;}
    .status-suspendu { background: #fce4ec; color: #c2185b; }
    .status-conge { background: #fff3e0; color: #f57c00; }
    .status-formation { background: #efebe9; color: #5d4037; }
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
    <h2>Liste des utilisateurs (employés)</h2>
    <a href="{{ route('User_Employe.create') }}" class="btn btn-primary btn-add">
        <i class="bi bi-plus-circle"></i>
        Ajouter un nouveau utilisateur
    </a>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom et Prénoms</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Fonction</th>
                <th>Statut</th>
                <th>Actifs obligatoire</th>
                <th>Services</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employes as $employe)
            <tr>
                <td>{{ $employe->utilisateur->CodeUser }}</td>
                <td>{{ $employe->utilisateur->NomCompUser }}</td>
                <td>{{ $employe->utilisateur->ContactUser }}</td>
                <td>{{ $employe->utilisateur->EmailUser }}</td>
                <td>{{ $employe->FonctEmp }}</td>
                <td>
                    <span class="status-badge
                        @switch($employe->StatEmp)
                            @case('En activité') status-activite @break
                            @case('En congé') status-conge @break
                            @case('Suspendu') status-suspendu @break
                            @case('En formation') status-formation @break
                            @case('Retraité') status-retraite @break
                            @case('Fin contrat') status-contrat @break
                        @endswitch">
                        {{ $employe->StatEmp }}
                    </span>
                </td>

                <td>{{ $employe->ListActif }}</td>
                <td>{{ $employe->service->utilisateur->NomCompUser }}</td>
                <td>
                    <!-- Modification de l'action avec un lien vers l'édition -->
                    <a href="{{ route('User_Employe.edit', $employe->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <!-- Formulaire pour la suppression -->
                    <form action="{{ route('User_Employe.destroy', $employe->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Aucun employé trouvé</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($employes->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $employes->links() }}
    </div>
    @endif
</div>
@endsection
