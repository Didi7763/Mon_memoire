@extends('layouts.app')


<!--section de css spécifique au main-content-->
@section('custom-css-add')
    <!--css pour les formulaires-->
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection




<!-- section du titre du document -->
@section('title')
Actifs Matériels
@endsection





<!--section du sidebar du doucument-->
@section('sidebar')
<ul>
    <li> <a href="#tableau de bord" ><i class="bi bi-speedometer2"></i>Tableau de bord</a></li>
    <li class="has-submenu"><a href="#actifs" class="active"><i class="bi bi-display"></i>Actifs</a>
        <ul class="submenu">
            <li><a class="dropdown-item " href="#"><i class="bi bi-database"></i>Actifs de données</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-terminal"></i>Actif logiciel</a></li>
            <li><a class="dropdown-item active" href="#"><i class="bi bi-cpu"></i>Actif matériel</a></li>
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
                <h2>Formulaire d'actif matériel</h2>
            </div>
            <div class="icon-back">
                <i class="bi bi-arrow-left-circle"></i>
            </div>
        </div>
        <!--le formulaire-->
        <form action="" method="post" class="content-form">
            <div class="row">
                <div class="col">
                  <input type="text" class="form-control" id="IdAct" placeholder="Identifiant de l'actif matériel" aria-label="Identifiant de l'actif matériel" name="idact_mat" required="required">
                </div>
                <div class="col">
                  <input type="text" class="form-control" id="NomAct" placeholder="Nom de matériel" aria-label="Nom du matériel" name="nom_mat" required="required">
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" id="MarqMat" placeholder="Marque du matériel" aria-label="Marque du materiel" name="marq_mat">
                </div>
                <div class="col">
                  <input type="text" class="form-control" id="ModMat" placeholder="Modèle du matériel" aria-label="Modèle du matériel" name="modèle_mat">
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" id="IdAct" placeholder="Numéro de serie" aria-label="Numéro de serie" name="numserie_mat" required="required">
                </div>
                <div class="col">
                  <input type="number" class="form-control" id="QteMat" placeholder="Quantité du matériel" aria-label="Quantité du matériel" name="qte_mat">
                </div>
              </div>

              <div class="row">
                <div class="col">
                    <select  class="form-select" id="RefCatMat" required="required" name="cat_mat">
                        <option selected>Identifier la catégorie du matériel...</option>
                        <option>...</option>
                    </select>
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
                    <select  class="form-select" id="StatMat" required="required" name="satut_mat">
                        <option selected>Statut du matériel...</option>
                        <option value="En stock">En stock</option>
                        <option value="Affecté">En cours d'utilisation</option>
                        <option value="panne">En panne</option>
                        <option value="reparation">En maintenace</option>
                        <option value="Réformé">Réformé</option>
                    </select>
                </div>
                <div class="col">
                    <input type="number" id="DureVieMat" class="form-control" placeholder="Mentionnez la durée de vie en moyenne du matériel (en année)" aria-label="Mentionnez la durée de vie en moyenne du matériel (en année)" name="duree_mat" required="required">
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label for="title-date1">Date d'acquisition du Matériel</label>
                  <input type="date" id="DatAchMat" class="form-control"  name=datach_mat" required="required">
                </div>
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
