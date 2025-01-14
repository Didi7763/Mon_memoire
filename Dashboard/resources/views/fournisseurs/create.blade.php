<!-- resources/views/materiels/create.blade.php -->
@extends('layouts.app')

@section('title', 'Ajouter un fournisseur')

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
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        max-height: 70dvh;
        overflow: auto;
    }
    .btn-primary{
        margin: 1vh 0;
    }

</style>
@endsection

@section('main-content')
<div class="header-container">
    <h2>Formulaire de fournisseur</h2>
    <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">Retour à la liste des fournisseurs</a>
</div>

<div class="form-container">
    <form action="{{ route('fournisseurs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="IdFour">Identifiant</label>
            <input type="text" class="form-control" name="IdFour" id="IdFour"  required>
        </div>
        <div class="form-group">
            <label for="NomFour">Nom du fournisseur</label>
            <input type="text" class="form-control" name="NomFour" id="NomFour"  required>
        </div>
        <div class="form-group">
            <label for="ContFour">Contact</label>
            <input type="text" class="form-control" name="ContFour" id="ContFour"  required>
        </div>
        <div class="form-group">
            <label for="EmailFour">Email</label>
            <input type="email" class="form-control" name="EmailFour" id="EmailFour"  required>
        </div>
        <div class="form-group">
            <label for="AdressFour">Adresse local</label>
            <input type="text" class="form-control" name="AdressFour" id="AdressFour"  required>
        </div>
        <div class="form-group">
            <label for="NomPersCont">Nom du personnel</label>
            <input type="text" class="form-control" name="NomPersCont" id="NomPersCont"  required>
        </div>
        <div class="form-group">
            <label for="TypProdFournit">Type de produit</label>
            <select name="TypProdFournit" class="form-select" id="TypProdFournit" required>
                <option value="" disabled selected>Type Produit</option>
                <option value="matériel">Matériel</option>
                <option value="logiciel">Logiciel</option>
            </select>
        </div>
        <div class="form-group">
            <label for="NotesFour">Commentaire</label>
            <textarea name="NotesFour" id="NotesFour" class="form-control" ></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Ajouter</button>
        @if ($errors->any())
        <div class="alert alert-danger">
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
