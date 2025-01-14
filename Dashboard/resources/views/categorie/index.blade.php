@extends('layouts.app')

@section('title')
Liste des Catégories matérielles
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

@endsection

@section('main-content')
<div class="header-container">
    <h2>Liste des catégories matériels</h2>
    <a href="{{ route('categorie.create') }}" class="btn btn-primary btn-add">
        <i class="bi bi-plus-circle"></i>
        Ajouter une nouvelle catégorie
    </a>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Nom</th>
                <th>Quantité en stock</th>
                <th>Quantité minimun en stock</th>
                <th>Commentaire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categorie_materiels as $categorie)
                <tr>
                    <td>{{ $categorie->RefCatMat }}</td>
                    <td>{{ $categorie->NomCatMat }}</td>
                    <td>{{ $categorie->QteStockMat }}</td>
                    <td>{{ $categorie->QteMinStockMat }}</td>
                    <td>{{ $categorie->NoteCatMat }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('categorie.edit', $categorie->RefCatMat) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('categorie.destroy', $categorie->RefCatMat) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Aucune catégorie trouvée</td>
                </tr>
            @endforelse
        </tbody>

    </table>

    @if($categorie_materiels->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $categorie_materiels->links() }}
    </div>
    @endif
</div>
@endsection
