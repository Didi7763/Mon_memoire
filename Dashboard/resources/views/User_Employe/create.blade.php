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
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('main-content')
<div class="header-container">
    <h2>Formulaire d'utilisateur Employé</h2>
    <a href="{{ route('User_Employe.index') }}" class="btn btn-secondary">Retour à la liste des employés</a>
</div>

<div class="form-container">
    <form action="{{ route('User_Employe.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="CodeUser1">Code</label>
            <input type="text" name="CodeUser1" id="CodeUser1" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="NomCompUser">Nom et Prénoms</label>
            <input type="text" name="NomCompUser" id="NomCompUser" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ContactUser">Contact</label>
            <input type="tel" name="ContactUser" id="ContactUser" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="EmailUser">Email</label>
            <input type="email" name="EmailUser" id="EmailUser" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="FonctEmp">Fonction</label>
            <input type="text" name="FonctEmp" id="FonctEmp" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="StatEmp">Statut</label>
            <select name="StatEmp" id="StatEmp" class="form-control" required>
                <option value="" disabled selected>-- Sélectionner le statut de l'employé --</option>
                <option value="En activité">En activité</option>
                <option value="En congé">En congé</option>
                <option value="Suspendu">Suspendu</option>
                <option value="En formation">En formation</option>
                <option value="Retraité">Retraité</option>
                <option value="Fin contrat">Fin de contrat</option>
            </select>
        </div>
        <div class="form-group">
            <label for="CodeUser">Service</label>
            <select class="form-select" id="CodeUser" name="CodeUser" required>
                <option value="" disabled selected>-- Sélectionnez le service --</option>
                @foreach ($services as $service)
                    <option value="{{ $service->CodeUser }}">{{ $service->utilisateur->NomCompUser }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ListActif">Liste d'actifs obligatoires</label>
            <textarea name="ListActif" id="ListActif" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Ajouter</button>

        @if ($errors->any())
        <div class="alert alert-danger mt-3">
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
