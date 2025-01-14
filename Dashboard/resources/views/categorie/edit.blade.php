@extends('layouts.app')

@section('title', 'Modifier une catégorie')

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

    .form-container {
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        padding: 0.5vh 1vw;
        display: flex;
        align-items: center;
        gap: 0.5vw;
    }

    input[readonly] {
    cursor: not-allowed;
    background-color: #f0f0f0; /* Optionnel : Changer l'apparence pour montrer que c'est non modifiable */
}
</style>
@endsection

@section('main-content')
<div class="header-container">
    <h2>Modifier une catégorie</h2>
    <a href="{{ route('categorie.index') }}" class="btn btn-secondary" aria-label="Retour à la liste des catégories">
        Retour à la liste des catégories
    </a>
</div>

<div class="form-container">
    <form action="{{ route('categorie.update', $categorie_materiels->RefCatMat ?? '') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="RefCatMat">Référence de la catégorie</label>
            <input
                type="text"
                class="form-control"
                name="RefCatMat"
                id="RefCatMat"
                value="{{ $categorie_materiels->RefCatMat ?? '' }}"
                required
                readonly>
        </div>

        <div class="mb-3">
            <label for="NomCatMat">Nom de la catégorie</label>
            <input
                type="text"
                class="form-control"
                name="NomCatMat"
                id="NomCatMat"
                required
                value="{{ $categorie_materiels->NomCatMat ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="QteStockMat">Quantité en Stock</label>
            <input
                type="number"
                class="form-control"
                name="QteStockMat"
                id="QteStockMat"
                required
                value="{{ $categorie_materiels->QteStockMat ?? '' }}"
                readonly>
        </div>

        <div class="mb-3">
            <label for="QteMinStockMat">Quantité minimale en stock</label>
            <input
                type="number"
                class="form-control"
                name="QteMinStockMat"
                id="QteMinStockMat"
                required
                value="{{ $categorie_materiels->QteMinStockMat ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="NoteCatMat" class="form-label">Commentaire</label>
            <textarea
                name="NoteCatMat"
                id="NoteCatMat"
                class="form-control"
                rows="3">{{ $categorie_materiels->NoteCatMat ?? '' }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>

@endsection
