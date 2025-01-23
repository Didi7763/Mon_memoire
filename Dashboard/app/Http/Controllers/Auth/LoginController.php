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
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
