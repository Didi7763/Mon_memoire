@extends('layouts.app')

@section('title', 'Modifier un fournisseur')

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

    .form-container {
        background: #fff;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        max-height: 70dvh;
        overflow: auto;
    }

    .btn-primary {
        margin: 1vh 0;
    }

    input[readonly] {
        cursor: not-allowed;
        background-color: #f0f0f0;
    }
</style>
@endsection

@section('main-content')

<div class="p-8 overflow-y-auto" style="max-height: calc(100vh - 64px);">
    <!-- Chargeur centré par rapport à #main-content et décalé de 50px vers la droite -->
    <div id="loader" class="flex justify-center items-center h-full w-full" style="position: absolute; top: 50%; left: 57%; transform: translate(calc(50px - 50%), -50%); z-index: 1000;">
        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500"></div>
    </div>

    <!-- Contenu principal (caché initialement) -->
    <div id="main-content" class="relative" style="min-height: 75vh; display: none; opacity: 0;">
        <div class="flex justify-between items-center mb-8 p-4 bg-white rounded-lg shadow-sm min-h-[6rem]">
            <h2 class="text-xl font-bold">Modifier un fournisseur</h2>
            <a href="{{ route('fournisseurs.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                Retour à la liste des fournisseurs
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mt-6 mx-auto w-full">
            <form action="{{ route('fournisseurs.update', $fournisseurs->IdFour ?? '') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Champ 1 : Identifiant -->
                    <div class="mb-4">
                        <label for="IdFour" class="block text-sm font-medium text-gray-700">Identifiant</label>
                        <input type="text" id="IdFour" name="IdFour" value="{{ $fournisseurs->IdFour }}" required readonly
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-100">
                    </div>

                    <!-- Champ 2 : Nom du fournisseur -->
                    <div class="mb-4">
                        <label for="NomFour" class="block text-sm font-medium text-gray-700">Nom du fournisseur</label>
                        <input type="text" id="NomFour" name="NomFour" value="{{ $fournisseurs->NomFour }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 3 : Contact -->
                    <div class="mb-4">
                        <label for="ContFour" class="block text-sm font-medium text-gray-700">Contact</label>
                        <input type="text" id="ContFour" name="ContFour" value="{{ $fournisseurs->ContFour }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 4 : Email -->
                    <div class="mb-4">
                        <label for="EmailFour" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="EmailFour" name="EmailFour" value="{{ $fournisseurs->EmailFour }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 5 : Adresse locale -->
                    <div class="mb-4">
                        <label for="AdressFour" class="block text-sm font-medium text-gray-700">Adresse locale</label>
                        <input type="text" id="AdressFour" name="AdressFour" value="{{ $fournisseurs->AdressFour }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 6 : Nom du personnel -->
                    <div class="mb-4">
                        <label for="NomPersCont" class="block text-sm font-medium text-gray-700">Nom du personnel</label>
                        <input type="text" id="NomPersCont" name="NomPersCont" value="{{ $fournisseurs->NomPersCont }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ 7 : Type de produit -->
                    <div class="mb-4">
                        <label for="TypProdFournit" class="block text-sm font-medium text-gray-700">Type de produit</label>
                        <select id="TypProdFournit" name="TypProdFournit" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled {{ empty($fournisseurs->TypProdFournit) ? 'selected' : '' }}>Type Produit</option>
                            <option value="matériel" {{ old('TypProdFournit', $fournisseurs->TypProdFournit ?? '') === 'matériel' ? 'selected' : '' }}>Matériel</option>
                            <option value="logiciel" {{ old('TypProdFournit', $fournisseurs->TypProdFournit ?? '') === 'logiciel' ? 'selected' : '' }}>Logiciel</option>
                        </select>
                    </div>

                    <!-- Champ 8 : Commentaire (sur une seule ligne) -->
                    <div class="mb-4">
                        <label for="NotesFour" class="block text-sm font-medium text-gray-700">Commentaire</label>
                        <input type="text" id="NotesFour" name="NotesFour" value="{{ old('NotesFour', $fournisseurs->NotesFour ?? '') }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script pour gérer le chargeur -->
<script>
    setTimeout(() => {
        const loader = document.getElementById('loader');
        const mainContent = document.getElementById('main-content');

        // Faire disparaître le chargeur après 3 secondes
        setTimeout(() => {
            loader.style.opacity = '0';
            loader.style.transition = 'opacity 1s';

            // Attendre que le chargeur disparaisse complètement
            setTimeout(() => {
                // Supprimer le chargeur du DOM
                loader.remove();

                // Faire apparaître le contenu principal progressivement
                mainContent.style.display = 'block';
                setTimeout(() => {
                    mainContent.style.opacity = '1';
                    mainContent.style.transition = 'opacity 1s';
                }, 10); // Petit délai pour s'assurer que le display: block est appliqué
            }, 1000); // Attendre 1 seconde pour que le chargeur disparaisse
        }, 3000); // Délai initial avant de commencer la transition
    }, 0); // Démarrer immédiatement
</script>

@endsection
