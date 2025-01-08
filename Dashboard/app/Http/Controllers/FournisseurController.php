<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;

class FournisseurController extends Controller
{
    // Afficher la liste des fournisseurs
        public function index()
    {
        // Récupérer tous les fournisseurs avec pagination
        $fournisseurs = Fournisseur::paginate(10);

        // Passer la variable à la vue
        return view('fournisseurs.index', compact('fournisseurs'));
    }


    // Afficher le formulaire de création
    public function create()
    {
        return view('fournisseurs.create');
    }



    // Ajouter un fournisseur
    public function store(Request $request)
    {
        $request->validate([
            'IdFour' => 'required|unique:fournisseurs,IdFour',
            'NomFour' => 'required|string|max:255',
            'ContFour' => 'required|string|max:255',
            'EmailFour' => 'required|email|max:255',
            'AdressFour' => 'required|string',
            'NomPersCont' => 'required|string|max:255',
            'TypProdFournit' => 'required|string',
            'NotesFour' => 'nullable|string',
        ]);

        Fournisseur::create($request->all());

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur ajouté avec succès!');
    }

    // Afficher le formulaire de modification
    public function edit($IdFour)
    {
        $fournisseurs = Fournisseur::findOrFail($IdFour);
        return view('fournisseurs.edit', compact('fournisseurs'));
    }

    // Mettre à jour un fournisseur existant
    public function update(Request $request, $IdFour)
    {
        $fournisseurs = Fournisseur::findOrFail($IdFour);

        $request->validate([
            'IdFour' => "required|unique:fournisseurs,IdFour,$IdFour",
            'NomFour' => 'required|string|max:255',
            'ContFour' => 'required|string|max:255',
            'EmailFour' => 'required|email|max:255',
            'AdressFour' => 'required|string',
            'NomPersCont' => 'required|string|max:255',
            'TypProdFournit' => 'required|string',
            'NotesFour' => 'nullable|string',
        ]);

        $fournisseurs->update($request->all());

        return redirect()->route('fournisseurs.index')->with('success', 'Le fournisseur a été mis à jour avec succès.');
    }

    // Supprimer un fournisseur
    public function destroy($IdFour)
    {
        $fournisseur = Fournisseur::findOrFail($IdFour);
        $fournisseur->delete();

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur supprimé avec succès.');
    }
}
