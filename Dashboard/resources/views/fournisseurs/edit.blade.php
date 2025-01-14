@extends('layouts.app')

@section('title', 'Modifier un fournisseur')

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
    <h2>Modifier un fournisseur</h2>
    <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary" aria-label="Retour à la liste des fournisseurs">
        Retour à la liste des fournisseurs
    </a>
</div>

<div class="form-container">
    <form action="{{ route('fournisseurs.update', $fournisseurs->IdFour ?? '') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="IdFour" class="form-label">Identifiant</label>
            <input type="text" class="form-control" name="IdFour" id="IdFour"
                   value="{{ $fournisseurs->IdFour  }}" required readonly>
        </div>

        <div class="mb-3">
            <label for="NomFour" class="form-label">Nom du fournisseur</label>
            <input type="text" class="form-control" name="NomFour" id="NomFour"
                   value="{{ $fournisseurs->NomFour }}" required>
        </div>

        <div class="mb-3">
            <label for="ContFour" class="form-label">Contact</label>
            <input type="text" class="form-control" name="ContFour" id="ContFour"
                   value="{{ $fournisseurs->ContFour }}" required>
        </div>

        <div class="mb-3">
            <label for="EmailFour" class="form-label">Email</label>
            <input type="email" class="form-control" name="EmailFour" id="EmailFour"
                   value="{{ $fournisseurs->EmailFour }}" required>
        </div>

        <div class="mb-3">
            <label for="AdressFour" class="form-label">Adresse locale</label>
            <input type="text" class="form-control" name="AdressFour" id="AdressFour"
                   value="{{ $fournisseurs->AdressFour }}" required>
        </div>

        <div class="mb-3">
            <label for="NomPersCont" class="form-label">Nom du personnel</label>
            <input type="text" class="form-control" name="NomPersCont" id="NomPersCont"
                   value="{{ $fournisseurs->NomPersCont }}" required>
        </div>

        <div class="mb-3">
            <label for="TypProdFournit" class="form-label">Type de produit</label>
            <select name="TypProdFournit" class="form-select" id="TypProdFournit" required>
                <option value="" disabled {{ empty($fournisseurs->TypProdFournit) ? 'selected' : '' }}>Type Produit</option>
                <option value="matériel" {{ old('TypProdFournit', $fournisseurs->TypProdFournit ?? '') === 'matériel' ? 'selected' : '' }}>
                    Matériel
                </option>
                <option value="logiciel" {{ old('TypProdFournit', $fournisseurs->TypProdFournit ?? '') === 'logiciel' ? 'selected' : '' }}>
                    Logiciel
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label for="NotesFour" class="form-label">Commentaire</label>
            <textarea name="NotesFour" id="NotesFour" class="form-control" rows="3">
                {{ old('NotesFour', $fournisseurs->NotesFour ?? '') }}
            </textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
