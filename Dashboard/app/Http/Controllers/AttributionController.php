<?php

namespace App\Http\Controllers;

use App\Models\Attribuer;
use App\Models\Actif;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class AttributionController extends Controller
{
    public function index()
    {
        $attributions = Attribuer::with(['actif', 'utilisateur'])->get();
        return view('attributions.index', compact('attributions'));
    }

    public function create()
    {
        $actifs = Actif::all();
        $utilisateurs = Utilisateur::all();
        return view('attributions.create', compact('actifs', 'utilisateurs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'IdAct' => 'required|exists:actifs,IdAct',
            'CodeUser' => 'required|exists:utilisateurs,CodeUser',
            'NumAdmin' => 'required|numeric',
            'DatAttAct' => 'required|date',
        ]);

        Attribuer::create($validatedData);

        return redirect()->route('attributions.index')->with('success', 'Attribution ajoutée avec succès.');
    }
}
