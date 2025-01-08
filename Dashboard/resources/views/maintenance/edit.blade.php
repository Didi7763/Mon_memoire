@extends('layouts.app')

@section('title', 'Modifier une maintenance')

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
    <h2>Modifier une maintenance</h2>
    <a href="{{ route('maintenance.index') }}" class="btn btn-secondary" aria-label="Retour à la liste des maintenances">
        Retour à la liste des maintenances
    </a>
</div>

<div class="form-container">
    <form action="{{ route('maintenance.update', $maintenance->NumMaint ?? '') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="NumMaint" class="form-label">Numero</label>
            <input type="text" class="form-control" name="NumMaint" id="NumMaint"
                   value="{{ $maintenance->NumMaint  }}" required readonly>
        </div>

        <div class="mb-3">
            <label for="DesMaint" class="form-label">Description</label>
            <input type="text" class="form-control" name="DesMaint" id="DesMaint"
                   value="{{ $maintenance->DesMaint }}" required>
        </div>

        <div class="mb-3">
            <label for="TypMaint" class="form-label">Type de maintenance</label>
            <select name="TypMaint" class="form-select" id="TTypMaint" required>
                <option value="" disabled {{ empty($maintenance->TypMaint) ? 'selected' : '' }}>Type de maintenance</option>
                <option value="corrective" {{ $maintenance->TypMaint ?? '' === 'corrective' ? 'selected' : '' }}>
                    Maintenance corrective
                </option>
                <option value="préventive" {{ $maintenance->TypMaint ?? '' === 'préventive' ? 'selected' : '' }}>
                    Maintenance préventive
                </option>
                <option value="prédictive" {{ $maintenance->TypMaint ?? '' === 'prédictive' ? 'selected' : '' }}>
                    Maintenance prédictive
                </option>
                <option value="curative" {{ $maintenance->TypMaint ?? '' === 'curative' ? 'selected' : '' }}>
                    Maintenance curative
                </option>
                <option value="évolutif" {{ $maintenance->TypMaint ?? '' === 'évolutif' ? 'selected' : '' }}>
                    Maintenance évolutif
                </option>
            </select>
        </div>


        <div class="mb-3">
            <label for="DatMaint" class="form-label">Date de maintenance</label>
            <input type="date" class="form-control" name="DatMaint" id="DatMaint"
                   value="{{ $maintenance->DatMaint }}" required>
        </div>

        <div class="mb-3">
            <label for="NomTechMaint" class="form-label">Nom du technicien</label>
            <input type="text" class="form-control" name="NomTechMaint" id="NomTechMaint"
                   value="{{ $maintenance->NomTechMaint }}" required>
        </div>

        <div class="mb-3">
            <label for="CoutMaint" class="form-label">Coût</label>
            <input type="number" class="form-control" name="CoutMaint" id="CoutMaint"
                   value="{{ $maintenance->CoutMaint }}" required>
        </div>

        <div class="mb-3">
            <label for="DatProchMaint" class="form-label">Date de prochaine maintenance</label>
            <input type="date" class="form-control" name="DatProchMaint" id="DatProchMaint"
                   value="{{ $maintenance->DatProchMaint }}" required>
        </div>

        <div class="mb-3">
            <label for="IdAct" class="form-label">Identifiant de l'actif</label>
            <input type="text" class="form-control" name="IdAct" id="IdAct"
                   value="{{ $maintenance->IdAct }}" required>
        </div>

        <div class="mb-3">
            <label for="ComtMaint" class="form-label">Commentaire</label>
            <textarea name="ComtMaint" id="ComtMaint" class="form-control" rows="3">
                {{  $fournisseurs->ComtMaint ?? '' }}
            </textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
