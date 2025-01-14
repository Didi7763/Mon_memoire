<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Utilisateur;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $services = Service::all();
        return view('User_Employe.create', compact('services'));
    }

    // Enregistrer un nouvel employé
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CodeUser1' => 'required|string|max:255|unique:utilisateurs,CodeUser',
            'NomCompUser' => 'required|string|max:255',
            'ContactUser' => 'required|string|max:20',
            'EmailUser' => 'required|string|email|max:255',
            'FonctEmp' => 'required|string|max:255',
            'StatEmp' => 'required|string|max:80',
            'CodeUser' => 'required|string|max:255|exists:services,CodeUser', // S'assurer que CodeUser existe dans la table services
            'ListActif' => 'nullable|string|max:1000',
        ]);

        // Vérifiez si le CodeUser existe dans la table services
        $service = Service::where('CodeUser', $validated['CodeUser'])->first();
        if (!$service) {
            return redirect()->back()->withErrors(['CodeUser' => 'Le service sélectionné est invalide.'])->withInput();
        }

        // Création de l'utilisateur
        $utilisateur = Utilisateur::create([
            'CodeUser' => $validated['CodeUser1'],
            'NomCompUser' => $validated['NomCompUser'],
            'ContactUser' => $validated['ContactUser'],
            'EmailUser' => $validated['EmailUser'],
        ]);

        // Création de l'employé
        Employe::create([
            'CodeUser1' => $utilisateur->CodeUser,
            'FonctEmp' => $validated['FonctEmp'],
            'StatEmp' => $validated['StatEmp'],
            'CodeUser' => $validated['CodeUser'],
            'ListActif' => $validated['ListActif'],
        ]);
        // Rediriger avec un message de succès
        return redirect()->route('User_Employe.index')->with('success', 'L\'Employé a été ajouté avec succès.');
    }

    // Afficher le formulaire de modification
    public function edit($id)
    {
    // Récupérer l'employé par son ID
        $employe = Employe::findOrFail($id);

    // Récupérer tous les services
        $services = Service::all();

    // Passer l'employé et les services à la vue
        return view('User_Employe.edit', compact('employe', 'services'));
    }



    public function update(Request $request, $id)
{
    DB::beginTransaction();

try {
    // Récupérer les données
    $employe = Employe::with('utilisateur')->findOrFail($id);

    // Mettre à jour les données de l'utilisateur
    $employe->utilisateur->update([
        'NomCompUser' => $request->NomCompUser,
        'ContactUser' => $request->ContactUser,
        'EmailUser' => $request->EmailUser,
    ]);

    // Mettre à jour les données de l'employé
    $employe->update([
        'FonctEmp' => $request->FonctEmp,
        'StatEmp' => $request->StatEmp,
        'CodeUser' => $request->CodeUser, // Correction ici
        'ListActif' => $request->ListActif,
    ]);

    DB::commit();

    return redirect()->route('User_Employe.index')->with('success', 'L\'employé a été mis à jour avec succès.');
} catch (\Exception $e) {
    DB::rollBack();
    return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
}

}



    public function destroy($id)
    {
        try {
            // Démarrer une transaction pour garantir l'intégrité des données
            DB::beginTransaction();

            // Trouver l'employé par son ID
            $employe = Employe::findOrFail($id);

            // Trouver l'utilisateur lié au service via le CodeUser
            $utilisateur = Utilisateur::where('CodeUser', $employe->CodeUser1)->first();

            // Si un utilisateur est trouvé, nous le supprimons
            if ($utilisateur) {
                $utilisateur->delete();
            }

            // Supprimer l'employé
            $employe->delete();

            // Commit de la transaction pour valider les suppressions
            DB::commit();

            // Rediriger avec un message de succès
            return redirect()
                ->route('User_Employe.index')
                ->with('success', 'Employé et utilisateur supprimés avec succès.');

        } catch (\Illuminate\Database\QueryException $e) {
            // En cas d'erreur liée à la base de données, rollback de la transaction
            DB::rollBack();

            // Rediriger avec un message d'erreur spécifique
            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        } catch (\Exception $e) {
            // En cas d'erreur générique, rollback de la transaction
            DB::rollBack();

            // Rediriger avec un message d'erreur générique
            return redirect()
                ->back()
                ->with('error', 'Erreur inconnue lors de la suppression : ' . $e->getMessage());
        }
    }


}
