<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterielController;

Route::get('//', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/actifs', [DashboardController::class, 'actifs'])->name('actifs');
Route::get('/utilisateurs', [DashboardController::class, 'utilisateurs'])->name('utilisateurs');

Route::get('/actifss', [MaterielController::class, 'actifss']);

Route::get('/', function () {
    return view('welcome');
});

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

