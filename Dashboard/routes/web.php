<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\MondashController;
use App\Http\Controllers\ActifMatController; 

Route::get('//', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/actifs', [DashboardController::class, 'actifs'])->name('actifs');
Route::get('/utilisateurs', [DashboardController::class, 'utilisateurs'])->name('utilisateurs');

Route::get('/actif-materiel', [MaterielController::class, 'index'])->name('actif-materiel');

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
Route::get('/materiels/create', [MaterielController::class, 'create'])->name('materiels.create');

// Ajouter un actif
Route::post('/materiels', [MaterielController::class, 'store'])->name('materiels.store');
