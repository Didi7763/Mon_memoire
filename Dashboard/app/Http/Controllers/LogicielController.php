<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Logiciel;
use Illuminate\Http\Request;
use App\Models\Actif;
use Illuminate\Support\Facades\DB;
class LogicielController extends Controller
{
    /**
     * Affiche la liste des logiciels.
     */
    public function index()
    {
        $logiciels = Logiciel::with('actif')->paginate(10);
        return view('logiciel.actif-logiciel', compact('logiciels'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau logiciel.
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();
        return view('logiciel.create', compact('fournisseurs'));
    }

    /**
     * Stocke un nouveau logiciel en base de données.
     */
    public function store(Request $request)
    {
        DB::enableQueryLog();

        $validated = $request->validate([
            'IdAct' => 'required|string|unique:logiciels,IdAct', // Validation de l'unicité pour IdAct
            'NomAct' => 'required|string|max:255',
            'ComtAct' => 'nullable|string|max:500',
            'VersionLog' => 'required|string|max:255',
            'TypLicLog' => 'required|string|max:255',
            'NbrLicLog' => 'required|integer|min:1',
            'NbrMinLicLog' => 'nullable|integer|min:1',
            'CleLicLog' => 'nullable|string|max:255',
            'DatAchLog' => 'required|date',
            'DatExpLog' => 'nullable|date|after:DatAchLog',
            'IdFour' => 'required|exists:fournisseurs,IdFour',
        ]);

        try {
            DB::beginTransaction();

              // Création de l'actif
              $actif = new Actif();
              $actif->IdAct = $validated['IdAct']; // ID de l'actif, vérifie que cela est unique si nécessaire
              $actif->NomAct = $validated['NomAct'];
              $actif->ComtAct = $validated['ComtAct'] ?? null;
              $actif->save(); // Sauvegarde de l'actif

            // Création du logiciel associé
            $logiciel = new Logiciel();
            $logiciel->IdAct = $actif->IdAct;
            $logiciel->VersionLog = $validated['VersionLog'];
            $logiciel->TypLicLog = $validated['TypLicLog'];
            $logiciel->NbrLicLog = $validated['NbrLicLog'];
            $logiciel->NbrMinLicLog = $validated['NbrMinLicLog'];
            $logiciel->CleLicLog = $validated['CleLicLog'];
            $logiciel->DatAchLog = $validated['DatAchLog'];
            $logiciel->DatExpLog = $validated['DatExpLog'];
            $logiciel->IdFour = $validated['IdFour'];
            $logiciel->save();

            DB::commit();

            error_log(print_r(DB::getQueryLog(), true));

            return redirect()
                ->route('logiciel.index')
                ->with('success', 'Logiciel ajouté avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            error_log('Erreur lors de l\'insertion : ' . $e->getMessage());
            error_log($e->getTraceAsString());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de l\'ajout : ' . $e->getMessage());
        }
    }


    /**
     * Affiche les détails d'un logiciel spécifique.
     */
    public function show($id)
    {
        $logiciel = Logiciel::findOrFail($id);
        return view('logiciel.show', compact('logiciel'));
    }

    /**
     * Affiche le formulaire d'édition pour un logiciel spécifique.
     */

     public function edit(Logiciel $logiciel)
     {
         // Récupérer tous les actifs disponibles pour le formulaire de sélection
         $fournisseurs = Fournisseur::all(); // Récupérer tous les actifs

         // Vérifiez si l'actif associé à la maintenance existe
         $fournisseur = $fournisseurs->firstWhere('IdFour', $logiciel->IdFour); // Récupérer l'actif correspondant à la maintenance

         // Vérifiez si l'actif existe, sinon redirigez avec un message d'erreur
         if (!$fournisseur) {
             return redirect()->route('logiciel.index')
                              ->with('error', 'Fournisseur associé non trouvé.');
         }

         // Passer la collection des actifs à la vue avec la maintenance
         return view('logiciel.edit', compact('logiciel', 'fournisseurs'));
     }


    /**
     * Met à jour un logiciel existant en base de données.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Validation des données
            $request->validate([
                'NomAct' => 'required|string|max:255',
                'VersionLog' => 'required|string|max:255',
                'TypLicLog' => 'required|string|in:libre,propriétaire,Gratuiciel,SaaS,Réseau',
                'NbrLicLog' => 'required|integer|min:1',
                'NbrMinLicLog' => 'required|integer|min:1',
                'CleLicLog' => 'required|string|max:255',
                'DatAchLog' => 'required|date',
                'DatExpLog' => 'required|date|after:DatAchLog',
                'IdFour' => 'required|exists:fournisseurs,IdFour',
                'ComtAct' => 'nullable|string',
            ]);

            // Récupération des données du logiciel avec sa relation à l'actif
            $logiciel = Logiciel::with('actif')->findOrFail($id);

            // Mettre à jour les données de l'actif associé
            $logiciel->actif->update([
                'NomAct' => $request->NomAct,
                'ComtAct' => $request->ComtAct,
            ]);

            // Mettre à jour les données spécifiques au logiciel
            $logiciel->update([
                'VersionLog' => $request->VersionLog,
                'TypLicLog' => $request->TypLicLog,
                'NbrLicLog' => $request->NbrLicLog,
                'NbrMinLicLog' => $request->NbrMinLicLog,
                'CleLicLog' => $request->CleLicLog,
                'DatAchLog' => $request->DatAchLog,
                'DatExpLog' => $request->DatExpLog,
                'IdFour' => $request->IdFour,
            ]);

            // Confirmer la transaction
            DB::commit();

            // Rediriger avec un message de succès
            return redirect()->route('logiciel.index')->with('success', 'Logiciel mis à jour avec succès.');

        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();

            // Rediriger avec un message d'erreur
            return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }


    /**
     * Supprime un logiciel de la base de données.
     */
   public function destroy(Logiciel $logiciel)
{
    try {
        DB::beginTransaction();

        // Suppression de l'actif associé
        $actif = Actif::where('IdAct', $logiciel->IdAct)->first();

        if ($actif) {
            $actif->delete(); // Suppression de l'actif si trouvé
        }

        // Suppression du logiciel
        $logiciel->delete();

        DB::commit();

        return redirect()
            ->route('logiciel.index')
            ->with('success', 'Logiciel et actif supprimés avec succès.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()
            ->back()
            ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
    }
}

}
