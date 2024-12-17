@extends('layouts.app')


<!--section de css spécifique au main-content-->
@section('custom-css-add')
    <!--css pour les formulaires-->
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection




<!-- section du titre du document -->
@section('title')
Fournisseur des actifs
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
    <li><a href="#fournisseur" class="active"><i class="bi bi-truck"></i>Fournisseur</a></li>
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
            <h2>Formulaire du fournisseur</h2>
        </div>
        <div class="icon-back">
            <i class="bi bi-arrow-left-circle"></i>
        </div>
    </div>
    <!--le formulaire-->
    <form action="" method="post" class="content-form">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" id="IdFour" placeholder="L'identifiant du fournisseur" aria-label="L'identifiant du fournisseur" name="id_four" required="required">
            </div>
            <div class="col">
                <input type="text" class="form-control" id="NomFour" placeholder="Nom du fournisseur" aria-label="Nom du fournisseur" name="nom_four" required="required">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="text" class="form-control" id="ContFour" placeholder="Contact du fournisseur" aria-label="Contact du fournisseur" name="contact_four">
            </div>
            <div class="col">
                <input type="email" class="form-control" id="EmailFour" placeholder="L'adresse mail du fournisseur" aria-label="L'adresse mail du fournisseur" name="email_four">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="text" class="form-control" id="AdressFour" placeholder="Adresse du fournisseur (emplacement)" aria-label="Adresse du fournisseur (emplacement)" name="adress_local_four">
            </div>
            <div class="col">
                <input type="text" class="form-control" id="NomPersCont" placeholder="Nom du personnel contacté" aria-label="Nom du personnel contacté" name="nom_personnel_contacte">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <select class="form-select" id="TypProdFournit" required="required" name="type_produit_fournit">
                    <option selected>Type de produit fournit</option>
                    <option value="matériel">Actif matériel</option>
                    <option value="logiciel">Actif logiciel</option>
                </select>
            </div>
            <div class="col">
                <textarea  id="NotesFour" class="form-control" rows="1" cols="50" placeholder="Avez-vous une note sur le fournisseur?" name="Note_four"></textarea>
            </div>
        </div>

        <!--fin du formulaire-->
        <div class="button-form">
            <button type="submit" name="valider" id="valider" class="btn btn-primary">Valider </button>
        </div>
    </form>

</div>



@endsection
