<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;

class FournisseurController extends Controller
{
    // Afficher la liste des fournisseurs
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    // Ajouter un fournisseur
    public function store(Request $request)
    {
        $request->validate([
            'id_four' => 'required|unique:fournisseurs,IdFour',
            'nom_four' => 'required|string|max:255',
            'contact_four' => 'required|string|max:255',
            'email_four' => 'required|email|max:255',
            'adress_local_four' => 'required|string',
            'nom_personnel_contacte' => 'required|string|max:255',
            'type_produit_fournit' => 'required|string',
            'Note_four' => 'nullable|string',
        ]);

        Fournisseur::create([
            'IdFour' => $request->id_four,
            'NomFour' => $request->nom_four,
            'ContFour' => $request->contact_four,
            'EmailFour' => $request->email_four,
            'AdressFour' => $request->adress_local_four,
            'NomPersCont' => $request->nom_personnel_contacte,
            'TypProdFournit' => $request->type_produit_fournit,
            'NotesFour' => $request->Note_four,
        ]);

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur ajouté avec succès!');
    }
}
