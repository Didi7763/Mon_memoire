<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    // Afficher le profil de l'utilisateur
    public function profil()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est connecté
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Retourner la vue avec les données de l'utilisateur
        return view('compte.profil', compact('user'));
    }

    public function update(Request $request)
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Vérifier si l'utilisateur est connecté
    if (!$user) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
    }

    // Valider les données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Mettre à jour le nom et l'email
    $user->name = $request->name;
    $user->email = $request->email;

    // Mettre à jour le mot de passe si fourni
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    // Gérer l'upload de la photo de profil
    if ($request->hasFile('profile_photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($user->profile_photo) {
            Storage::delete('public/' . $user->profile_photo);
        }

        // Enregistrer la nouvelle photo
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo = $path;
    }

    // Sauvegarder les modifications
    $user->save(); // Assurez-vous que $user est bien une instance de User

    // Rediriger avec un message de succès
    return redirect()->route('compte.profil')->with('success', 'Profil mis à jour avec succès.');
}
}