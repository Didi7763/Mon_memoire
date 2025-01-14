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
    <h2>Modifier un Actif de Logiciel</h2>
    <a href="{{ route('logiciel.index') }}" class="btn btn-secondary">Retour à la liste des logiciels</a>
</div>

<div class="form-container">
    <form action="{{ route('logiciel.update', $logiciel->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="IdAct" class="form-label">ID Actif</label>
            <input type="text" class="form-control" id="IdAct" name="IdAct" value="{{ $logiciel->actif->IdAct }}"required readonly>
        </div>

       <div class="mb-3">
            <label for="NomAct" class="form-label">Nom du logiciel</label>
            <input type="text" class="form-control" id="NomAct" name="NomAct" value="{{ $logiciel->actif->NomAct }}" required>
        </div>

        <div class="form-group">
            <label for="VersionLog">Version du logiciel</label>
            <input type="text" name="VersionLog" id="VersionLog" class="form-control" value="{{ $logiciel->VersionLog }}" required>
        </div>
        <div class="form-group">
            <label for="TypLicLog">Type de licence</label>
            <select name="TypLicLog" id="TypLicLog" class="form-control">
                <option value="" disabled {{ empty($logiciel->TypLicLog) ? 'selected' : '' }}>Type de licence</option>
                <option value="Libre" {{ $logiciel->TypLicLog ?? '' === 'Libre' ? 'selected' : '' }}>
                    Logiciel Libre (Open Source)
                </option>
                <option value="Propriétaire" {{ $logiciel->TypLicLog ?? '' === 'Propriétaire' ? 'selected' : '' }}>
                    Logiciel Propriétaire
                </option>
                <option value="Gratuiciel" {{ $logiciel->TypLicLog ?? '' === 'Gratuiciel' ? 'selected' : '' }}>
                    Logiciel Gratuiciel
                </option>
                <option value="SaaS" {{ $logiciel->TypLicLog ?? '' === 'SaaS' ? 'selected' : '' }}>
                    Licence SaaS
                </option>
                <option value="Réseau" {{ $logiciel->TypLicLog ?? '' === 'Réseau' ? 'selected' : '' }}>
                    Licence Réseau
                </option>

            </select>
        </div>
        <div class="form-group">
            <label for="NbrLicLog">Nombre de licence</label>
            <input type="number" name="NbrLicLog" id="NbrLicLog" class="form-control" value="{{ $logiciel->NbrLicLog }}" required>
        </div>
        <div class="form-group">
            <label for="NbrMinLicLog">Nombre minimal de licence</label>
            <input type="number" name="NbrMinLicLog" id="NbrMinLicLog" class="form-control" value="{{ $logiciel->NbrMinLicLog }}" required>
        </div>
        <div class="form-group">
            <label for="CleLicLog">Clé de licence</label>
            <input type="text" name="CleLicLog" id="CleLicLog" class="form-control" value="{{ $logiciel->CleLicLog }}"required>
        </div>

        <div class="form-group">
            <label for="DatAchLog">Date d'installation</label>
            <input type="date" name="DatAchLog" id="DatAchLog" class="form-control" value="{{ $logiciel->DatAchLog }}" required>
        </div>

        <div class="form-group">
            <label for="DatExpLog">Date d'expiration de Licence</label>
            <input type="date" name="DatExpLog" id="DatExpLog" class="form-control" value="{{ $logiciel->DatExpLog }}" required>
        </div>

        <div class="form-group">
            <label for="IdFour" class="form-label">Fournisseur</label>
            <select class="form-select" id="IdFour" name="IdFour" required>
                <option value="" disabled>-- Sélectionnez un actif --</option>
                @foreach ($fournisseurs as $fournisseur)
                <!-- Comparaison de l'ID de l'actif sélectionné avec celui de la maintenance -->
                <option value="{{ $fournisseur->IdFour }}"
                    {{ $logiciel->IdFour == $fournisseur->IdFour ? 'selected' : '' }}>
                    {{ $fournisseur->NomFour }}
                 </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ComtAct" class="form-label">Commentaire</label>
            <textarea name="ComtAct" id="ComtAct" class="form-control">{{ $logiciel->actif->ComtAct }}</textarea>
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
