@extends('layouts.app')


<!--section de css spécifique au main-content-->
@section('custom-css-add')
     <!--css pour les formulaires-->
     <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection




<!-- section du titre du document -->
@section('title')
Actifs logiciels
@endsection





<!--section du sidebar du doucument-->
@section('sidebar')
<ul>
    <li> <a href="#tableau de bord" ><i class="bi bi-speedometer2"></i>Tableau de bord</a></li>
    <li class="has-submenu"><a href="#actifs" class="active"><i class="bi bi-display"></i>Actifs</a>
        <ul class="submenu">
            <li><a class="dropdown-item " href="#"><i class="bi bi-database"></i>Actifs de données</a></li>
            <li><a class="dropdown-item active" href="#"><i class="bi bi-terminal"></i>Actif logiciel</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-cpu"></i>Actif matériel</a></li>
        </ul>
    </li>
    <li class="has-submenu"><a href="#utilisateur"><i class="bi bi-person"></i>Utilisateur</a>
        <ul class="submenu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-person-badge"></i>Employé</a></li>
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
            <h2>Formulaire d'actif logiciel</h2>
        </div>
        <div class="icon-back">
            <i class="bi bi-arrow-left-circle"></i>
        </div>
    </div>
    <!--le formulaire-->
    <form action="" method="post" class="content-form">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" id="IdAct" placeholder="Identifiant de l'actif logiciel" aria-label="Identifiant de l'actif logiciel" name="idact_log" required="required">
            </div>
            <div class="col">
                <input type="text" class="form-control" id="NomAct" placeholder="Nom du logiciel" aria-label="Nom du logiciel" name="nom_log" required="required">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="text" class="form-control" id="VersionLog" placeholder="Version du logiciel" aria-label="Version du logiciel" name="version_log">
            </div>
            <div class="col">
                <input type="text" class="form-control" id="TypLicLog" placeholder=" Type de licence du logiciel" aria-label="Type de licence du logiciel" name="Type_Licence_Log">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="number" class="form-control" id="NbrLicLog" placeholder="Nombre de licence" aria-label="Nombre de licence" name="Nbre_Lic_Log">
            </div>
            <div class="col">
                <input type="text" class="form-control" id="CleLicLog" placeholder="La clé de la licence" aria-label="La clé de la licence" name="cle_lic_log" required="required">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="col">
                    <input type="number" class="form-control" id="NbrMinLicLog" placeholder="Nombre minimal de licence" aria-label="Nombre minimal de licence" name="Nbre_Min_Lic_Log">
                </div>
            </div>
            <div class="col">
                <select class="form-select" id="IdFour" required="required" name="nom_four">
                    <option selected>Identifier le fournisseur...</option>
                    <option>...</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="title-date1">Date d'achat du logiciel</label>
                <input type="date" id="DatAchLog" class="form-control"  name=datach_log" required="required">
            </div>
            <div class="col">
                <label for="title-date2">Date d'expiration de la licence</label>
                <input type="date" id="DatExpLog" class="form-control"  name=datexp_log" required="required">
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="col">
                    <label for="commentaire">Avez-vous un commentaire sur le matériel?</label>
                    <textarea name="comment_mat" id="ComtMat" class="form-control" rows="1" cols="50" placeholder="Écrivez votre commentaire ici..." name="commentaire_mat"></textarea>
                </div>
        </div>


        <!--fin du formulaire-->
        <div class="button-form">
            <button type="submit" name="valider" id="valider" class="btn btn-primary">Valider </button>
        </div>
    </form>

</div>
@endsection
