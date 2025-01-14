<!-- resources/views/materiels/create.blade.php -->
@extends('layouts.app')

@section('title', 'Ajouter un Actif Matériel')

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
</style>
@endsection

@section('main-content')
<div class="header-container">
    <h2>Formulaire d'Actif Matériel</h2>
    <a href="{{ route('actif-materiel') }}" class="btn btn-secondary">Retour à la liste des matériels</a>
</div>

<div class="form-container">
    <form action="{{ route('materiel.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="IdAct" class="form-label">ID Actif</label>
            <input type="text" class="form-control" id="IdAct" name="IdAct" required>
        </div>
        <div class="form-group">
            <label for="NomAct">Nom du matériel</label>
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
            <label for="DatAcqMat">Date de reception</label>
            <input type="date" name="DatAcqMat" id="DatAcqMat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="DureVieMat">Durée de vie (en année) </label>
            <input type="number" name="DureVieMat" id="DureVieMat" class="form-control" required>
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
            <label for="RefCatMat">Catégorie</label>
            <select class="form-select" id="RefCatMat" name="RefCatMat" required>
                <option value="" disabled selected>-- Sélectionnez la catégorie --</option>
                @foreach ($categorie_materiels as $categorie)
                    <option value="{{ $categorie->RefCatMat }}">{{ $categorie->NomCatMat }}</option>
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
