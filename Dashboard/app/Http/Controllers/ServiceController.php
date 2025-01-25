<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Actif;
use App\Models\Categorie;
use App\Models\Historique;
use App\Models\Attribuer;
use App\Models\Materiel;
use App\Models\Logiciel;
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
if (!$utilisateur) {
    throw new \Exception("L'utilisateur associé à ce service n'existe pas.");
}

// Récupérer toutes les attributions associées à cet utilisateur
$attributions = Attribuer::where('CodeUser', $utilisateur->CodeUser)->get();

// Parcourir chaque attribution pour incrémenter les quantités
foreach ($attributions as $attribution) {
    // Récupérer l'actif associé à l'attribution
    $actif = Actif::find($attribution->IdAct);
    if (!$actif) {
        throw new \Exception("L'actif associé à cette attribution n'existe pas.");
    }

    // Vérifier si l'actif est un matériel ou un logiciel
    if ($actif->type === 'matériel') {
        // Récupérer le matériel associé à l'actif
        $materiel = Materiel::where('IdAct', $actif->IdAct)->first();
        if (!$materiel) {
            throw new \Exception("Le matériel associé à cet actif n'existe pas.");
        }

        // Trouver la catégorie du matériel
        $categorie = Categorie::where('RefCatMat', $materiel->RefCatMat)->first();
        if (!$categorie) {
            throw new \Exception("La catégorie du matériel n'existe pas.");
        }

        // Incrémenter la quantité en stock de 1
        $categorie->QteStockMat += 1;
        $categorie->save();

    } elseif ($actif->type === 'logiciel') {
        // Récupérer le logiciel associé à l'actif
        $logiciel = Logiciel::where('IdAct', $actif->IdAct)->first();
        if (!$logiciel) {
            throw new \Exception("Le logiciel associé à cet actif n'existe pas.");
        }

        // Incrémenter le nombre de licences de 1
        $logiciel->NbrLicLog += 1;
        $logiciel->save();
    }

    // Supprimer l'attribution
    $attribution->delete();

     // Création de l'historique pour chaque attribution supprimée
     $historique = new Historique();
     $historique->DatAction = now();
     $historique->IdAct = $attribution->IdAct;
     $historique->DesAction = "L'actif " . $actif->NomAct . " a été rétiré à " . $utilisateur->NomCompUser . " le " . now();
     $historique->save();
}

// Supprimer l'utilisateur
$utilisateur->delete();

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
