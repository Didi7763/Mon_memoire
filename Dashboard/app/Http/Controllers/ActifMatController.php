<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActifMatController extends Controller
{
    // Affiche le formulaire
    public function create()
    {
        return view('actif.create'); // Assurez-vous que le chemin de la vue est correct
    }

    // Traite le formulaire
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'idact_mat' => 'required|string|max:255',
            'nom_mat' => 'required|string|max:255',
            'marq_mat' => 'nullable|string|max:255',
            'modèle_mat' => 'nullable|string|max:255',
            'numserie_mat' => 'required|string|max:255',
            'qte_mat' => 'nullable|integer',
            'cat_mat' => 'required|string|max:255',
            'nom_four' => 'required|string|max:255',
            'satut_mat' => 'required|string|max:255',
            'duree_mat' => 'required|integer',
            'datach_mat' => 'required|date',
            'commentaire_mat' => 'nullable|string|max:500',
        ]);

        // Sauvegarder ou traiter les données du formulaire
        // Exemple : Création d'un nouveau modèle ActifMat (assurez-vous de créer ce modèle)
        // ActifMat::create($request->all());

        // Redirection ou réponse après soumission
        return redirect()->route('actif.create')->with('status', 'Actif matériel ajouté avec succès!');
    }
}

