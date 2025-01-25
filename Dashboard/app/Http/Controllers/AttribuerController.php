<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribuer; // Modèle pour gérer la table des attributions
use App\Models\Actif; // Modèle pour gérer la table des actifs
use App\Models\Utilisateur; // Modèle pour gérer la table des utilisateurs
use App\Models\User; // Modèle pour gérer la table des administrateurs
use App\Models\Historique;
use App\Models\Categorie;
use App\Models\Logiciel;
use App\Models\Materiel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttribuerController extends Controller
{
    /**
     * Afficher la liste des attributions.
     * Cette méthode récupère toutes les attributions avec leurs relations
     * (actifs, utilisateurs et administrateurs) et les passe à la vue.
     */public function index()
{
    // Chargez les attributions avec leurs relations et paginez
    $attributions = Attribuer::with(['actif', 'utilisateur', 'user'])->paginate(15);

    return view('attributions.index', compact('attributions'));
}



    public function create()
    {
        $actifs = Actif::all();
        $utilisateurs = Utilisateur::all();
        $users = user::all();
        return view('attributions.create', compact('actifs', 'utilisateurs', 'users'));
    }


    public function store(Request $request)
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Valider les données du formulaire
    $validated = $request->validate([
        'IdAct' => 'required|exists:actifs,IdAct',
        'CodeUser' => 'required|exists:utilisateurs,CodeUser',
        'DatAttAct' => 'required|date',
    ]);

    // Créer une nouvelle attribution avec les données validées
    $attribuer = new Attribuer();
    $attribuer->IdAct = $validated['IdAct'];
    $attribuer->CodeUser = $validated['CodeUser'];
    $attribuer->NumAdmin = $user->id; // Utiliser l'ID de l'utilisateur connecté
    $attribuer->DatAttAct = $validated['DatAttAct'];
    $attribuer->save();

     // Récupérer l'actif attribué
     $actif = Actif::find($validated['IdAct']);
     if (!$actif) {
         throw new \Exception("L'actif spécifié n'existe pas.");
     }

     // Récupérer l'utilisateur
     $utilisateur = Utilisateur::find($validated['CodeUser']);
     if (!$utilisateur) {
         throw new \Exception("L'utilisateur spécifié n'existe pas.");
     }

     // Vérifier si l'actif est un matériel ou un logiciel
     if ($actif->type === 'matériel') {
         // Récupérer le matériel associé à l'actif
         $materiel = Materiel::where('IdAct', $actif->IdAct)->first();
         if (!$materiel) {
             throw new \Exception("Le matériel associé à cet actif n'existe pas.");
         }
         $materiel->StatMat = 'Affecté';
         $materiel->save();

         // Trouver la catégorie du matériel
         $categorie = Categorie::where('RefCatMat', $materiel->RefCatMat)->first();
         if (!$categorie) {
             throw new \Exception("La catégorie du matériel n'existe pas.");
         }

         // Décrémenter la quantité en stock de 1
         if ($categorie->QteStockMat > 0) {
             $categorie->QteStockMat -= 1;
             $categorie->save();
         } else {
             throw new \Exception("La quantité en stock est insuffisante pour ce matériel.");
         }

     } elseif ($actif->type === 'logiciel') {
         // Récupérer le logiciel associé à l'actif
         $logiciel = Logiciel::where('IdAct', $actif->IdAct)->first();
         if (!$logiciel) {
             throw new \Exception("Le logiciel associé à cet actif n'existe pas.");
         }

         // Décrémenter le nombre de licences de 1
         if ($logiciel->NbrLicLog > 0) {
             $logiciel->NbrLicLog -= 1;
             $logiciel->save();
         } else {
             throw new \Exception("Le nombre de licences est insuffisant pour ce logiciel.");
         }
     }
    // Création de l'historique
    $historique = new Historique();
    $historique->DatAction = now();
    $historique->IdAct = $validated['IdAct'];
    $historique->DesAction = "L'actif " . $actif->NomAct . " a été attribué le " . now() . " par " . $user->name . " à " . $utilisateur->NomCompUser;
    $historique->save();

    // Rediriger vers la liste des attributions avec un message de succès
    return redirect()->route('attributions.index')->with('success', 'Attribution ajoutée avec succès!');
}

// Afficher le formulaire de modification
public function edit($id)
{
    $attributions = Attribuer::with('actif', 'utilisateur', 'user')->find($id);;
    // Récupérer tous actifs, utilisateurs et users
        $actifs = Actif::all();
        $utilisateurs = Utilisateur::all();
        $users = User::all();

    return view('attributions.edit', compact('attributions', 'actifs', 'utilisateurs', 'users'));
}

