<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Actif;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    // Afficher la liste des employés
    public function index()
    {
        $maintenances = Maintenance::paginate(10); // Pagination pour limiter les résultats
        return view('maintenance.index', compact('maintenances'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $actifs = Actif::all(); // Récupère tous les actifs
        return view('maintenance.create', compact('actifs'));
    }

    // Enregistrer un nouvel employé
    public function store(Request $request)
{
    // Valider les données reçues
    $validated = $request->validate([
        'DesMaint' => 'required|string|max:255', // Description du service
        'TypMaint' => 'required|string|max:50', // Type de maintenance
        'DatMaint' => 'required|date', // Date de la maintenance
        'NomTechMaint' => 'required|string|max:255', // Nom du technicien
        'CoutMaint' => 'required|numeric', // Coût de la maintenance
        'DatProchMaint' => 'nullable|date', // Date de prochaine maintenance (peut être vide)
        'ComtMaint' => 'nullable|string|max:255', // Commentaire (peut être vide)
        'IdAct' => 'required|exists:actifs,IdAct', // Clé étrangère (actif doit exister dans la table actifs)
    ]);

    // Créer un nouvel enregistrement de maintenance
    Maintenance::create($validated);

    // Rediriger avec un message de succès
    return redirect()->route('maintenance.index')->with('success', 'Maintenance ajoutée avec succès.');
}


    // Afficher le formulaire de modification
    public function edit(Maintenance $maintenance)
    {
        // Récupérer tous les actifs disponibles pour le formulaire de sélection
        $actifs = Actif::all(); // Récupérer tous les actifs

        // Vérifiez si l'actif associé à la maintenance existe
        $actif = $actifs->firstWhere('IdAct', $maintenance->IdAct); // Récupérer l'actif correspondant à la maintenance

        // Vérifiez si l'actif existe, sinon redirigez avec un message d'erreur
        if (!$actif) {
            return redirect()->route('maintenance.index')
                             ->with('error', 'Actif associé non trouvé.');
        }

        // Passer la collection des actifs à la vue avec la maintenance
        return view('maintenance.edit', compact('maintenance', 'actifs'));
    }


    // Mettre à jour un employé existant
    public function update(Request $request, Maintenance $maintenance)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'NumMaint' => 'required|integer',// Clé primaire de Employe (doit exister dans la table Utilisateurs)
            'DesMaint'=> 'required|string|max:255',
            'TypMaint' => 'required|string|max:50',
            'DatMaint' => 'required|date',
            'NomTechMaint' => 'required|string|max:255',
            'CoutMaint' => 'required|numeric',
            'DatProchMaint' => 'required|date',
            'ComtMaint' => 'required|string|max:255',
            'IdAct' => 'required|string|exists:actifs,IdAct', // Clé étrangère vers Service
        ]);

        // Mettre à jour l'employé
        $maintenance->update([
            'NumMaint' => $validated['NumMaint'],
            'DesMaint'=> $validated['DesMaint'],
            'TypMaint' => $validated['TypMaint'],
            'DatMaint' => $validated['DatMaint'],
            'NomTechMaint' => $validated['NomTechMaint'],
            'CoutMaint' => $validated['CoutMaint'],
            'DatProchMaint' => $validated['DatProchMaint'],
            'ComtMaint' => $validated['ComtMaint'],
            'IdAct' => $validated['IdAct'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('maintenance.index')->with('success', 'Maintenance mis à jour avec succès.');
    }

    // Supprimer un employé
    public function destroy(Maintenance $maintenance)
    {
        // Supprimer l'employé
        $maintenance->delete();

        // Rediriger avec un message de succès
        return redirect()->route('maintenance.index')->with('success', 'Maintenanca supprimé avec succès.');
    }
}
