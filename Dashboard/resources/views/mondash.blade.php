@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2 bg-light">
        <nav class="nav flex-column">
            <a class="nav-link" href="{{ route('mondash') }}">Tableau de bord</a>
            <a class="nav-link active" href="{{ route('actifs') }}">Actifs</a>
            <a class="nav-link" href="{{ route('utilisateurs') }}">Utilisateurs</a>
        </nav>
    </div>
    <div class="col-10">
        <h1>Gestion des Actifs</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Exemple d'Actif</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Modifier</button>
                        <button class="btn btn-sm btn-danger">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-success">Ajouter un Actif</button>
    </div>
</div>
@endsection
