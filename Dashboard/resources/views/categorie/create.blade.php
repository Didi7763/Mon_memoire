<!-- resources/views/materiels/create.blade.php -->
@extends('layouts.app')

@section('title', 'Ajouter une catégorie')

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
        padding: 0.5dvh 1dvw;
        display: flex;
        align-items: center;
        gap: 0.5dvw;
    }

    /* Personnalisation CSS pour le formulaire */
    .form-container {
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('main-content')
<div class="header-container">
    <h2>Formulaire de catégorie matériel</h2>
    <a href="{{ route('categorie.index') }}" class="btn btn-secondary">Retour à la liste des catégories</a>
</div>

<div class="form-container">
    <form action="{{ route('categorie.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="RefCatMat">Reference de la catégorie</label>
            <input type="text" class="form-control" name="RefCatMat" id="RefCatMat"  required>
        </div>

        <div class="form-group">
            <label for="NomCatMat">Nom de la catégorie</label>
            <input type="text" class="form-control" name="NomCatMat" id="NomCatMat"  required>
        </div>
        <!--<div class="form-group">
            <label for="QteStockMat">Quantité en Stock</label>
            <input type="number" class="form-control" name="QteStockMat" id="QteStockMat"  required>
        </div>-->
        <div class="form-group">
            <label for="QteMinStockMat">Quantité minimal en stock</label>
            <input type="number" class="form-control" name="QteMinStockMat" id="QteMinStockMat"  required>
        </div>

        <div class="form-group">
            <label for="NoteCatMat">Commentaire</label>
            <textarea name="NoteCatMat" id="NoteCatMat" class="form-control" ></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Ajouter</button>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </form>
</div>
@endsection
