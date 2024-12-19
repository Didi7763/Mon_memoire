@extends('layouts.app')

@section('title', 'Détails de l\'Actif de Données')

@section('main-content')
<div class="container">
    <h2>Détails de l'Actif de Données</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID Actif</th>
            <td>{{ $donnee->IdAct }}</td>
        </tr>
        <tr>
            <th>Format</th>
            <td>{{ $donnee->FormatData }}</td>
        </tr>
        <tr>
            <th>Source</th>
            <td>{{ $donnee->SourceData }}</td>
        </tr>
        <tr>
            <th>Responsable</th>
            <td>{{ $donnee->ResponsabeData }}</td>
        </tr>
        <tr>
            <th>Niveau de Sensibilité</th>
            <td>{{ $donnee->NivSensData }}</td>
        </tr>
        <tr>
            <th>Statut</th>
            <td>{{ $donnee->StatData }}</td>
        </tr>
        <tr>
            <th>Date de Réception</th>
            <td>{{ $donnee->DatRecpData }}</td>
        </tr>
        <tr>
            <th>Date de Mise à Jour</th>
            <td>{{ $donnee->DatMajData }}</td>
        </tr>
    </table>

    <a href="{{ route('donnees.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <a href="{{ route('donnees.edit', $donnee->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('donnees.destroy', $donnee->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
    </form>
</div>
@endsection
