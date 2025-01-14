@extends('layouts.app')

@section('title', 'Modifier un Actif de Données')

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
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        max-height: 70dvh;
        overflow: auto;
    }
    .btn-primary{
        margin: 1vh 0;
    }
    input[readonly] {
    cursor: not-allowed;
    background-color: #f0f0f0; /* Optionnel : Changer l'apparence pour montrer que c'est non modifiable */
    }
</style>
@endsection

@section('main-content')

<div class="header-container">
    <h2>Modifier un Actif de Données</h2>
    <a href="{{ route('donnees.index') }}" class="btn btn-secondary">Retour à la liste des données</a>
</div>

<div class="form-container">
    <form action="{{ route('donnees.update', $donnee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="IdAct" class="form-label">ID Actif</label>
            <input type="text" class="form-control" id="IdAct" name="IdAct" value="{{ $donnee->IdAct }}" required readonly>
        </div>

        <div class="mb-3">
            <label for="NomAct" class="form-label">Nom de l'actif</label>
            <input type="text" class="form-control" id="NomAct" name="NomAct" value="{{ $donnee->actif->NomAct }}" required>
        </div>

        <div class="mb-3">
            <label for="FormatData" class="form-label">Format de la donnée</label>
            <input type="text" class="form-control" id="FormatData" name="FormatData" value="{{ $donnee->FormatData }}" required>
        </div>

        <div class="mb-3">
            <label for="SourceData" class="form-label">Source de la donnée</label>
            <input type="text" class="form-control" id="SourceData" name="SourceData" value="{{ $donnee->SourceData }}" required>
        </div>

        <div class="mb-3">
            <label for="ResponsabeData" class="form-label">Responsable</label>
            <input type="text" class="form-control" id="ResponsabeData" name="ResponsabeData" value="{{ $donnee->ResponsabeData }}" required>
        </div>

        <div class="mb-3">
            <label for="NivSensData" class="form-label">Niveaux de sensibilité</label>
            <select class="form-select" id="NivSensData" name="NivSensData" required>
                <option value="Public" {{ $donnee->NivSensData == 'Public' ? 'selected' : '' }}>Donnée publique</option>
                <option value="Interne" {{ $donnee->NivSensData == 'Interne' ? 'selected' : '' }}>Donnée Interne</option>
                <option value="Confidentiel" {{ $donnee->NivSensData == 'Confidentiel' ? 'selected' : '' }}>Donnée confidentielle</option>
                <option value="Discrets" {{ $donnee->NivSensData == 'Discrets' ? 'selected' : '' }}>Donnée discrète</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="StatData" class="form-label">Statut</label>
            <select class="form-select" id="StatData" name="StatData" required>
                <option value="en création" {{ $donnee->StatData == 'en création' ? 'selected' : '' }}>Donnée en création</option>
                <option value="active" {{ $donnee->StatData == 'active' ? 'selected' : '' }}>Donnée active</option>
                <option value="stockée" {{ $donnee->StatData == 'stockée' ? 'selected' : '' }}>Donnée stockée</option>
                <option value="obsolète" {{ $donnee->StatData == 'obsolète' ? 'selected' : '' }}>Donnée obsolète</option>
                <option value="supprimée" {{ $donnee->StatData == 'supprimée' ? 'selected' : '' }}>Donnée supprimée</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ComtAct" class="form-label">Commentaire</label>
            <textarea name="ComtAct" id="ComtAct" class="form-control">{{ $donnee->actif->ComtAct }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>



@endsection
