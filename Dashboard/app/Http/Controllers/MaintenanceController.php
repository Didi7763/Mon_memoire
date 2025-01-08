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
        return view('maintenance.create');
    }

    // Enregistrer un nouvel employé
    public function store(Request $request)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'NumMaint' => 'required|integer', // Clé primaire de Employe (doit exister dans la table Utilisateurs)
            'DesServ' => 'required|string|max:255',
            'TypMaint' => 'required|string|max:50',
            'DatMaint' => 'required|date',
            'NomTechMaint' => 'required|string|max:255',
            'CoutMaint' => 'required|integer|max:255',
            'DateProchMaint' => 'required|date',
            'ComtMaint' => 'required|string|max:255',
            'IdAct' => 'required|string|exists:actifs,IdAct', // Clé étrangère vers Service
        ]);

        // Créer un nouvel employé
        Maintenance::create([
            'NumMaint' => $validated['NumMaint'],
            'DesServ' => $validated['DesServ'],
            'TypMaint' => $validated['TypMaint'],
            'DatMaint' => $validated['DatMaint'],
            'NomTechMaint' => $validated['NomTechMaint'],
            'CoutMaint' => $validated['CoutMaint'],
            'DateProchMaint' => $validated['DateProchMaint'],
            'ComtMaint' => $validated['ComtMaint'],
            'IdAct' => $validated['IdAct'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('maintenance.index')->with('success', 'Maintenance ajouté avec succès.');
    }

    // Afficher le formulaire de modification
    public function edit(Maintenance $maintenance)
    {
        return view('maintenance.edit', compact('maintenances'));
    }

    // Mettre à jour un employé existant
    public function update(Request $request, Maintenance $maintenance)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'NumMaint' => 'required|integer|increment', // Clé primaire de Employe (doit exister dans la table Utilisateurs)
            'DesServ' => 'required|string|max:255',
            'TypMaint' => 'required|string|max:50',
            'DatMaint' => 'required|date',
            'NomTechMaint' => 'required|string|max:255',
            'CoutMaint' => 'required|integer|max:255',
            'DateProchMaint' => 'required|date',
            'ComtMaint' => 'required|string|max:255',
            'IdAct' => 'required|string|exists:actifs,IdAct', // Clé étrangère vers Service
        ]);

        // Mettre à jour l'employé
        $maintenance->update([
            'NumMaint' => $validated['NumMaint'],
            'DesServ' => $validated['DesServ'],
            'TypMaint' => $validated['TypMaint'],
            'DatMaint' => $validated['DatMaint'],
            'NomTechMaint' => $validated['NomTechMaint'],
            'CoutMaint' => $validated['CoutMaint'],
            'DateProchMaint' => $validated['DateProchMaint'],
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
