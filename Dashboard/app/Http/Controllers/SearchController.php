<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actif; // Importez les modèles nécessaires
use App\Models\Employe;
use App\Models\Service;
use App\Models\Logiciel;
use App\Models\Materiel;
use App\Models\Fournisseur;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Rechercher dans les actifs
        $actifs = Actif::where('NomAct', 'like', "%$query%")
                       ->orWhere('IdAct', 'like', "%$query%")
                       ->get();

        // Rechercher dans les employés
        $employes = Employe::where('CodeUser1', 'like', "%$query%")
                           ->orWhere('FonctEmp', 'like', "%$query%")
                           ->get();

        // Rechercher dans les services
        $services = Service::where('DesServ', 'like', "%$query%")
                           ->orWhere('NpnomRespServ', 'like', "%$query%")
                           ->get();

        // Rechercher dans les logiciels
        $logiciels = Logiciel::where('VersionLog', 'like', "%$query%")
                             ->orWhere('TypLicLog', 'like', "%$query%")
                             ->get();

        // Rechercher dans les matériels
        $materiels = Materiel::where('MarqMat', 'like', "%$query%")
                             ->orWhere('ModMarq', 'like', "%$query%")
                             ->get();

        // Rechercher dans les fournisseurs
        $fournisseurs = Fournisseur::where('NomFour', 'like', "%$query%")
                                   ->orWhere('EmailFour', 'like', "%$query%")
                                   ->get();

        // Retourner les résultats à la vue
        return view('search.results', [
            'actifs' => $actifs,
            'employes' => $employes,
            'services' => $services,
            'logiciels' => $logiciels,
            'materiels' => $materiels,
            'fournisseurs' => $fournisseurs,
            'query' => $query,
        ]);
    }
}