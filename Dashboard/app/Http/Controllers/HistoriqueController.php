<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use App\Models\Actif;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    public function index()
    {
        $historiques = Historique::with('actif')->paginate(10);
        return view('historiques.index', compact('historiques'));
    }

    public function create()
    {
        $actifs = Actif::all();
        return view('historiques.create', compact('actifs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'DatAction' => 'required|date',
            'DesAction' => 'required|string|max:255',
            'IdAct' => 'required|exists:actifs,IdAct',
        ]);

        Historique::create($validated);

        return redirect()->route('historiques.index')->with('success', 'Historique ajouté avec succès.');
    }

    public function show($id)
    {
        $historique = Historique::with('actif')->findOrFail($id);
        return view('historiques.show', compact('historique'));
    }

    public function edit($id)
    {
        $historique = Historique::findOrFail($id);
        $actifs = Actif::all();
        return view('historiques.edit', compact('historique', 'actifs'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'DatAction' => 'required|date',
            'DesAction' => 'required|string|max:255',
            'IdAct' => 'required|exists:actifs,IdAct',
        ]);

        $historique = Historique::findOrFail($id);
        $historique->update($validated);

        return redirect()->route('historiques.index')->with('success', 'Historique mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $historique = Historique::findOrFail($id);
        $historique->delete();

        return redirect()->route('historiques.index')->with('success', 'Historique supprimé avec succès.');
    }
}
