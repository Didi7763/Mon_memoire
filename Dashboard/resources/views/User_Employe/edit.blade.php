@extends('layouts.app')

@section('title', 'Modifier un employé')

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
    <h2>Modifier un utilisateur-Employé</h2>
    <a href="{{ route('User_Employe.index') }}" class="btn btn-secondary">Retour à la liste des utilisateurs</a>
</div>

<div class="form-container">
    <form action="{{ route('User_Employe.update', $employe->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="CodeUser1">Code</label>
            <input type="text" name="CodeUser1" id="CodeUser1" class="form-control" value="{{ $employe->utilisateur->CodeUser }}" required readonly>
        </div>
        <div class="mb-3">
            <label for="NomCompUser">Nom et Prénoms</label>
            <input type="text" name="NomCompUser" id="NomCompUser" class="form-control" value="{{ $employe->utilisateur->NomCompUser }}" required>
        </div>
        <div class="mb-3">
            <label for="ContactUser">Contact</label>
            <input type="tel" name="ContactUser" id="ContactUser" class="form-control" value="{{ $employe->utilisateur->ContactUser }}" required>
        </div>
        <div class="mb-3">
            <label for="EmailUser">Email</label>
            <input type="email" name="EmailUser" id="EmailUser" class="form-control" value="{{ $employe->utilisateur->EmailUser  }}" required>
        </div>
        <div class="mb-3">
            <label for="FonctEmp">Fonction</label>
            <input type="text" name="FonctEmp" id="FonctEmp" class="form-control" value="{{ $employe->FonctEmp }}" required>
        </div>
        <div class="mb-3">
            <label for="StatEmp">Statut</label>
            <select name="StatEmp" id="StatEmp" class="form-control" required>
                <option value="" disabled {{ empty($employe->StatEmp) ? 'selected' : '' }}>Sélection du statut</option>
                <option value="En activité" {{ $employe->StatEmp === 'En activité' ? 'selected' : '' }}>
                    En activité
                </option>
                <option value="En congé" {{ $employe->StatEmp === 'En congé' ? 'selected' : '' }}>
                    En congé
                </option>
                <option value="Suspendu" {{ $employe->StatEmp === 'Suspendu' ? 'selected' : '' }}>
                    Suspendu
                </option>
                <option value="En formation" {{ $employe->StatEmp === 'En formation' ? 'selected' : '' }}>
                    En formation
                </option>
                <option value="Retraité" {{ $employe->StatEmp === 'Retraité' ? 'selected' : '' }}>
                    Retraité
                </option>
                <option value="Fin contrat" {{ $employe->StatEmp === 'Fin contrat' ? 'selected' : '' }}>
                    Fin de contrat
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label for="CodeUser">Service</label>
            <select class="form-select" id="CodeUser" name="CodeUser" required>
                <option value="" disabled {{ empty($employe->CodeUser) ? 'selected' : '' }}>-- Sélectionnez le service --</option>
                @foreach ($services as $service)
                    <option value="{{ $service->CodeUser }}"
                        {{ $service->CodeUser === $employe->CodeUser ? 'selected' : '' }}>
                        {{ $service->utilisateur->NomCompUser }}
                    </option>
                @endforeach
            </select>

        </div>
        <div class="mb-3">
            <label for="ListActif">Liste d'actifs obligatoires</label>
            <textarea name="ListActif" id="ListActif" class="form-control" rows="2">{{ $employe->ListActif }}</textarea>
        </div>
        <!-- Ajoutez les autres champs ici -->
        <button type="submit" class="btn btn-primary">Enregistrer</button>
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
