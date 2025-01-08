@extends('layouts.app')

@section('title', 'Modifier un employé')

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
    <h2>Modifier un utilisateur-Employé</h2>
    <a href="{{ route('User_Employe.index') }}" class="btn btn-secondary">Retour à la liste des utilisateurs</a>
</div>

<div class="form-container">
    <form action="{{ route('donnees.update', $employes->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="IdAct" class="form-label">ID Actif</label>
            <input type="text" class="form-control" id="IdAct" name="IdAct" value="{{ $employes->IdAct }}" required>
        </div>
        <div class="mb-3">
            <label for="FormatData" class="form-label">Format</label>
            <input type="text" class="form-control" id="FormatData" name="FormatData" value="{{ $employes->FormatData }}" required>
        </div>
        <div class="mb-3">
            <label for="SourceData" class="form-label">Source</label>
            <input type="text" class="form-control" id="SourceData" name="SourceData" value="{{ $employes->SourceData }}" required>
        </div>
        <!-- Ajoutez les autres champs ici -->
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>


@endsection
