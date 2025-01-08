<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Utilisateur;
use App\Models\Service;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    // Afficher la liste des employés
    public function index()
    {
        $employes = Employe::paginate(10); // Pagination pour limiter les résultats
        return view('User_Employe.employe', compact('employes'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('User_Employe.create');
    }

    // Enregistrer un nouvel employé
    public function store(Request $request)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'CodeUser1' => 'required|string|max:255|exists:utilisateurs,CodeUser', // Clé primaire de Employe (doit exister dans la table Utilisateurs)
            'FonctEmp' => 'required|string|max:255',
            'StatEmp' => 'required|string|max:50',
            'ListActif' => 'required|string|max:255',
            'CodeUser' => 'required|string|exists:services,CodeUser', // Clé étrangère vers Service
        ]);

        // Créer un nouvel employé
        Employe::create([
            'CodeUser1' => $validated['CodeUser1'],
            'FonctEmp' => $validated['FonctEmp'],
            'StatEmp' => $validated['StatEmp'],
            'ListActif' => $validated['ListActif'],
            'CodeUser' => $validated['CodeUser'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('User_Employe.index')->with('success', 'Employé ajouté avec succès.');
    }

    // Afficher le formulaire de modification
    public function edit(Employe $employe)
    {
        return view('User_Employe.edit', compact('employes'));
    }

    // Mettre à jour un employé existant
    public function update(Request $request, Employe $employe)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'CodeUser' => 'required|exists:utilisateurs,CodeUser', // Vérifie que l'utilisateur existe
            'CodeService' => 'required|exists:services,CodeUser', // Vérifie que le service existe
            'FonctEmp' => 'required|string|max:255',
            'StatEmp' => 'required|string|max:50',
            'ListActif' => 'nullable|string|max:255',
        ]);

        // Mettre à jour l'employé
        $employe->update([
            'CodeUser' => $validated['CodeUser'],
            'CodeService' => $validated['CodeService'],
            'FonctEmp' => $validated['FonctEmp'],
            'StatEmp' => $validated['StatEmp'],
            'ListActif' => $validated['ListActif'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('User_Employe.index')->with('success', 'Employé mis à jour avec succès.');
    }

    // Supprimer un employé
    public function destroy(Employe $employe)
    {
        // Supprimer l'employé
        $employe->delete();

        // Rediriger avec un message de succès
        return redirect()->route('User_Employe.index')->with('success', 'Employé supprimé avec succès.');
    }
}
