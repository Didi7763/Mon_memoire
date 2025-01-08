<?php

namespace App\Http\Controllers;

use App\Models\Donnee;
use App\Models\Actif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Valider les données entrantes
        $validated = $request->validate([
            'IdAct' => 'required|string|max:255|unique:actifs,IdAct',
            'NomAct' => 'required|string|max:255',
            'ComtAct' => 'nullable|string',
            'FormatData' => 'required|string|max:255',
            'SourceData' => 'required|string|max:255',
            'ResponsableData' => 'required|string|max:255',
            'NivSensData' => 'required|string|in:Public,Interne,Confidentiel,Discrets',
            'StatData' => 'required|string|in:en création,active,stockée,obsolète,supprimée',
        ]);

        try {
            // Début d'une transaction
            DB::beginTransaction();

            // Création de l'actif
            $actif = Actif::create([
                'IdAct' => $validated['IdAct'],
                'NomAct' => $validated['NomAct'],
                'ComtAct' => $validated['ComtAct'] ?? null,
            ]);

            // Vérifier si l'actif a été créé avec succès
            if (!$actif) {
                throw new \Exception('Échec lors de la création de l\'actif.');
            }

            // Création de la donnée associée
            $donnee = Donnee::create([
                'IdActif' => $validated['IdAct'],
                'FormatData' => $validated['FormatData'],
                'SourceData' => $validated['SourceData'],
                'ResponsableData' => $validated['ResponsableData'],
                'NivSensData' => $validated['NivSensData'],
                'StatData' => $validated['StatData'],
                'DatRecpData' => now(),
                'DatMajData' => now(),
            ]);

            // Vérifier si la donnée a été créée avec succès
            if (!$donnee) {
                throw new \Exception('Échec lors de la création de la donnée.');
            }

            // Valider la transaction
            DB::commit();

            // Rediriger avec un message de succès
            return redirect()
                ->route('donnees.index')
                ->with('success', 'Actif de données ajouté avec succès.');
        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();

            // Rediriger avec un message d'erreur
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de l\'ajout : ' . $e->getMessage());
        }
    }


    public function edit(Donnee $donnee)
    {
        $actif = Actif::where('IdAct', $donnee->IdActif)->firstOrFail();
        return view('donnees.edit', compact('donnee', 'actif'));
    }

    public function update(Request $request, Donnee $donnee)
    {
        $validated = $request->validate([
            'NomAct' => 'required|string|max:255',
            'ComtAct' => 'nullable|string',
            'FormatData' => 'required|string|max:255',
            'SourceData' => 'required|string|max:255',
            'ResponsableData' => 'required|string|max:255',
            'NivSensData' => 'required|string|in:Public,Interne,Confidentiel,Discrets',
            'StatData' => 'required|string|in:en création,active,stockée,obsolète,supprimée',
        ]);

        try {
            DB::beginTransaction();

            // Mise à jour de l'actif
            $actif = Actif::where('IdAct', $donnee->IdActif)->firstOrFail();
            $actif->NomAct = $validated['NomAct'];
            $actif->ComtAct = $validated['ComtAct'] ?? null;
            $actif->save();

            // Mise à jour de la donnée
            $donnee->FormatData = $validated['FormatData'];
            $donnee->SourceData = $validated['SourceData'];
            $donnee->ResponsableData = $validated['ResponsableData'];
            $donnee->NivSensData = $validated['NivSensData'];
            $donnee->StatData = $validated['StatData'];
            $donnee->DatMajData = now();
            $donnee->save();

            DB::commit();

            return redirect()
                ->route('donnees.index')
                ->with('success', 'Actif de données mis à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function destroy(Donnee $donnee)
    {
        try {
            DB::beginTransaction();

            // Suppression de l'actif associé
            Actif::where('IdAct', $donnee->IdActif)->delete();
            // La donnée sera automatiquement supprimée si vous avez configuré
            // la contrainte de clé étrangère avec onDelete('cascade')

            DB::commit();

            return redirect()
                ->route('donnees.index')
                ->with('success', 'Actif de données supprimé avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}
