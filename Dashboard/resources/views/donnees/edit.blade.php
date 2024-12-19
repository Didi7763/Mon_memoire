@extends('layouts.app')

@section('title', 'Modifier un Actif de Données')

@section('main-content')
<div class="container">
    <h2>Modifier un Actif de Données</h2>
    <form action="{{ route('donnees.update', $donnee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="IdAct" class="form-label">ID Actif</label>
            <input type="text" class="form-control" id="IdAct" name="IdAct" value="{{ $donnee->IdAct }}" required>
        </div>
        <div class="mb-3">
            <label for="FormatData" class="form-label">Format</label>
            <input type="text" class="form-control" id="FormatData" name="FormatData" value="{{ $donnee->FormatData }}" required>
        </div>
        <div class="mb-3">
            <label for="SourceData" class="form-label">Source</label>
            <input type="text" class="form-control" id="SourceData" name="SourceData" value="{{ $donnee->SourceData }}" required>
        </div>
        <!-- Ajoutez les autres champs ici -->
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
