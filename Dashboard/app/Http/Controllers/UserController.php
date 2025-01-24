<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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

    // Mettre à jour le profil de l'utilisateur
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
        'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
    if ($request->hasFile('profile_photo_path')) {
        // Supprimer l'ancienne photo si elle existe
        if ($user->profile_photo_path && Storage::exists('public/' . $user->profile_photo_path)) {
            Storage::delete('public/' . $user->profile_photo_path);
        }

        // Enregistrer la nouvelle photo
        $path = $request->file('profile_photo_path')->store('photos', 'public');
        $user->profile_photo_path = $path;
    }

    // Sauvegarder les modifications
    try {
        if ($user instanceof User) {
            $user->save();
        } else {
            throw new \Exception('L\'objet $user n\'est pas une instance de User.');
        }
    } catch (\Exception $e) {
        Log::error('Erreur lors de la sauvegarde de l\'utilisateur : ' . $e->getMessage());
        return redirect()->route('compte.profil')->with('error', 'Une erreur est survenue lors de la mise à jour du profil.');
    }

    // Rediriger avec un message de succès
    return redirect()->route('compte.profil')->with('success', 'Profil mis à jour avec succès.');
}
    // Afficher le formulaire de création d'utilisateur
    public function create()
    {
        return view('user.create');
    }

    // Traiter la soumission du formulaire d'inscription
public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'NomCompUser' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'StatAdmin' => 'nullable|string|in:actif,inactif',
        'ListAccApp' => 'nullable|array',
        'ListPermApp' => 'nullable|array',
        'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Hashage du mot de passe
    $hashedPassword = Hash::make($request->password);

    // Création de l'utilisateur sans la photo de profil
    try {
        $user = User::create([
            'name' => $request->name,
            'NomCompUser' => $request->NomCompUser,
            'email' => $request->email,
            'password' => $hashedPassword,
            'StatAdmin' => $request->StatAdmin ?? 'inactif', // Valeur par défaut
            'ListAccApp' => json_encode($request->ListAccApp ?? []),
            'ListPermApp' => json_encode($request->ListPermApp ?? []),
            'profile_photo_path' => null, // Initialiser à null
        ]);
    } catch (\Exception $e) {
        Log::error('Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());
        return redirect()->route('user.create')->with('error', 'Une erreur est survenue lors de la création de l\'utilisateur.');
    }

    // Gestion de la photo de profil
    if ($request->hasFile('profile_photo_path')) {
        try {
            // Stocker le fichier et récupérer le chemin
            $photoPath = $request->file('profile_photo_path')->store('photos', 'public');

            // Mettre à jour l'utilisateur avec le chemin de la photo
            $user->profile_photo_path = $photoPath;
            $user->save(); // Sauvegarder les modifications
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'upload de la photo de profil : ' . $e->getMessage());
            return redirect()->route('user.create')->with('error', 'Une erreur est survenue lors de l\'upload de la photo de profil.');
        }
    }

    // Redirection avec un message de succès
    return redirect()->route('user.create')->with('success', 'Utilisateur créé avec succès !');
}

public function index()
{
    // Ajout d'une virgule manquante dans la fonction view()
    $users = User::paginate(10); // Récupère les matériels avec pagination
    return view('user.index', compact('users')); // Correction de la syntaxe pour 'compact'
}


public function edit($id)
{
    $user = User::findOrFail($id);

    // Liste complète des accès et permissions (comme dans create.blade.php)
    $allAccessList = ['données', 'logiciels', 'matériels', 'catégories', 'employes', 'services', 'fournisseurs', 'attribution', 'maintenances', 'historiques', 'nouveau compte', 'tous comptes'];
    $allPermissionList = ['create', 'edit', 'delete'];

    // Accès et permissions déjà sélectionnés pour l'utilisateur (décodés depuis le JSON)
    $userAccessList = json_decode($user->ListAccApp, true) ?? [];
    $userPermissionList = json_decode($user->ListPermApp, true) ?? [];

    return view('user.edit', [
        'user' => $user,
        'allAccessList' => $allAccessList,
        'allPermissionList' => $allPermissionList,
        'userAccessList' => $userAccessList,
        'userPermissionList' => $userPermissionList,
    ]);
}


public function update2(Request $request, $id)
{
    // Vérifie si l'utilisateur est authentifié
    $authUser = Auth::user();

    if (!$authUser) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
    }

    // Récupère l'utilisateur à mettre à jour
    $user = User::findOrFail($id);

    // Validation des données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'NomCompUser' => 'required|string|max:255|unique:users,NomCompUser,' . $user->id,
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'StatAdmin' => 'nullable|string|in:actif,inactif',
        'ListAccApp' => 'nullable|array',
        'ListPermApp' => 'nullable|array',
        'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Mise à jour des champs de l'utilisateur
    $user->name = $request->name;
    $user->NomCompUser = $request->NomCompUser;
    $user->email = $request->email;
    $user->StatAdmin = $request->StatAdmin ?? 'inactif';
    $user->ListAccApp = json_encode($request->ListAccApp ?? []);
    $user->ListPermApp = json_encode($request->ListPermApp ?? []);

    // Mise à jour du mot de passe si fourni
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    // Gestion de la photo de profil
    if ($request->hasFile('profile_photo_path')) {
        // Supprime l'ancienne photo si elle existe
        if ($user->profile_photo_path && Storage::exists('public/' . $user->profile_photo_path)) {
            Storage::delete('public/' . $user->profile_photo_path);
        }

        // Stocke la nouvelle photo
        $path = $request->file('profile_photo_path')->store('photos', 'public');
        $user->profile_photo_path = $path;
    }

    // Sauvegarde des modifications
    try {
        $user->save();
    } catch (\Exception $e) {
        Log::error('Erreur lors de la sauvegarde de l\'utilisateur : ' . $e->getMessage());
        return redirect()->route('user.index')->with('error', 'Une erreur est survenue lors de la mise à jour du profil.');
    }

    // Redirection avec un message de succès
    return redirect()->route('user.index')->with('success', 'Profil mis à jour avec succès.');
}


public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'compte supprimé avec succès.');
    }

}
