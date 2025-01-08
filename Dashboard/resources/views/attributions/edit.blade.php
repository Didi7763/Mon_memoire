@extends('layouts.app')

@section('title', 'Modifier une attribution')

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

    .btn-add {
        padding: 0.5vh 1vw;
        display: flex;
        align-items: center;
        gap: 0.5vw;
    }

    .form-container {
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('main-content')
<div class="header-container">
    <h2>Modifier une attribution</h2>
    <a href="{{ route('attributions.index') }}" class="btn btn-secondary">Retour à la liste des attributions</a>
</div>

<div class="form-container">
    <form action="{{ route('attributions.update', $attributions->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="IdAct" class="form-label">Actif</label>
            <select class="form-select" name="IdAct" id="IdAct" required>
                <option value="" disabled {{ old('IdAct', $attributions->IdAct) == null ? 'selected' : '' }}>Choisir un Actif</option>
                @foreach($actifs as $actif)
                    <option value="{{ $actif->IdAct }}" {{ old('IdAct', $attributions->IdAct) == $actif->IdAct ? 'selected' : '' }}>
                        {{ $actif->NomAct }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="CodeUser" class="form-label">Utilisateur</label>
            <select class="form-select" name="CodeUser" id="CodeUser" required>
                <option value="" disabled {{ old('CodeUser', $attributions->CodeUser) == null ? 'selected' : '' }}>Choisir un Utilisateur</option>
                @foreach($utilisateurs as $utilisateur)
                    <option value="{{ $utilisateur->CodeUser }}" {{ old('CodeUser', $attributions->CodeUser) == $utilisateur->CodeUser ? 'selected' : '' }}>
                        {{ $utilisateur->NomUser }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="NumAdmin" class="form-label">Admin</label>
            <select class="form-select" name="NumAdmin" id="NumAdmin" required>
                <option value="" disabled {{ old('NumAdmin', $attributions->NumAdmin) == null ? 'selected' : '' }}>Choisir un Admin</option>
                @foreach($admins as $admin)
                    <option value="{{ $admin->NumAdmin }}" {{ old('NumAdmin', $attributions->NumAdmin) == $admin->NumAdmin ? 'selected' : '' }}>
                        {{ $admin->NomAdmin }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="DatAttAct" class="form-label">Date d'attribution</label>
            <input type="date" class="form-control" id="DatAttAct" name="DatAttAct" value="{{ old('DatAttAct', $attributions->DatAttAct) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
