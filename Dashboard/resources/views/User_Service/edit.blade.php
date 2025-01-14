@extends('layouts.app')

@section('title', 'Modifier un service')

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
    input[readonly] {
    cursor: not-allowed;
    background-color: #f0f0f0; /* Optionnel : Changer l'apparence pour montrer que c'est non modifiable */
    }
</style>
@endsection

@section('main-content')

<div class="header-container">
    <h2>Modifier un utilisateur-Service</h2>
    <a href="{{ route('User_Service.index') }}" class="btn btn-secondary">Retour à la liste des services</a>
</div>

<div class="form-container">
    <form action="{{ route('User_Service.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="CodeUser">Code</label>
            <input type="text" name="CodeUser" id="CodeUser" class="form-control" value="{{ $service->utilisateur->CodeUser }}" required readonly>
        </div>
        <div class="mb-3">
            <label for="NomCompUser">Nom du service</label>
            <input type="text" name="NomCompUser" id="NomCompUser" class="form-control" value="{{ $service->utilisateur->NomCompUser }}" required>
        </div>
        <div class="mb-3">
            <label for="DesServ">Description</label>
            <input type="text" name="DesServ" id="DesServ" class="form-control" value="{{ $service->DesServ }}" required>
        </div>
        <div class="mb-3">
            <label for="NpnomRespServ">Responsable</label>
            <input type="text" name="NpnomRespServ" id="NpnomRespServ" class="form-control" value="{{ $service->NpnomRespServ }}" required>
        </div>
        <div class="mb-3">
            <label for="ContactUser">Contact</label>
            <input type="tel" name="ContactUser" id="ContactUser" class="form-control" value="{{ $service->utilisateur->ContactUser }}" required>
        </div>
        <div class="mb-3">
            <label for="EmailUser">Email</label>
            <input type="email" name="EmailUser" id="EmailUser" class="form-control" value="{{ $service->utilisateur->EmailUser }}" required>
        </div>

        <!-- Ajoutez les autres champs ici -->
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>


@endsection
