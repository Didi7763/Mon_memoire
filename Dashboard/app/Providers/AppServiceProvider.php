<?php

namespace App\Providers;

use Illuminate\Support\Facades\View; // Import manquant
use Illuminate\Support\Facades\Auth; // Import manquant
use Illuminate\Support\ServiceProvider;
use App\Models\Logiciel;
use App\Observers\LogicielObserver;
use App\Models\Categorie;
use App\Models\Historique;
use App\Observers\CategorieObserver;
use App\Observers\HistoriqueObserver;
use App\Models\GlobalNotification; // Import manquant

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enregistrement des observateurs
        Logiciel::observe(LogicielObserver::class);
        Categorie::observe(CategorieObserver::class);
        Historique::observe(HistoriqueObserver::class);

     // Partagez les notifications non lues avec toutes les vues
     View::composer('*', function ($view) {
        if (Auth::check()) { // Vérifiez si l'utilisateur est authentifié
            $unreadNotifications = GlobalNotification::whereDoesntHave('read_by', function ($query) {
                $query->where('user_id', Auth::id());
            })->latest()->get();

            $unreadCount = $unreadNotifications->count();

            $view->with([
                'unreadNotifications' => $unreadNotifications,
                'unreadCount' => $unreadCount,
            ]);
        } else {
            // Si l'utilisateur n'est pas authentifié, passez des tableaux vides
            $view->with([
                'unreadNotifications' => collect(),
                'unreadCount' => 0,
            ]);
        }
    });
    }
}
