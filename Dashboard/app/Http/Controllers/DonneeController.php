<?php

namespace App\Http\Controllers;

use App\Models\Donnee;
use App\Models\Actif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class DonneeController extends Controller
{
    public function index()
    {
        $donnees = Donnee::with('actif')->paginate(10);
        return view('donnees.actif-data', compact('donnees'));
    }

    public function create()
    {
        return view('donnees.create');
    }

    public function store(Request $request)
    {
        DB::enableQueryLog();

        $validated = $request->validate([
            'IdAct' => 'required|string|unique:actifs,IdAct', // Validation de l'unicité pour IdAct
            'NomAct' => 'required|string|max:255',
            'ComtAct' => 'nullable|string|max:500',
            'FormatData' => 'required|string|max:255',
            'SourceData' => 'required|string|max:255',
            'ResponsabeData' => 'nullable|string|max:255',
            'NivSensData' => 'nullable|string|max:50',
            'StatData' => 'nullable|string|max:50',
        ]);

        try {
            DB::beginTransaction();

                // Création de l'actif
            $actif = new Actif();
            $actif->IdAct = $validated['IdAct']; // ID de l'actif, vérifie que cela est unique si nécessaire
            $actif->NomAct = $validated['NomAct'];
            $actif->ComtAct = $validated['ComtAct'] ?? null;
            $actif->save(); // Sauvegarde de l'actif

            // Création de la donnée associée à cet actif
            $donnee = new Donnee();
            $donnee->IdAct = $actif->IdAct; // Utilisation de l'ID de l'actif créé pour la donnée
            $donnee->FormatData = $validated['FormatData'];
            $donnee->SourceData = $validated['SourceData'];
            $donnee->ResponsabeData = $validated['ResponsabeData'];
            $donnee->NivSensData = $validated['NivSensData'];
            $donnee->StatData = $validated['StatData'];
            $donnee->DatRecpData = now(); // Utilisation de la date et heure actuelles pour la réception
            $donnee->DatMajData = now(); // Utilisation de la date et heure actuelles pour la mise à jour
            $donnee->save(); // Sauvegarde de la donnée

                // Tu pourrais également utiliser la relation entre Actif et Donnee si tu les as définies dans tes modèles


            DB::commit();

            error_log(print_r(DB::getQueryLog(), true));

            return redirect()
                ->route('donnees.index')
                ->with('success', 'Actif de données ajouté avec succès.');
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
    public function edit(Donnee $donnee)
    {
        // Récupérer l'actif associé à la donnée, sinon générer une exception 404 si non trouvé
        $actif = Actif::where('IdAct', $donnee->IdAct)->first(); // Modification ici

        // Vérifiez si l'actif existe, sinon redirigez avec un message d'erreur
        if (!$actif) {
            return redirect()->route('donnees.index')
                             ->with('error', 'Actif associé non trouvé.');
        }

        // Retourner la vue d'édition avec les données
        return view('donnees.edit', compact('donnee', 'actif'));
    }

    public function update(Request $request, $id)
{
    DB::beginTransaction();

    try {
        // Récupérer les données
        $donnee = Donnee::with('actif')->findOrFail($id);

        // Mettre à jour les données de l'actif
        $donnee->actif->update([
            'NomAct' => $request->NomAct,
            'ComtAct' => $request->ComtAct,
        ]);

        // Mettre à jour les données de la table donnees
        $donnee->update([
            'FormatData' => $request->FormatData,
            'SourceData' => $request->SourceData,
            'ResponsabeData' => $request->ResponsabeData,
            'NivSensData' => $request->NivSensData,
            'StatData' => $request->StatData,
        ]);

        DB::commit();

        return redirect()->route('donnees.index')->with('success', 'Données mises à jour avec succès.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
    }
}


    public function destroy(Donnee $donnee)
{
    try {
        DB::beginTransaction();

        // Suppression de l'actif associé
        $actif = Actif::where('IdAct', $donnee->IdAct)->first();

        if ($actif) {
            $actif->delete(); // Suppression de l'actif si trouvé
        }

        // Suppression de la donnée
        $donnee->delete();

        DB::commit();

        return redirect()
            ->route('donnees.index')
            ->with('success', 'Donnée et actif supprimés avec succès.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()
            ->back()
            ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
    }
}

}
