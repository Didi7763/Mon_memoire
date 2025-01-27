@extends('layouts.app')

@section('main-content')
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Résultats de la recherche pour "{{ $query }}"</h1>

        <!-- Résultats des actifs -->
        @if($actifs->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">Actifs</h2>
                <ul class="space-y-2">
                    @foreach($actifs as $actif)
                        <li class="p-2 bg-white shadow rounded-lg">
                            <a href="{{ route('actifs.show', $actif->IdAct) }}" class="text-blue-500 hover:underline">
                                {{ $actif->NomAct }} ({{ $actif->IdAct }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Résultats des employés -->
        @if($employes->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">Employés</h2>
                <ul class="space-y-2">
                    @foreach($employes as $employe)
                        <li class="p-2 bg-white shadow rounded-lg">
                            <a href="{{ route('employes.show', $employe->id) }}" class="text-blue-500 hover:underline">
                                {{ $employe->CodeUser1 }} - {{ $employe->FonctEmp }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Résultats des services -->
        @if($services->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">Services</h2>
                <ul class="space-y-2">
                    @foreach($services as $service)
                        <li class="p-2 bg-white shadow rounded-lg">
                            <a href="{{ route('services.show', $service->id) }}" class="text-blue-500 hover:underline">
                                {{ $service->DesServ }} - {{ $service->NpnomRespServ }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Résultats des logiciels -->
        @if($logiciels->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">Logiciels</h2>
                <ul class="space-y-2">
                    @foreach($logiciels as $logiciel)
                        <li class="p-2 bg-white shadow rounded-lg">
                            <a href="{{ route('logiciel.show', $logiciel->id) }}" class="text-blue-500 hover:underline">
                                {{ $logiciel->VersionLog }} - {{ $logiciel->TypLicLog }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Résultats des matériels -->
        @if($materiels->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">Matériels</h2>
                <ul class="space-y-2">
                    @foreach($materiels as $materiel)
                        <li class="p-2 bg-white shadow rounded-lg">
                            <a href="{{ route('materiel.show', $materiel->id) }}" class="text-blue-500 hover:underline">
                                {{ $materiel->MarqMat }} - {{ $materiel->ModMarq }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Résultats des fournisseurs -->
        @if($fournisseurs->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">Fournisseurs</h2>
                <ul class="space-y-2">
                    @foreach($fournisseurs as $fournisseur)
                        <li class="p-2 bg-white shadow rounded-lg">
                            <a href="{{ route('fournisseurs.show', $fournisseur->IdFour) }}" class="text-blue-500 hover:underline">
                                {{ $fournisseur->NomFour }} - {{ $fournisseur->EmailFour }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Aucun résultat -->
        @if($actifs->count() == 0 && $employes->count() == 0 && $services->count() == 0 && $logiciels->count() == 0 && $materiels->count() == 0 && $fournisseurs->count() == 0)
            <p class="text-gray-500">Aucun résultat trouvé.</p>
        @endif
    </div>
@endsection