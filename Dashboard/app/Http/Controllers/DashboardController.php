<?php
namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Donnee;
use App\Models\Materiel;
use App\Models\Logiciel;
use App\Models\Employe;
use App\Models\Actif;
use App\Models\Fournisseur;
use App\Models\Categorie;
use App\Models\Maintenance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est connecté
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Compter les entités
        $countUtilisateurs = Utilisateur::count();
        $countDonnees = Donnee::count();
        $countMateriels = Materiel::count();
        $countLogiciels = Logiciel::count();
        $countEmployes = Employe::count();
        $countFournisseurs = Fournisseur::count();

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

        // Logiciels critiques
        $logicielsCritiques = Logiciel::where('NbrLicLog', '<=', 'NbrMinLicLog')
            ->orderBy('NbrLicLog', 'asc')
            ->take(5)
            ->get();

        // Catégories de matériels en rupture de stock
        $categoriesRuptureStock = Categorie::where('QteStockMat', '<', 'QteMinStockMat')
            ->orderBy('QteStockMat', 'asc')
            ->take(5)
            ->get();

        // Répartition des actifs par type
        $repartitionActifs = Actif::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        // Répartition des employés par statut
        $repartitionEmployes = Employe::select('StatEmp', DB::raw('count(*) as count'))
            ->groupBy('StatEmp')
            ->get();

        // Répartition des fournisseurs par type de produit
        $repartitionFournisseurs = Fournisseur::select('TypProdFournit', DB::raw('count(*) as count'))
            ->groupBy('TypProdFournit')
            ->get();

        // Maintenances imminentes (dans les 15 prochains jours)
        $maintenancesImminentes = Maintenance::whereBetween('DatProchMaint', [now(), now()->addDays(15)])
            ->with('actif')
            ->get();

        // Répartition des données par niveau de sensibilité
        $repartitionDonnees = Donnee::select('NivSensData', DB::raw('count(*) as count'))
            ->groupBy('NivSensData')
            ->get();

        // Répartition des logiciels par type de licence
        $repartitionLogiciels = Logiciel::select('TypLicLog', DB::raw('count(*) as count'))
            ->groupBy('TypLicLog')
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
            'countEmployes',
            'countFournisseurs',
            'topMateriels',
            'topDonnees',
            'topLogiciels',
            'logicielsCritiques',
            'categoriesRuptureStock',
            'repartitionActifs',
            'repartitionEmployes',
            'repartitionFournisseurs',
            'maintenancesImminentes',
            'repartitionDonnees',
            'repartitionLogiciels',
            'userEvolution',
            'user'
        ));
    }
}
