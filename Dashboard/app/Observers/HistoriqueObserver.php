<?php

namespace App\Observers;

use App\Models\Historique;
use App\Notifications\HistoriqueNotification;
use App\Models\User;
use App\Models\GlobalNotification;
class HistoriqueObserver
{
    /**
     * Handle the Historique "created" event.
     */
    public function created(Historique $historique): void
    {
        $message = $historique->DesAction;
         // Récupérer l'utilisateur à notifier (par exemple, un administrateur)


         // Créer une notification globale
         GlobalNotification::create([
             'message' => $message,

         ]);

    }

    /**
     * Handle the Historique "updated" event.
     */
    public function updated(Historique $historique): void
    {

    }

    /**
     * Handle the Historique "deleted" event.
     */
    public function deleted(Historique $historique): void
    {

    }

    /**
     * Handle the Historique "restored" event.
     */
    public function restored(Historique $historique): void
    {

    }

    /**
     * Handle the Historique "force deleted" event.
     */
    public function forceDeleted(Historique $historique): void
    {

    }
}
