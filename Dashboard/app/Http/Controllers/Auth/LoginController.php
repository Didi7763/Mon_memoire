<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login'); // Assurez-vous que la vue existe
    }

    // Traiter la soumission du formulaire de connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        logger('Tentative de connexion avec les informations : ', $credentials);

        if (Auth::attempt($credentials, $request->remember)) {

            // Récupérer l'utilisateur connecté
            $user = Auth::user();

            // Mettre à jour le statut en ligne
            $user->is_online = true;
            if ($user instanceof User) {
                $user->save();
            }
            // Décoder les fichiers JSON ListAccApp et ListPermApp
        $ListAccApp = json_decode($user->ListAccApp, true) ?? [];
        $ListPermApp = json_decode($user->ListPermApp, true) ?? [];

        // Stocker les accès, permissions et photo de profil dans la session
        session([
            'ListAccApp' => $ListAccApp,
            'ListPermApp' => $ListPermApp,
            'profile_photo_path' => $user->profile_photo_path, // Lien de la photo de profil
        ]);

            logger('Connexion réussie pour l\'utilisateur : ' . Auth::user()->email);
            $request->session()->regenerate();
            return redirect()->route('mondash');
        } else {
            logger('Échec de la connexion pour l\'email : ' . $request->email);
            return back()->withErrors([
                'email' => 'Les informations de connexion sont incorrectes.',
            ]);
        }
    }

    // Déconnexion
    public function logout(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
        $user->is_online = false;
            if ($user instanceof User) {
                $user->save();
            }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
