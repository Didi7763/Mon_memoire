<!-- resources/views/materiels/create.blade.php -->
@extends('layouts.app')

@section('title', 'Ajouter un fournisseur')

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
    <h2>Formulaire de maintenance</h2>
    <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">Retour à la liste des maintenances</a>
</div>

<div class="form-container">
    <form action="{{ route('maintenance.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="DesMaint">Description</label>
            <input type="text" class="form-control" name="DesMaint" id="DesMaint"  required>
        </div>
        <div class="form-group">
            <label for="TypMaint">Type de maintenance</label>
            <select class="form-select" id="TypMaint" required="required" name="TypMaint">
                <option selected>Selectionne le type</option>
                <option value="corrective">Maintenance corrective</option>
                <option value="préventive">Maintenance préventive</option>
                <option value="prédictive">Maintenance préventive</option>
                <option value="curative">Maintenance prédictive</option>
                <option value="evolutive">Maintenance evolutive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="DatMaint">Date de maintenance</label>
            <input type="date" class="form-control" name="DatMaint" id="DatMaint"  required>
        </div>
        <div class="form-group">
            <label for="NomTechMaint">Nom du technicien</label>
            <input type="text" class="form-control" name="NomTechMaint" id="NomTechMaint"  required>
        </div>
        <div class="form-group">
            <label for="CoutMaint">Coût de maintenance</label>
            <input type="number" class="form-control" name="CoutMaint" id="CoutMaint"  required>
        </div>
        <div class="form-group">
            <label for="DatProchMaint">Date de prochaine maintenance</label>
            <input type="text" class="form-control" name="DatProchMaint" id="DatProchMaint">
        </div>
        <div class="form-group">
            <label for="IdAct">Identifiant de l'actif</label>
            <input type="text" class="form-control" name="IdAct" id="IdAct">
        </div>
        <div class="form-group">
            <label for="ComtMaint">Commentaire</label>
            <textarea name="ComtMaint" id="ComtMaint" class="form-control" ></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Ajouter</button>
    </form>
</div>
@endsection
