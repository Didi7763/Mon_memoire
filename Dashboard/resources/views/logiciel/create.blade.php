<!-- resources/views/materiels/create.blade.php -->
@extends('layouts.app')

@section('title', 'Ajouter un actif logiciel')

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
    <h2>Formulaire d'actif logiciel</h2>
    <a href="{{ route('logiciel.index') }}" class="btn btn-secondary">Retour à la liste des logiciels</a>
</div>

<div class="form-container">
    <form action="{{ route('logiciel.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="NomAct">Nom</label>
            <input type="text" name="NomAct" id="NomAct" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="MarqMat">Marque</label>
            <input type="text" name="MarqMat" id="MarqMat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ModMarq">Modèle</label>
            <input type="text" name="ModMarq" id="ModMarq" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="NumSerieMat">Numéro de Série</label>
            <input type="text" name="NumSerieMat" id="NumSerieMat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="QteMat">Quantité</label>
            <input type="number" name="QteMat" id="QteMat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="StatMat">Statut</label>
            <select name="StatMat" id="StatMat" class="form-control">
                <option value="En stock">En stock</option>
                <option value="Affecté">Affecté</option>
                <option value="Panne">Panne</option>
                <option value="Réparation">Réparation</option>
                <option value="Réformé">Réformé</option>
            </select>
        </div>
        <div class="form-group">
            <label for="DatAcqMat">Date d'acquisition</label>
            <input type="date" name="DatAcqMat" id="DatAcqMat" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Ajouter</button>
    </form>
</div>
@endsection
