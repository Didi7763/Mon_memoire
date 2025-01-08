<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribuer; // Modèle pour gérer la table des attributions
use App\Models\Actif; // Modèle pour gérer la table des actifs
use App\Models\Utilisateur; // Modèle pour gérer la table des utilisateurs
use App\Models\Admin; // Modèle pour gérer la table des administrateurs

class AttribuerController extends Controller
{
    /**
     * Afficher la liste des attributions.
     * Cette méthode récupère toutes les attributions avec leurs relations
     * (actifs, utilisateurs et administrateurs) et les passe à la vue.
     */public function index()
{
    // Chargez les attributions avec leurs relations et paginez
    $attributions = Attribuer::with(['actif', 'utilisateur', 'admin'])->paginate(15);

    return view('attributions.index', compact('attributions'));
}



    public function create()
    {
        $actifs = Actif::all();
        $utilisateurs = Utilisateur::all();
        $admins = Admin::all();
        return view('attributions.create', compact('actifs', 'utilisateurs', 'admins'));
    }

     
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'IdAct' => 'required|exists:actifs,IdAct', // L'identifiant de l'actif doit exister dans la table `actifs`
            'CodeUser' => 'required|exists:utilisateurs,CodeUser', // Le code utilisateur doit exister dans la table `utilisateurs`
            'NumAdmin' => 'required|exists:admins,NumAdmin', // Le numéro de l'admin doit exister dans la table `admins`
            'DatAttAct' => 'required|date', // La date doit être une date valide
        ]);

        // Créer une nouvelle attribution avec les données validées
        Attribuer::create($request->all());

        // Rediriger vers la liste des attributions avec un message de succès
        return redirect()->route('attributions.index')->with('success', 'Attribution ajoutée avec succès!');
    }
}
