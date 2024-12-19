<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\DonneeController;
use App\Http\Controllers\LogicielController;
use App\Http\Controllers\AttribuerController;
use App\Http\Controllers\AttributionController;



Route::get('//', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/actifs', [DashboardController::class, 'actifs'])->name('actifs');
Route::get('/utilisateurs', [DashboardController::class, 'utilisateurs'])->name('utilisateurs');

Route::get('/actif-materiel', [MaterielController::class, 'index'])->name('actif-materiel');

Route::get('/actif-logiciel', [LogicielController::class, 'index'])->name('actif-logiciel');


Route::get('/mondash', [DashboardController::class, 'index'])->name('mondash');

Route::resource('materiels', controller: MaterielController::class);


Route::get('/actif-materiel', function () {
    return view('actif.create'); // Affiche la vue sans traitement de données
})->name('actif.create');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


// Afficher le formulaire d'ajout d'un actif
Route::get('/materiels/create', [MaterielController::class, 'index'])->name('materiels.create');

// Ajouter un actif
Route::post('/materiels', [MaterielController::class, 'store'])->name('materiels.store');

Route::resource('donnees', controller: DonneeController::class);

Route::resource('historiques', HistoriqueController::class);

Route::get('/fournisseurs', [FournisseurController::class, 'index'])->name('fournisseurs.index');
Route::post('/fournisseurs', [FournisseurController::class, 'store'])->name('fournisseurs.store');


//attribuer
Route::get('/attributions', [AttribuerController::class, 'index'])->name('attributions.index');
Route::get('/attributions/create', [AttribuerController::class, 'create'])->name('attributions.create');
Route::post('/attributions', [AttribuerController::class, 'store'])->name('attributions.store');

Route::get('/attributions', [AttributionController::class, 'index'])->name('attributions.index');
Route::get('/attributions/create', [AttributionController::class, 'create'])->name('attributions.create');
Route::post('/attributions', [AttributionController::class, 'store'])->name('attributions.store');