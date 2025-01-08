<?php

namespace App\Http\Controllers;

use App\Models\Materiel; // Assurez-vous d'importer le modèle Materiel
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function index()
    {
        // Ajout d'une virgule manquante dans la fonction view()
        $materiels = Materiel::paginate(10); // Récupère les matériels avec pagination
        return view('materiel.actif-materiel', compact('materiels')); // Correction de la syntaxe pour 'compact'
    }

    public function create()
    {
        return view('materiel.create'); // Vérification du nom de la vue
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'NomAct' => 'required',
            'MarqMat' => 'required',
            'ModMarq' => 'required',
            'NumSerieMat' => 'required',
            'QteMat' => 'required|integer',
            'StatMat' => 'required',
            'DatAcqMat' => 'required|date',
        ]);

        // Création de l'actif matériel
        Materiel::create($validated); // Utilisation des données validées

        // Redirection après l'ajout
        return redirect()->route('materiel.index')->with('success', 'Actif matériel ajouté avec succès');
    }

    public function edit($id)
    {
        // Recherche du matériel par son ID et récupération des données
        $materiel = Materiel::findOrFail($id);
        return view('materiel.edit-materiel', compact('materiels'));
    }

    public function update(Request $request, $id)
    {
        $materiel = Materiel::findOrFail($id);

        // Validation des données
        $validated = $request->validate([
            'NomAct' => 'required',
            'MarqMat' => 'required',
            'ModMarq' => 'required',
            'NumSerieMat' => 'required',
            'QteMat' => 'required|integer',
            'StatMat' => 'required',
            'DatAcqMat' => 'required|date',
        ]);

        // Mise à jour de l'actif matériel
        $materiel->update($validated);

        return redirect()->route('materiel.index')
            ->with('success', 'Actif matériel mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Recherche du matériel par son ID et suppression
        $materiel = Materiel::findOrFail($id);
        $materiel->delete();

        return redirect()->route('materiel.index')
            ->with('success', 'Actif matériel supprimé avec succès.');
    }
}
