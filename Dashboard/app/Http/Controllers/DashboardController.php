<?php
namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Donnee;
use App\Models\Materiel;
use App\Models\Logiciel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Assurez-vous que les variables sont bien définies
        $countUtilisateurs = Utilisateur::count() ?? 0;
        $countDonnees = Donnee::count() ?? 0;
        $countMateriels = Materiel::count() ?? 0;
        $countLogiciels = Logiciel::count() ?? 0;

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

        $userEvolution = Utilisateur::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(7)
            ->get()
            ->reverse();

        // Assurez-vous que toutes les variables sont passées à la vue
        return view('mondash', compact(
            'countUtilisateurs',
            'countDonnees',
            'countMateriels',
            'countLogiciels',
            'topMateriels',
            'topDonnees',
            'topLogiciels',
            'userEvolution'
        ));
    }
}