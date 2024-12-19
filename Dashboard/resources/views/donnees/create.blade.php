@extends('layouts.app')

@section('title', 'Ajouter un Actif de Données')

@section('main-content')
<div class="container">
    <h2>Ajouter un Actif de Données</h2>
    <form action="{{ route('donnees.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="IdAct" class="form-label">ID Actif</label>
            <input type="text" class="form-control" id="IdAct" name="IdAct" required>
        </div>
        <div class="mb-3">
            <label for="FormatData" class="form-label">Format</label>
            <input type="text" class="form-control" id="FormatData" name="FormatData" required>
        </div>
        <div class="mb-3">
            <label for="SourceData" class="form-label">Source</label>
            <input type="text" class="form-control" id="SourceData" name="SourceData" required>
        </div>
        <!-- Ajoutez les autres champs ici -->
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
