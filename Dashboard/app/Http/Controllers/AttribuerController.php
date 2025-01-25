<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribuer; // Modèle pour gérer la table des attributions
use App\Models\Actif; // Modèle pour gérer la table des actifs
use App\Models\Utilisateur; // Modèle pour gérer la table des utilisateurs
use App\Models\User; // Modèle pour gérer la table des administrateurs
use App\Models\Historique;
use App\Models\Categorie;
use App\Models\Logiciel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttribuerController extends Controller
{
    /**
     * Afficher la liste des attributions.
     * Cette méthode récupère toutes les attributions avec leurs relations
     * (actifs, utilisateurs et administrateurs) et les passe à la vue.
     */public function index()
{
    // Chargez les attributions avec leurs relations et paginez
    $attributions = Attribuer::with(['actif', 'utilisateur', 'user'])->paginate(15);

    return view('attributions.index', compact('attributions'));
}



    public function create()
    {
        $actifs = Actif::all();
        $utilisateurs = Utilisateur::all();
        $users = user::all();
        return view('attributions.create', compact('actifs', 'utilisateurs', 'users'));
    }


    public function store(Request $request)
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Valider les données du formulaire
    $validated = $request->validate([
        'IdAct' => 'required|exists:actifs,IdAct',
        'CodeUser' => 'required|exists:utilisateurs,CodeUser',
        'DatAttAct' => 'required|date',
    ]);

    // Créer une nouvelle attribution avec les données validées
    $attribuer = new Attribuer();
    $attribuer->IdAct = $validated['IdAct'];
    $attribuer->CodeUser = $validated['CodeUser'];
    $attribuer->NumAdmin = $user->id; // Utiliser l'ID de l'utilisateur connecté
    $attribuer->DatAttAct = $validated['DatAttAct'];
    $attribuer->save();

    // Récupérer l'actif attribué
    $actif = Actif::find($validated['IdAct']);

    // Récupérer l'utilisateur
    $utilisateur = Utilisateur::find($validated['CodeUser']);

    // Vérifier si l'actif est un matériel ou un logiciel
    if ($actif->type === 'matériel') {
        // Récupérer la catégorie du matériel
        $categorie = Categorie::find($actif->IdAct);

        // Diminuer la quantité en stock de 1
        if ($categorie) {
            $categorie->QteStockMat -= 1;
            $categorie->save();
        }
    } elseif ($actif->type === 'logiciel') {
        // Récupérer le logiciel
        $logiciel = Logiciel::find($actif->IdAct);

        // Diminuer le nombre de licences de 1
        if ($logiciel) {
            $logiciel->NbrLicLog -= 1;
            $logiciel->save();
        }
    }

    // Création de l'historique
    $historique = new Historique();
    $historique->DatAction = now();
    $historique->IdAct = $validated['IdAct'];
    $historique->DesAction = "L'actif " . $actif->NomAct . " a été attribué le " . now() . " par " . $user->name . " à " . $utilisateur->NomCompUser;
    $historique->save();

    // Rediriger vers la liste des attributions avec un message de succès
    return redirect()->route('attributions.index')->with('success', 'Attribution ajoutée avec succès!');
}
}
