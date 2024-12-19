@extends('layouts.app')

@section('title', 'Ajouter une Attribution')

@section('main-content')
<div class="container">
    <h2 class="my-4">Ajouter une Attribution</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attributions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="IdAct" class="form-label">Actif</label>
            <select class="form-select" name="IdAct" id="IdAct" required>
                <option value="" disabled selected>Choisir un Actif</option>
                @foreach($actifs as $actif)
                    <option value="{{ $actif->IdAct }}">{{ $actif->NomAct }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="CodeUser" class="form-label">Utilisateur</label>
            <select class="form-select" name="CodeUser" id="CodeUser" required>
                <option value="" disabled selected>Choisir un Utilisateur</option>
                @foreach($utilisateurs as $utilisateur)
                    <option value="{{ $utilisateur->CodeUser }}">{{ $utilisateur->NomUser }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="NumAdmin" class="form-label">Admin</label>
            <select class="form-select" name="NumAdmin" id="NumAdmin" required>
                <option value="" disabled selected>Choisir un Admin</option>
                @foreach($admins as $admin)
                    <option value="{{ $admin->NumAdmin }}">{{ $admin->NomAdmin }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="DatAttAct" class="form-label">Date d'Attribution</label>
            <input type="date" class="form-control" name="DatAttAct" id="DatAttAct" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
