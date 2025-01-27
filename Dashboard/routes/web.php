<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\DonneeController;
use App\Http\Controllers\LogicielController;
use App\Http\Controllers\AttribuerController;
use App\Http\Controllers\AttributionController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Employe;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActifController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/mondash', [DashboardController::class, 'index'])->middleware('auth')->name('mondash');

// Route pour afficher le tableau de bord
Route::get('/mondash', [DashboardController::class, 'index'])
    ->middleware('auth') // Seuls les utilisateurs connectés peuvent accéder
    ->name('mondash');

    Route::get('/test-login', function () {
        $credentials = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('mondash');
        } else {
            return 'Échec de la connexion';
        }
    });

//Route::get('//', [DashboardController::class, 'index'])->name('mondash');
// Route::get('/actifs', [DashboardController::class, 'actifs'])->name('actifs');
Route::get('/utilisateurs', [DashboardController::class, 'utilisateurs'])->name('utilisateurs');

Route::middleware('auth')->group(function () {
    Route::get('/compte/profil', [UserController::class, 'profil'])->name('compte.profil');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/actif-logiciel', [LogicielController::class, 'index'])->name('actif-logiciel');


Route::any('/mondash', [DashboardController::class, 'index'])->name('mondash');

Route::get('donnees.actif-data', [ActifController::class, 'afficherActifs']);



/*Route::get('/actif-materiel', function () {
    return view('actif.create'); // Affiche la vue sans traitement de données
})->name('actif.create');
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mondash', [DashboardController::class, 'index'])->name('mondash');
    Route::get('/compte/profil', [UserController::class, 'profil'])->name('compte.profil');
});

Route::middleware('auth')->group(function () {
    Route::get('/compte/profil', [UserController::class, 'profil'])->name('compte.profil');
    Route::put('/compte/profil/update', [UserController::class, 'update'])->name('compte.profil.update');
});


// Route pour la méthode update2
Route::put('/users/{id}', [UserController::class, 'update2'])->name('users.update2');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');




// Route pour afficher la liste des matériels actifs
Route::get('/materiel/actif-materiel', [MaterielController::class, 'index'])->name('actif-materiel');

// Ressource pour les actions CRUD sur les matériels
Route::resource('materiel', MaterielController::class);

// Ressource pour les actions CRUD sur les logiciels
Route::resource('logiciel', LogicielController::class);

// Afficher le formulaire d'ajout d'un actif
Route::get('/materiel/create', [MaterielController::class, 'create'])->name('materiel.create');

// Ajouter un actif (POST)
Route::post('/materiel', [MaterielController::class, 'store'])->name('materiel.store');



Route::resource('donnees', controller: DonneeController::class);

Route::resource('User_Employe', controller: EmployeController::class);

Route::resource('User_Service', controller: ServiceController::class);

Route::resource('fournisseurs', controller: FournisseurController::class);

Route::resource('maintenance', controller: MaintenanceController::class);

Route::resource('attributions', controller: AttribuerController::class);

Route::resource('categorie', controller: CategorieController::class);


Route::resource('historiques', HistoriqueController::class);

Route::resource('user', controller: UserController::class);

Route::get('/fournisseurs', [FournisseurController::class, 'index'])->name('fournisseurs.index');
Route::post('/fournisseurs', [FournisseurController::class, 'store'])->name('fournisseurs.store');


//attribuer
Route::get('/attributions', [AttribuerController::class, 'index'])->name('attributions.index');
Route::get('/attributions/create', [AttribuerController::class, 'create'])->name('attributions.create');
Route::post('/attributions', [AttribuerController::class, 'store'])->name('attributions.store');

/*Route::get('/attributions', [AttributionController::class, 'index'])->name('attributions.index');
Route::get('/attributions/create', [AttributionController::class, 'create'])->name('attributions.create');
Route::post('/attributions', [AttributionController::class, 'store'])->name('attributions.store');*/
use App\Http\Controllers\NotificationController;
/*
// Route pour marquer toutes les notifications comme lues
Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])
    ->name('notifications.markAllAsRead')
    ->middleware('auth'); // Assurez-vous que l'utilisateur est authentifié

// Définir la route pour afficher les détails d'un logiciel
Route::get('/logiciel/{id}', [LogicielController::class, 'show'])->name('logiciel.actif-logiciel');


Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');

Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');

;

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-as-read/{notificationId}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');
});
*/

/*Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount']);
Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead']);
Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);*/
/*
// Notifications
Route::prefix('/notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');
});*/


Route::middleware('auth')->group(function () {
    // Récupérer le nombre de notifications non lues
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])
        ->name('notifications.unreadCount');

    /// Route pour marquer une notification comme lue
Route::post('/notifications/mark-as-read/{notificationId}', [NotificationController::class, 'markAsRead'])
        ->name('notifications.markAsRead');

    // Marquer toutes les notifications comme lues
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.markAllAsRead');

    // Récupérer la liste des notifications
    Route::get('/layouts', [NotificationController::class, 'index'])
        ->name('layouts.app');
});

