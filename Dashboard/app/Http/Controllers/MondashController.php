<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MondashController extends Controller
{
    public function index()
    {
        // Données fictives par défaut
        $nombreUtilisateurs = 1;
        $nombreActifs = 0;
        $topMateriels = [];
        $topDonnees = [];
        $topLogiciels = [];

        // Retourne la vue avec les données
        return view('mondash', compact(
            'nombreUtilisateurs',
            'nombreActifs',
            'topMateriels',
            'topDonnees',
            'topLogiciels'
        ));
    }
}

