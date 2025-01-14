<?php

namespace App\Http\Controllers;

use App\Models\Actif;  // Assure-toi que le modèle Actif est bien importé

class ActifController extends Controller
{
    public function afficherActifs()
    {
        // Récupérer toutes les données de la table 'actifs'
        $actifs = Actif::all();  // Cette ligne récupère toutes les données

        // Passer les données à la vue
        return view('donnees.actif-data', compact('actifs'));
    }
}
