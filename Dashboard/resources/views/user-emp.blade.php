@extends('layouts.app')


<!--section de css spécifique au main-content-->
@section('custom-css-add')
    <!--css pour les formulaires-->
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection




<!-- section du titre du document -->
@section('title')
utilisateurs des actifs
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
    <li class="has-submenu"><a href="#utilisateur" class="active"><i class="bi bi-person"></i>Utilisateur</a>
        <ul class="submenu">
            <li><a class="dropdown-item active" href="#"><i class="bi bi-person-badge"></i>Employé</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i>Service</a></li>
        </ul>
    </li>
    <li><a href="#fournisseur"><i class="bi bi-truck"></i>Fournisseur</a></li>
    <li><a href="#attribution"><i class="bi bi-award"></i>Attribution</a></li>
    <li><a href="#maintenance"><i class="bi bi-tools"></i>Maintenance</a></li>
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
                <h2>Formulaire des utilisateurs (employés)</h2>
            </div>
            <div class="icon-back">
                <i class="bi bi-arrow-left-circle"></i>
            </div>
        </div>
        <!--le formulaire-->
        <form action="" method="post" class="content-form">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id="CodeUser" placeholder="Code de l'utilisateur" aria-label="Code de l'utilisateur" name="code_user" required="required">
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="NomCompUser" placeholder="Nom et prénoms" aria-label="Nom et prénoms" name="npnom_user" required="required">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id="ContactUser" placeholder="Contact de l'utilisateur" aria-label="Contact de l'utilisateur" name="contact_user">
                </div>
                <div class="col">
                    <input type="email" class="form-control" id="EmailUser" placeholder=" L'adresse mail de l'utilisateur" aria-label="L'adresse mail de l'utilsateur" name="email_user">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id="FonctionEmp" placeholder="Fonction de l'utilisateur" aria-label="Fonction de l'utilisateur" name="fonction_user">
                </div>
                <div class="col">
                    <select class="form-select" id="StatEmp" required="required" name="statut_user">
                        <option selected>Statut de l'utilisateur</option>
                        <option value="actif">Actif</option>
                        <option value="en congé">En congé</option>
                        <option value="suspendu">Suspendu</option>
                        <option value="retraité">Retraité</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <select class="form-select" id="CodeUser" required="required" name="Code_user_service">
                        <option selected>Le service de l'utilisateur</option>
                        <option value="">...</option>
                    </select>
                </div>
                <div class="col">
                    <div class="col">
                        <textarea  id="ListAct" class="form-control" rows="1" cols="50" placeholder="listez les actifs ayant droits de l'utilsateur" name="liste_actif"></textarea>
                    </div>
                </div>
            </div>

            <!--fin du formulaire-->
            <div class="button-form">
                <button type="submit" name="valider" id="valider" class="btn btn-primary">Valider </button>
            </div>
        </form>

    </div>

@endsection
