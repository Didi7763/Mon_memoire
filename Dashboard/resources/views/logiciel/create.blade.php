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
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        max-height: 70dvh;
        overflow: auto;
    }
    .btn-primary{
        margin: 1vh 0;
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
        <div class="mb-3">
            <label for="IdAct" class="form-label">ID Actif</label>
            <input type="text" class="form-control" id="IdAct" name="IdAct" required>
        </div>

        <div class="mb-3">
            <label for="NomAct" class="form-label">Nom du logiciel</label>
            <input type="text" class="form-control" id="NomAct" name="NomAct" required>
        </div>

        <div class="form-group">
            <label for="VersionLog">Version du logiciel</label>
            <input type="text" name="VersionLog" id="VersionLog" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="TypLicLog">Type de licence</label>
            <select name="TypLicLog" id="TypLicLog" class="form-control">
                <option value="Libre">Logiciel Libre (Open Source)</option>
                <option value="Propriétaire">Logiciel Propriétaire</option>
                <option value="Gratuiciel">Logiciel Gratuiciel</option>
                <option value="SaaS">Licence Saas</option>
                <option value="Réseau">Licence Réseau</option>
            </select>
        </div>
        <div class="form-group">
            <label for="NbrLicLog">Nombre de licence</label>
            <input type="number" name="NbrLicLog" id="NbrLicLog" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="NbrMinLicLog">Nombre minimal de licence</label>
            <input type="number" name="NbrMinLicLog" id="NbrMinLicLog" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="CleLicLog">Clé de licence</label>
            <input type="text" name="CleLicLog" id="CleLicLog" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="DatAchLog">Date d'installation</label>
            <input type="date" name="DatAchLog" id="DatAchLog" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="DatExpLog">Date d'expiration de Licence</label>
            <input type="date" name="DatExpLog" id="DatExpLog" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="IdFour">Fournisseur</label>
            <select class="form-select" id="IdFour" name="IdFour" required>
                <option value="" disabled selected>-- Sélectionnez le fournisseur --</option>
                @foreach ($fournisseurs as $fournisseur)
                    <option value="{{ $fournisseur->IdFour }}">{{ $fournisseur->NomFour }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ComtAct">Commentaire</label>
            <textarea name="ComtAct" id="ComtAct" class="form-control" ></textarea>
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
