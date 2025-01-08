<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /// Afficher la liste des employés
    public function index()
    {
        $services = Service::paginate(10); // Pagination pour limiter les résultats
        return view('User_Service.service', compact('services'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('User_Service.create');
    }

    // Enregistrer un nouvel employé
    public function store(Request $request)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'CodeUser' => 'required|string|max:255|exists:utilisateurs,CodeUser', // Clé primaire de Employe (doit exister dans la table Utilisateurs)
            'DesServ' => 'required|string|max:255',
            'NpnomRespServ' => 'required|string|max:50'
        ]);

        // Créer un nouvel employé
        Service::create([
            'CodeUser' => $validated['CodeUser'],
            'DesServ' => $validated['DesServ'],
            'NpnomRespServ' => $validated['NpnomRespServp'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('User_Service.index')->with('success', 'Le service a été ajouté avec succès.');
    }

    // Afficher le formulaire de modification
    public function edit(Service $service)
    {
        return view('User_Service.edit', compact('services'));
    }

    // Mettre à jour un employé existant
    public function update(Request $request, Service $service)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'CodeUser' => 'required|exists:utilisateurs,CodeUser', // Vérifie que l'utilisateur existe
            'DesServ' => 'required|string|max:255',
            'NpnomRespServ' => 'required|string|max:50',
        ]);

        // Mettre à jour l'employé
        $service->update([
            'CodeUser' => $validated['CodeUser'],
            'DesServ' => $validated['DesServ'],
            'NpnomRespServ' => $validated['NonomRespServ'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('User_Service.index')->with('success', 'Le service a été mis à jour avec succès.');
    }

    // Supprimer un employé
    public function destroy(Service $service)
    {
        // Supprimer l'employé
        $service->delete();

        // Rediriger avec un message de succès
        return redirect()->route('User_Service.index')->with('success', 'Service supprimé avec succès.');
    }
}
