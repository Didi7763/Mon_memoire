<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribuer;
use App\Models\Actif;
use App\Models\Utilisateur;
use App\Models\Admin;

class AttribuerController extends Controller
{
    // Afficher la liste des attributions
    public function index()
    {
        $attributions = Attribuer::with(['actif', 'utilisateur', 'admin'])->get();
        return view('attributions.index', compact('attributions'));
    }

    // Afficher le formulaire pour ajouter une attribution
    public function create()
    {
        $actifs = Actif::all();
        $utilisateurs = Utilisateur::all();
        $admins = Admin::all();

        return view('attributions.create', compact('actifs', 'utilisateurs', 'admins'));
    }

    // Ajouter une attribution
    public function store(Request $request)
    {
        $request->validate([
            'IdAct' => 'required|exists:actifs,IdAct',
            'CodeUser' => 'required|exists:utilisateurs,CodeUser',
            'NumAdmin' => 'required|exists:admins,NumAdmin',
            'DatAttAct' => 'required|date',
        ]);

        Attribuer::create($request->all());

        return redirect()->route('attributions.index')->with('success', 'Attribution ajoutée avec succès!');
    }
}
