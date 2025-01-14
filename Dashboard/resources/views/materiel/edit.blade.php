@extends('layouts.app')

@section('title', 'Modifier un actif matériel')

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
    <a href="{{ route('materiel.index') }}" class="btn btn-secondary">Retour à la liste des matériels</a>
</div>

<div class="form-container">
    <form action="{{ route('materiel.update', $materiel->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="IdAct" class="form-label">ID Actif</label>
            <input type="text" class="form-control" id="IdAct" name="IdAct" value="{{ $materiel->actif->IdAct }}" required readonly>
        </div>
        <div class="form-group">
            <label for="NomAct">Nom du matériel</label>
            <input type="text" name="NomAct" id="NomAct" class="form-control" value="{{ $materiel->actif->NomAct }}" required>
        </div>
        <div class="form-group">
            <label for="MarqMat">Marque</label>
            <input type="text" name="MarqMat" id="MarqMat" class="form-control" value="{{ $materiel->MarqMat }}" required>
        </div>
        <div class="form-group">
            <label for="ModMarq">Modèle</label>
            <input type="text" name="ModMarq" id="ModMarq" class="form-control" value="{{ $materiel->ModMarq }}" required>
        </div>
        <div class="form-group">
            <label for="NumSerieMat">Numéro de Série</label>
            <input type="text" name="NumSerieMat" id="NumSerieMat" class="form-control" value="{{ $materiel->NumSerieMat }}" required>
        </div>
        <div class="form-group">
            <label for="QteMat">Quantité</label>
            <input type="number" name="QteMat" id="QteMat" class="form-control" value="{{ $materiel->QteMat }}" required readonly>
        </div>
        <div class="form-group">
            <label for="StatMat">Statut</label>
            <select name="StatMat" id="StatMat" class="form-control">
                <option value="" disabled {{ empty($materiel->StatMat) ? 'selected' : '' }}>Selection du statut</option>
                <option value="En stock" {{ $materiel->StatMat ?? '' === 'En stock' ? 'selected' : '' }}>
                    En stock
                </option>
                <option value="Affecté" {{ $materiel->StatMat ?? '' === 'Affecté' ? 'selected' : '' }}>
                   Affecté
                </option>
                <option value="Panne" {{ $materiel->StatMat ?? '' === 'Panne' ? 'selected' : '' }}>
                    Panne
                </option>
                <option value="Réparation" {{ $materiel->StatMat ?? '' === 'Réparation' ? 'selected' : '' }}>
                    Réparation
                </option>
                <option value="Réformé" {{ $materiel->StatMat ?? '' === 'Réformé' ? 'selected' : '' }}>
                    Réformé
                </option>

            </select>
        </div>
        <div class="form-group">
            <label for="DatAcqMat">Date de reception</label>
            <input type="date" name="DatAcqMat" id="DatAcqMat" class="form-control" value="{{ $materiel->DatAcqMat }}" required>
        </div>
        <div class="form-group">
            <label for="DureVieMat">Durée de vie (en année) </label>
            <input type="number" name="DureVieMat" id="DureVieMat" class="form-control" value="{{ $materiel->DureVieMat }}" required>
        </div>
        <div class="form-group">
            <label for="IdFour" class="form-label">Fournisseur</label>
            <select class="form-select" id="IdFour" name="IdFour" required>
                <option value="" disabled>-- Sélectionnez le fournisseur --</option>
                @foreach ($fournisseurs as $fournisseur)
                <!-- Comparaison de l'ID de l'actif sélectionné avec celui de la maintenance -->
                <option value="{{ $fournisseur->IdFour }}"
                    {{ $materiel->IdFour == $fournisseur->IdFour ? 'selected' : '' }}>
                    {{ $fournisseur->NomFour }}
                 </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="RefCatMat" class="form-label">Catégorie</label>
            <select class="form-select" id="RefCatMat" name="RefCatMat" required>
                <option value="" disabled>-- Sélectionnez la catégorie --</option>
                @foreach ($categorie_materiels as $categorie)
                <!-- Comparaison de l'ID de l'actif sélectionné avec celui de la maintenance -->
                <option value="{{ $categorie->RefCatMat }}"
                    {{ $materiel->RefCatMat == $categorie->RefCatMat ? 'selected' : '' }}>
                    {{ $categorie->NomCatMat }}
                 </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ComtAct">Commentaire</label>
            <textarea name="ComtAct" id="ComtAct" class="form-control" value="" >{{ $materiel->actif->ComtAct}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>

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