public function update(Request $request, $id)
{
    DB::beginTransaction();

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    try {
        // Récupérer l'attribution avec l'actif associé
        $attribution = Attribuer::with('actif')->findOrFail($id);
        $oldActif = null;

        // Vérifier si IdAct a été modifié
        if ($attribution->IdAct != $request->IdAct) {
            // Récupérer l'ancien actif
            $oldActif = Actif::find($attribution->IdAct);

            // Restituer la quantité de l'ancien actif
            if ($oldActif) {
                switch ($oldActif->type) {
                    case 'logiciel':
                        $logiciel = Logiciel::where('IdAct', $oldActif->IdAct)->first();
                        if (!$logiciel) {
                            throw new \Exception("Le logiciel associé à cet actif n'existe pas.");
                        }

                        // Restituer une licence
                        $logiciel->NbrLicLog += 1;
                        $logiciel->save();
                        break;

                    case 'matériel':
                        $materiel = Materiel::where('IdAct', $oldActif->IdAct)->first();
                        if (!$materiel) {
                            throw new \Exception("Le matériel associé à cet actif n'existe pas.");
                        }

                        // Restituer le matériel en stock
                        $materiel->StatMat = 'En stock';
                        $materiel->save();

                        // Restituer la quantité en stock de la catégorie
                        $categorie = Categorie::where('RefCatMat', $materiel->RefCatMat)->first();
                        if (!$categorie) {
                            throw new \Exception("La catégorie du matériel n'existe pas.");
                        }

                        $categorie->QteStockMat += 1;
                        $categorie->save();
                        break;

                    case 'donnee':
                        // Aucune action nécessaire pour les données
                        break;

                    default:
                        throw new \Exception("Type d'actif non reconnu.");
                }
            }

            // Récupérer le nouvel actif
            $newActif = Actif::find($request->IdAct);
            if (!$newActif) {
                throw new \Exception("Le nouvel actif n'existe pas.");
            }

            // Diminuer la quantité du nouvel actif
            switch ($newActif->type) {
                case 'logiciel':
                    $logiciel = Logiciel::where('IdAct', $newActif->IdAct)->first();
                    if (!$logiciel) {
                        throw new \Exception("Le logiciel associé au nouvel actif n'existe pas.");
                    }

                    // Vérifier et décrémenter les licences
                    if ($logiciel->NbrLicLog > 0) {
                        $logiciel->NbrLicLog -= 1;
                        $logiciel->save();
                    } else {
                        throw new \Exception("Le nombre de licences est insuffisant pour ce logiciel.");
                    }
                    break;

                case 'matériel':
                    $materiel = Materiel::where('IdAct', $newActif->IdAct)->first();
                    if (!$materiel) {
                        throw new \Exception("Le matériel associé au nouvel actif n'existe pas.");
                    }

                    // Vérifier et décrémenter la quantité en stock
                    $categorie = Categorie::where('RefCatMat', $materiel->RefCatMat)->first();
                    if (!$categorie) {
                        throw new \Exception("La catégorie du matériel n'existe pas.");
                    }

                    if ($categorie->QteStockMat > 0) {
                        $categorie->QteStockMat -= 1;
                        $categorie->save();
                    } else {
                        throw new \Exception("La quantité en stock est insuffisante pour ce matériel.");
                    }

                    // Mettre à jour le statut du matériel
                    $materiel->StatMat = 'Affecté';
                    $materiel->save();
                    break;

                case 'donnee':
                    // Aucune action nécessaire pour les données
                    break;

                default:
                    throw new \Exception("Type d'actif non reconnu.");
            }
        }

        // Mise à jour de l'attribution
        $attribution->update([
            'IdAct' => $request->IdAct,
            'DatAttAct' => $request->DatAttAct,
            'CodeUser' => $request->CodeUser,
            'NumAdmin' => $request->NumAdmin,
        ]);

        // Création de l'historique
        $historique = new Historique();
        $historique->DatAction = now();
        $historique->IdAct = $attribution->IdAct;
        $historique->DesAction = "L'actif " . $attribution->actif->NomAct . " attribué par " . $user->name . " à " . $attribution->utilisateur->NomCompUser . " a été modifié le " . now();
        $historique->save();

        DB::commit();

        return redirect()->route('attributions.index')->with('success', 'L\'attribution a été mise à jour avec succès.');
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

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Trouver l'employé par son ID
        $attribution = Attribuer::findOrFail($id);

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


        // Supprimer l'employé
        $attribution->delete();

        // Création de l'historique
        $historique = new Historique();
        $historique->DatAction = now();
        $historique->IdAct = $attribution->IdAct;
        $historique->DesAction = "L'actif " . $attribution->actif->NomAct . "attribué par " . $user->name . " à " . $attribution->utilisateur->NomCompUser. " a été Supprimé le " . now() ;
        $historique->save();

        // Commit de la transaction pour valider les suppressions
        DB::commit();

        // Rediriger avec un message de succès
        return redirect()
            ->route('attributions.index')
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
