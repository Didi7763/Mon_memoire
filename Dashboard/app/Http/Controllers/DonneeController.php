<?php

namespace App\Http\Controllers;

use App\Models\Donnee;
use Illuminate\Http\Request;

class DonneeController extends Controller
{
    // Afficher la liste des actifs de données
    public function index()
    {
        $donnees = Donnee::paginate(10); // Pagination pour limiter les résultats
        return view('donnees.actif-data', compact('donnees'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('donnees.create');
    }

    // Enregistrer un nouvel actif de données
    public function store(Request $request)
    {
        $validated = $request->validate([
            'IdAct' => 'required|string|max:255',
            'FormatData' => 'required|string|max:255',
            'SourceData' => 'required|string|max:255',
            'ResponsabeData' => 'required|string|max:255',
            'NivSensData' => 'required|string|max:50',
            'StatData' => 'required|string|max:50',
            'DatRecpData' => 'required|date',
            'DatMajData' => 'nullable|date',
        ]);

        Donnee::create($validated);
        return redirect()->route('donnees.index')->with('success', 'Actif de données ajouté avec succès.');
    }

    // Afficher le formulaire de modification
    public function edit(Donnee $donnee)
    {
        return view('donnees.edit', compact('donnee'));
    }

    // Mettre à jour un actif de données existant
    public function update(Request $request, Donnee $donnee)
    {
        $validated = $request->validate([
            'IdAct' => 'required|string|max:255',
            'FormatData' => 'required|string|max:255',
            'SourceData' => 'required|string|max:255',
            'ResponsabeData' => 'required|string|max:255',
            'NivSensData' => 'required|string|max:50',
            'StatData' => 'required|string|max:50',
            'DatRecpData' => 'required|date',
            'DatMajData' => 'nullable|date',
        ]);

        $donnee->update($validated);
        return redirect()->route('donnees.index')->with('success', 'Actif de données mis à jour avec succès.');
    }

    // Supprimer un actif de données
    public function destroy(Donnee $donnee)
    {
        $donnee->delete();
        return redirect()->route('donnees.index')->with('success', 'Actif de données supprimé avec succès.');
    }
}
