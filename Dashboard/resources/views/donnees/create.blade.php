@extends('layouts.app')

@section('title', 'Ajouter un Actif de Données')

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
    <h2>Formulaire d'actif de données</h2>
    <a href="{{ route('donnees.index') }}" class="btn btn-secondary">Retour à la liste des données</a>
</div>

<div class="form-container">
    <form action="{{ route('donnees.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="IdAct" class="form-label">ID Actif</label>
            <input type="text" class="form-control" id="IdAct" name="IdAct" required>
        </div>

        <div class="mb-3">
            <label for="NomAct" class="form-label">Nom de l'actif</label>
            <input type="text" class="form-control" id="NomAct" name="NomAct" required>
        </div>

        <div class="mb-3">
            <label for="FormatData" class="form-label">Format de la donnée</label>
            <input type="text" class="form-control" id="FormatData" name="FormatData" required>
        </div>

        <div class="mb-3">
            <label for="SourceData" class="form-label">Source de la donnée</label>
            <input type="text" class="form-control" id="SourceData" name="SourceData" required>
        </div>


        <div class="mb-3">
            <label for="ResponsableData" class="form-label">Responsable</label>
            <input type="text" class="form-control" id="ResponsableData" name="ResponsableData" required>
        </div>

        <div class="mb-3">
            <label for="NivSensData" class="form-label">Niveaux de sensibilité</label>
            <select class="form-select" id="NivSensData" required="required" name="NivSensData">
                <option selected>Choix du niveaux</option>
                <option value="Public">Donnée publique</option>
                <option value="Interne">Donnée Interne</option>
                <option value="Confidentiel">Donnée confidentielle</option>
                <option value="Discrets">Donnée discrettes</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="StatData" class="form-label">Statut</label>
            <select class="form-select" id="StatData" required="required" name="StatData">
                <option selected>Selectionne le statut</option>
                <option value="en création">Donnée en création</option>
                <option value="active">Donnée active</option>
                <option value="stockée">Donnée stockée</option>
                <option value="obsolète">Donnée obsolète</option>
                <option value="supprimée">Donnée supprimée</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ComtAct">Commentaire</label>
            <textarea name="ComtAct" id="ComtAct" class="form-control" ></textarea>
        </div>


        <!-- Ajoutez les autres champs ici -->
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>


@endsection
