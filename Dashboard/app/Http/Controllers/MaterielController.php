<?php

namespace App\Http\Controllers;

use App\Models\Materiel; // Assurez-vous d'importer le modèle Materiel
use App\Models\Fournisseur;
use App\Models\Categorie;
use App\Models\Actif;
use App\Models\Historique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterielController extends Controller
{
    public function index()
    {
        // Ajout d'une virgule manquante dans la fonction view()
        $materiels = Materiel::paginate(10); // Récupère les matériels avec pagination
        return view('materiel.actif-materiel', compact('materiels')); // Correction de la syntaxe pour 'compact'
    }

    public function create()
    {
        $fournisseurs = Fournisseur::all();
        $categorie_materiels = Categorie::all();
        return view('materiel.create', compact('fournisseurs', 'categorie_materiels')); // Vérification du nom de la vue
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'IdAct' => 'required|string|max:255|unique:materiels,IdAct',
            'NomAct' => 'required|string|max:255',
            'MarqMat' => 'required|string|max:255',
            'ModMarq' => 'required|string|max:255',
            'NumSerieMat' => 'required|string|max:255|unique:materiels,NumSerieMat',
            'QteMat' => 'required|integer|min:1',
            'StatMat' => 'required|string|in:En stock,Affecté,Panne,Réparation,Réformé',
            'DatAcqMat' => 'required|date',
            'DureVieMat' => 'integer|min:1',
            'IdFour' => 'required|exists:fournisseurs,IdFour',
            'RefCatMat' => 'required|exists:categorie_materiels,RefCatMat',
            'ComtAct' => 'nullable|string|max:1000',
        ]);

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

         // Création de l'actif
         $actif = new Actif();
         $actif->IdAct = $validated['IdAct']; // ID de l'actif, vérifie que cela est unique si nécessaire
         $actif->NomAct = $validated['NomAct'];
         $actif->type = 'matériel';
         $actif->ComtAct = $validated['ComtAct'] ?? null;
         $actif->save(); // Sauvegarde de l'actif


        // Création d'un nouvel actif matériel
        $materiel = new Materiel();
        $materiel->IdAct = $actif->IdAct;
        $materiel->MarqMat = $validated['MarqMat'];
        $materiel->ModMarq = $validated['ModMarq'];
        $materiel->NumSerieMat = $validated['NumSerieMat'];
        $materiel->QteMat = $validated['QteMat'];
        $materiel->StatMat = $validated['StatMat'];
        $materiel->DatAcqMat = $validated['DatAcqMat'];
        $materiel->DureVieMat = $validated['DureVieMat'];
        $materiel->IdFour = $validated['IdFour'];
        $materiel->RefCatMat = $validated['RefCatMat'];

        // Sauvegarde dans la table materiels
        $materiel->save();

        // Mise à jour de la quantité dans categorie_materiels
        $categorie = Categorie::where('RefCatMat', $validated['RefCatMat'])->first();
        if ($categorie) {
            $categorie->QteStockMat += $validated['QteMat']; // Ajoute la quantité du matériel
            $categorie->save(); // Sauvegarde la nouvelle quantité
        }


        // Création de l'historique
        $historique = new Historique();
        $historique->DatAction = now();
        $historique->IdAct = $actif->IdAct;
        $historique->DesAction = "L'actif matériel " . $actif->NomAct . " a été ajouté le " . now() . " par " . $user->name;
        $historique->save(); // Sauvegarde de l'historique

        // Redirection avec un message de succès
        return redirect()->route('actif-materiel')
            ->with('success', 'Le matériel a été ajouté avec succès et la quantité a été mise à jour.');
    }


    public function edit(Materiel $materiel)
    {
        // Récupérer tous les actifs disponibles pour le formulaire de sélection
        $fournisseurs = Fournisseur::all(); // Récupérer tous les actif()
        $categorie_materiels= Categorie::all();

        // Vérifiez si l'actif associé à la maintenance existe
        $fournisseur = $fournisseurs->firstWhere('IdFour', $materiel->IdFour); // Récupérer l'actif correspondant à la maintenance
        $categorie = $categorie_materiels->firstWhere('RefCatMat', $materiel->RefCatMat);
        // Vérifiez si l'actif existe, sinon redirigez avec un message d'erreur
        if (!$fournisseur && !$categorie) {
            return redirect()->route('materiel.index')
                             ->with('error', 'Fournisseur ou catégorie associé non trouvé.');
        }

        // Passer la collection des actifs à la vue avec la maintenance
        return view('materiel.edit', compact('materiel', 'fournisseurs', 'categorie_materiels'));
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
            // Récupérer l'utilisateur connecté
        $user = Auth::user();
        try {
            // Validation des données
            $request->validate([
                'NomAct' => 'required|string|max:255',
                'MarqMat' => 'required|string|max:255',
                'ModMarq' => 'required|string|max:255',
                'NumSerieMat' => 'required|string|max:255',
                'StatMat' => 'required|string|in:En stock,Affecté,Panne,Réparation,Réformé',
                'DatAcqMat' => 'required|date',
                'DureVieMat' => 'required|integer|min:1',
                'IdFour' => 'required|exists:fournisseurs,IdFour',
                'RefCatMat' => 'required|exists:categorie_materiels,RefCatMat',
                'ComtAct' => 'nullable|string',
            ]);

            // Récupération du matériel avec sa relation à l'actif
            $materiel = Materiel::with('actif')->findOrFail($id);

            // Mettre à jour les données de l'actif associé
            $materiel->actif->update([
                'NomAct' => $request->NomAct,
                'ComtAct' => $request->ComtAct,
                'type' => 'matériel',
            ]);

            // Mettre à jour les données spécifiques au matériel
            $materiel->update([
                'MarqMat' => $request->MarqMat,
                'ModMarq' => $request->ModMarq,
                'NumSerieMat' => $request->NumSerieMat,
                'StatMat' => $request->StatMat,
                'DatAcqMat' => $request->DatAcqMat,
                'DureVieMat' => $request->DureVieMat,
                'IdFour' => $request->IdFour,
                'RefCatMat' => $request->RefCatMat,
            ]);

            // Création de l'historique
            $historique = new Historique();
            $historique->DatAction = now();
            $historique->IdAct = $materiel->actif->IdAct;
            $historique->DesAction = "L'actif matériel " . $materiel->actif->NomAct . " a été mis à jour le " . now() . " par " . $user->name;
            $historique->save(); // Sauvegarde de l'historique

            // Confirmer la transaction
            DB::commit();

            // Rediriger avec un message de succès
            return redirect()->route('materiel.index')->with('success', 'Matériel mis à jour avec succès.');

        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();

            // Rediriger avec un message d'erreur
            return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }



    public function destroy(Materiel $materiel)
    {
        try {
            DB::beginTransaction();
                // Récupérer l'utilisateur connecté
                $user = Auth::user();

            // Récupérer la catégorie associée au matériel
            $categorie = Categorie::where('RefCatMat', $materiel->RefCatMat)->first();

            if ($categorie) {
                // Réduire la quantité en stock de la catégorie par la quantité du matériel
                $categorie->QteStockMat -= $materiel->QteMat;
                if ($categorie->QteStockMat < 0) {
                    $categorie->QteStockMat = 0; // S'assurer que la quantité en stock ne devient pas négative
                }
                $categorie->save();
            }

             // Création de l'historique
             $historique = new Historique();
             $historique->DatAction = now();
             $historique->IdAct = $materiel->actif->IdAct;
             $historique->DesAction = "L'actif matériel " . $materiel->actif->NomAct . " a été supprimé le " . now() . " par " . $user->name;
             $historique->save(); // Sauvegarde de l'historique

            // Suppression de l'actif associé
            $actif = Actif::where('IdAct', $materiel->IdAct)->first();
            if ($actif) {
                $actif->delete(); // Suppression de l'actif si trouvé
            }

            // Suppression du matériel
            $materiel->delete();

            DB::commit();

            return redirect()
                ->route('materiel.index')
                ->with('success', 'Matériel, actif supprimé et quantité stock mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }


}
