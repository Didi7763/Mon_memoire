<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    // Afficher la liste des employés
    public function index()
    {
        $categorie_materiels = Categorie::paginate(10); // Pagination pour limiter les résultats
        return view('categorie.index', compact('categorie_materiels')); // Utilisation de la variable correcte
    }


    // Afficher le formulaire de création
    public function create()
    {
        return view('categorie.create');
    }

    // Enregistrer un nouvel employé
    public function store(Request $request)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'RefCatMat' => 'required|string|max:255', // Clé primaire de categorie
            'NomCatMat' => 'required|string|max:255',
            'QteMinStockMat' => 'required|integer',
            'NoteCatMat' => 'required|string|max:255',
        ]);

        // Créer un nouvel employé
        Categorie::create([
            'RefCatMat' => $validated['RefCatMat'],
            'NomCatMat' => $validated['NomCatMat'],
            'QteMinStockMat' => $validated['QteMinStockMat'],
            'NoteCatMat' => $validated['NoteCatMat'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('categorie.index')->with('success', 'Catégorie matériel ajouté avec succès.');
    }


    public function edit($RefCatMat)
    {
        $categorie_materiels = Categorie::findOrFail($RefCatMat);
        return view('categorie.edit', compact('categorie_materiels'));
    }



    // Mettre à jour un employé existant
    public function update(Request $request, Categorie $categorie)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'RefCatMat' => 'required|string|max:255', // Clé primaire de categorie
            'NomCatMat' => 'required|string|max:255',
            'QteStockMat' => 'required|integer',
            'QteMinStockMat' => 'required|integer',
            'NoteCatMat' => 'required|string|max:255',
        ]);

        // Mettre à jour l'employé
        $categorie->update([
           'RefCatMat' => $validated['RefCatMat'],
            'NomCatMat' => $validated['NomCatMat'],
            'QteStockMat' => $validated['QteStockMat'],
            'QteMinStockMat' => $validated['QteMinStockMat'],
            'NoteCatMat' => $validated['NoteCatMat'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('categorie.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    // Supprimer un employé
    public function destroy(Categorie $categorie)
    {
        // Supprimer l'employé
        $categorie->delete();

        // Rediriger avec un message de succès
        return redirect()->route('categorie.index')->with('success', 'Catégorie supprimé avec succès.');
    }
}
