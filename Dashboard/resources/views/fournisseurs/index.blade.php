@extends('layouts.app')

@section('title', 'Liste des Fournisseurs')

@section('main-content')
<div class="container">
    <h2 class="my-4">Liste des Fournisseurs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Type Produit</th>
                <th>Nom Contacté</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fournisseurs as $fournisseur)
            <tr>
                <td>{{ $fournisseur->IdFour }}</td>
                <td>{{ $fournisseur->NomFour }}</td>
                <td>{{ $fournisseur->ContFour }}</td>
                <td>{{ $fournisseur->EmailFour }}</td>
                <td>{{ $fournisseur->AdressFour }}</td>
                <td>{{ $fournisseur->TypProdFournit }}</td>
                <td>{{ $fournisseur->NomPersCont }}</td>
                <td>{{ $fournisseur->NotesFour }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="my-4">Ajouter un Fournisseur</h3>
    <form action="{{ route('fournisseurs.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control" name="id_four" placeholder="ID Fournisseur" required>
            </div>
            <div class="col">
                <input type="text" class="form-control" name="nom_four" placeholder="Nom Fournisseur" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control" name="contact_four" placeholder="Contact Fournisseur" required>
            </div>
            <div class="col">
                <input type="email" class="form-control" name="email_four" placeholder="Email Fournisseur" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control" name="adress_local_four" placeholder="Adresse" required>
            </div>
            <div class="col">
                <input type="text" class="form-control" name="nom_personnel_contacte" placeholder="Nom Contacté" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <select name="type_produit_fournit" class="form-select" required>
                    <option value="" disabled selected>Type Produit</option>
                    <option value="matériel">Matériel</option>
                    <option value="logiciel">Logiciel</option>
                </select>
            </div>
            <div class="col">
                <textarea name="Note_four" class="form-control" placeholder="Notes"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
