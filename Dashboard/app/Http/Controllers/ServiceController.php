<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    // Afficher la liste des services
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

    // Enregistrer un nouveau service
    public function store(Request $request)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'CodeUser' => 'required|string|max:255', // Clé primaire de Utilisateur (doit exister dans la table Utilisateurs)
            'NomCompUser' => 'required|string|max:255',
            'DesServ' => 'required|string|max:255',
            'NpnomRespServ' => 'required|string|max:80',
            'ContactUser' => 'required|string',
            'EmailUser' => 'required|string|email',
        ]);

        // Création de l'utilisateur
        $utilisateur = new Utilisateur();
        $utilisateur->CodeUser = $validated['CodeUser'];
        $utilisateur->NomCompUser = $validated['NomCompUser'];
        $utilisateur->ContactUser = $validated['ContactUser'];
        $utilisateur->EmailUser = $validated['EmailUser'];
        $utilisateur->save(); // Sauvegarde de l'utilisateur

        // Création d'un nouveau service
        $service = new Service();
        $service->CodeUser = $utilisateur->CodeUser;
        $service->DesServ = $validated['DesServ'];
        $service->NpnomRespServ = $validated['NpnomRespServ'];
        $service->save(); // Sauvegarde dans la table services

        // Rediriger avec un message de succès
        return redirect()->route('User_Service.index')->with('success', 'Le service a été ajouté avec succès.');
    }


    public function edit($id)
{
    $service = Service::findOrFail($id);
    return view('User_Service.edit', compact('service'));
}



public function update(Request $request, $id)
{
    DB::beginTransaction();

    try {
        // Récupérer les données
        $service = Service::with('utilisateur')->findOrFail($id);

        // Mettre à jour les données de l'actif
        $service->utilisateur->update([
            'NomCompUser' => $request->NomCompUser,
            'ContactUser' => $request->ContactUser,
            'EmailUser' => $request->EmailUser,
        ]);

        // Mettre à jour les données de la table donnees
        $service->update([
            'DesServ' => $request->DesServ,
            'NpnomRespServ' => $request->NpnomRespServ,
        ]);

        DB::commit();

        return redirect()->route('User_Service.index')->with('success', 'Le service a été mis à jour avec succès.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
    }
}

    // Supprimer un service

    public function destroy($id)
{
    try {
        DB::beginTransaction();

        // Trouver le service par son ID
        $service = Service::findOrFail($id);

        // Trouver l'utilisateur lié au service via le CodeUser
        $utilisateur = Utilisateur::where('CodeUser', $service->CodeUser)->first();

        if ($utilisateur) {
            // Supprimer l'utilisateur lié s'il existe
            $utilisateur->delete();
        }

        // Supprimer le service
        $service->delete();

        DB::commit();

        // Redirection avec un message de succès
        return redirect()
            ->route('User_Service.index')
            ->with('success', 'Service et utilisateur supprimés avec succès.');
    } catch (\Exception $e) {
        DB::rollBack();

        // Redirection avec un message d'erreur
        return redirect()
            ->back()
            ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
    }
}



}
