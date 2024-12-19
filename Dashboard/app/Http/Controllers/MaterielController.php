<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function index()
    {
        $materiels = Materiel::paginate(10);
        return view('actif-materiel', compact('materiels'));
    }

    public function create()
    {
        return view('materiels');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'NomAct' => 'required',
            'MarqMat' => 'required',
            'ModMarq' => 'required',
            'NumSerieMat' => 'required',
            'QteMat' => 'required|integer',
            'StatMat' => 'required',
            'DatAcqMat' => 'required|date',
        ]);

        // Création de l'actif matériel
        Materiel::create($request->all());

        // Redirection après l'ajout
        return redirect()->route('materiels.index')->with('success', 'Actif matériel ajouté avec succès');
    }

    public function edit($id)
    {
        $materiel = Materiel::findOrFail($id);
        return view('materiels.edit-materiel', compact('materiel'));
    }

    public function update(Request $request, $id)
    {
        $materiel = Materiel::findOrFail($id);
        $validated = $request->validate([
            // Mêmes règles que store()
        ]);

        $materiel->update($validated);

        return redirect()->route('materiels.index')
            ->with('success', 'Actif matériel mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $materiel = Materiel::findOrFail($id);
        $materiel->delete();

        return redirect()->route('materiels.index')
            ->with('success', 'Actif matériel supprimé avec succès.');
    }
}