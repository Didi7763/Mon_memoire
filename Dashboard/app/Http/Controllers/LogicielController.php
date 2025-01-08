<?php

namespace App\Http\Controllers;

use App\Models\Logiciel;
use Illuminate\Http\Request;

class LogicielController extends Controller
{
    /**
     * Affiche la liste des logiciels.
     */
    public function index()
    {
        $logiciels = Logiciel::paginate(10); // Récupère les logiciels avec pagination
        return view('logiciel.actif-logiciel', compact('logiciels'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau logiciel.
     */
    public function create()
    {
        return view('logiciel.create');
    }

    /**
     * Stocke un nouveau logiciel en base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'IdAct' => 'required|unique:logiciels|max:255',
            'VersionLog' => 'required|string|max:255',
            'TypLicLog' => 'required|string|max:255',
            'NbrLicLog' => 'required|integer|min:1',
            'NbrMinLicLog' => 'nullable|integer|min:0',
            'CleLicLog' => 'nullable|string|max:255',
            'DatAchLog' => 'required|date',
            'DatExpLog' => 'nullable|date|after:DatAchLog',
            'IdFour' => 'nullable|integer',
        ]);

        Logiciel::create($request->all());
        return redirect()->route('logiciel.index')->with('success', 'Logiciel ajouté avec succès.');
    }

    /**
     * Affiche les détails d'un logiciel spécifique.
     */
    public function show($id)
    {
        $logiciel = Logiciel::findOrFail($id);
        return view('logiciel.show', compact('logiciel'));
    }

    /**
     * Affiche le formulaire d'édition pour un logiciel spécifique.
     */
    public function edit($id)
    {
        $logiciel = Logiciel::findOrFail($id);
        return view('logiciel.edit', compact('logiciel'));
    }

    /**
     * Met à jour un logiciel existant en base de données.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'VersionLog' => 'required|string|max:255',
            'TypLicLog' => 'required|string|max:255',
            'NbrLicLog' => 'required|integer|min:1',
            'NbrMinLicLog' => 'nullable|integer|min:0',
            'CleLicLog' => 'nullable|string|max:255',
            'DatAchLog' => 'required|date',
            'DatExpLog' => 'nullable|date|after:DatAchLog',
            'IdFour' => 'nullable|integer',
        ]);

        $logiciel = Logiciel::findOrFail($id);
        $logiciel->update($request->all());
        return redirect()->route('logiciel.index')->with('success', 'Logiciel mis à jour avec succès.');
    }

    /**
     * Supprime un logiciel de la base de données.
     */
    public function destroy($id)
    {
        $logiciel = Logiciel::findOrFail($id);
        $logiciel->delete();
        return redirect()->route('logiciel.index')->with('success', 'Logiciel supprimé avec succès.');
    }
}
