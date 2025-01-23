<?php
namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Donnee;
use App\Models\Materiel;
use App\Models\Logiciel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Vérifier si l'utilisateur est connecté (redondant grâce au middleware, mais utile pour le debug)
    if (!$user) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
    }

    // Compter les entités
    $countUtilisateurs = Utilisateur::count();
    $countDonnees = Donnee::count();
    $countMateriels = Materiel::count();
    $countLogiciels = Logiciel::count();

    // Récupérer les tops
    $topMateriels = Materiel::select('MarqMat', 'ModMarq', 'QteMat')
        ->orderBy('QteMat', 'desc')
        ->take(5)
        ->get();

    $topDonnees = Donnee::select('SourceData', 'DatRecpData')
        ->orderBy('DatRecpData', 'desc')
        ->take(5)
        ->get();

    $topLogiciels = Logiciel::select('VersionLog', 'NbrLicLog')
        ->orderBy('NbrLicLog', 'desc')
        ->take(5)
        ->get();

    // Évolution des utilisateurs
    $userEvolution = Utilisateur::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->take(7)
        ->get()
        ->reverse();

    // Retourner la vue avec les données
    return view('mondash', compact(
        'countUtilisateurs',
        'countDonnees',
        'countMateriels',
        'countLogiciels',
        'topMateriels',
        'topDonnees',
        'topLogiciels',
        'userEvolution',
        'user' // Ajoutez l'utilisateur connecté à la vue
    ));
}
}