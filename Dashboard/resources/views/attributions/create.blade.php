<!-- resources/views/materiels/create.blade.php -->
@extends('layouts.app')

@section('title', 'Attribuer un actif')

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
    <h2>Formulaire d'attriburion</h2>
    <a href="{{ route('attributions.index') }}" class="btn btn-secondary">Retour à la liste des attributions</a>
</div>

<div class="form-container">
    <form action="{{ route('attributions.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="IdAct" class="form-label">Actif</label>
            <select class="form-select" name="IdAct" id="IdAct" required>
                <option value="" disabled selected>Choisir un Actif</option>
                @foreach($actifs as $actif)
                    <option value="{{ $actif->IdAct }}">{{ $actif->NomAct }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="CodeUser" class="form-label">Utilisateur</label>
            <select class="form-select" name="CodeUser" id="CodeUser" required>
                <option value="" disabled selected>Choisir un Utilisateur</option>
                @foreach($utilisateurs as $utilisateur)
                    <option value="{{ $utilisateur->CodeUser }}">{{ $utilisateur->NomUser }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="NumAdmin" class="form-label">Admin</label>
            <select class="form-select" name="NumAdmin" id="NumAdmin" required>
                <option value="" disabled selected>Choisir un Admin</option>
                @foreach($admins as $admin)
                    <option value="{{ $admin->NumAdmin }}">{{ $admin->NomAdmin }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="DatAttAct" class="form-label">Date d'Attribution</label>
            <input type="date" class="form-control" name="DatAttAct" id="DatAttAct" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Ajouter</button>
    </form>
</div>
@endsection
