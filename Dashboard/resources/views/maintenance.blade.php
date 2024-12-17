@extends('layouts.app')


<!--section de css spécifique au main-content-->
@section('custom-css-add')
    <!--css pour les formulaires-->
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection




<!-- section du titre du document -->
@section('title')
Maintenance des actifs
@endsection





<!--section du sidebar du doucument-->
@section('sidebar')
<ul>
    <li> <a href="#tableau de bord" ><i class="bi bi-speedometer2"></i>Tableau de bord</a></li>
    <li class="has-submenu"><a href="#actifs" ><i class="bi bi-display"></i>Actifs</a>
        <ul class="submenu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-database"></i>Actifs de données</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-terminal"></i>Actif logiciel</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-cpu"></i>Actif matériel</a></li>
        </ul>
    </li>
    <li class="has-submenu"><a href="#utilisateur" ><i class="bi bi-person"></i>Utilisateur</a>
        <ul class="submenu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-person-badge"></i>Employé</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i>Service</a></li>
        </ul>
    </li>
    <li><a href="#fournisseur"><i class="bi bi-truck"></i>Fournisseur</a></li>
    <li><a href="#attribution"><i class="bi bi-award"></i>Attribution</a></li>
    <li><a href="#maintenance" class="active"><i class="bi bi-tools"></i>Maintenance</a></li>
    <li><a href="#historique"><i class="bi bi-clock-history"></i>Historique</a></li>
    <li class="has-submenu"><a href="#compte"><i class="bi bi-person-circle"></i>Compte</a>
        <ul class="submenu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-person-plus"></i>Nouveau Compte</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-person-lines-fill"></i>Mon Profil</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i>Déconnexion</a></li>
        </ul>
    </li>
</ul>
@endsection




<!-- la section du main-content -->
@section('main-content')
                <!--cadre du formulaire-->
                <div class="card-form">
                    <!--titre du formulaire-->
                    <div class="head-form">
                        <div class="title-form">
                            <h2>Formulaire de maintenance</h2>
                        </div>
                        <div class="icon-back">
                            <i class="bi bi-arrow-left-circle"></i>
                        </div>
                    </div>
                    <!--le formulaire-->
                    <form action="" method="post" class="content-form">

                        <!-- L'id de maintenance s'auto-incréménte -->

                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="DesMaint" placeholder="Description de la maintenance" aria-label="Description de la maintenance" name="Descript_maint" required="required">
                            </div>
                            <div class="col">
                                <select class="form-select" id="TypMaint" required="required" name="type_maintenance">
                                    <option selected>Type de produit effectué</option>
                                    <option value="corrective">Maintenance corrective</option>
                                    <option value="préventive">Maintenance préventive</option>
                                    <option value="prédictive">Maintenance préventive</option>
                                    <option value="curative">Maintenance prédictive</option>
                                    <option value="evolutive">Maintenance evolutive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="NomTechMaint" placeholder="Nom du technicien effectuant la maintenance" aria-label="Nom du technicien effectuant la maintenance" name="nom_tech_maint">
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="CoutMaint" placeholder="Cout de la maintenance" aria-label="Cout de la maintenance" name="cout_maintenace">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="title-date1">Date de maintenance</label>
                                <input type="date" class="form-control" id="DatMaint" placeholder="Date de maintenance" aria-label="Date de maintenance" name="maintenance" required="required">
                            </div>
                            <div class="col">
                                <label for="title-date2">Date de prochaine maintenance</label>
                                <input type="date" class="form-control" id="DatProchMaint" placeholder="Date de prochaine maintenance" aria-label="Date de prochaine maintenance" name="prochain_maintenance_day" required="required">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="IdAct" placeholder="Identifiant de l'actif en maintenance" aria-label="Identifiant de l'actif en maintenance" name="id_maint">
                            </div>
                            <div class="col">
                                <textarea  id="ComtMaint" class="form-control" rows="1" cols="50" placeholder="Avez-vous une note sur la maintenance effectuée?" name="Note_maintenance"></textarea>
                            </div>
                        </div>

                        <!--fin du formulaire-->
                        <div class="button-form">
                            <button type="submit" name="valider" id="valider" class="btn btn-primary">Valider </button>
                        </div>
                    </form>

                </div>
@endsection
