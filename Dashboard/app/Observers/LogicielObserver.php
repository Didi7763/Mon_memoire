<?php

namespace App\Observers;

use App\Models\Logiciel;
use App\Models\User;
use App\Notifications\LogicielNotification;
use App\Models\GlobalNotification;
use Carbon\Carbon;
use App\Models\Notification;

class LogicielObserver
{
    /**
     * Handle the Logiciel "created" event.
     */
    public function created(Logiciel $logiciel): void
    {

    }

    /**
     * Handle the Logiciel "updated" event.
     */
    public function updated(Logiciel $logiciel): void
    {
        // Vérifier si NbrLicLog est inférieur ou égal à NbrMinLicLog
        if ($logiciel->NbrLicLog <= $logiciel->NbrMinLicLog) {
                $message = "Le nombre de licences pour le logiciel {$logiciel->IdAct} est inférieur ou égal au minimum requis.";

                // Créer une notification globale
                GlobalNotification::create([
                    'message' => $message,
                ]);

        }

        // Vérifier si la date d'expiration est dans 15 jours
        if (now()->diffInDays($logiciel->DatExpLog) <= 15) {
            $message = "La licence du logiciel {$logiciel->IdAct} expire dans 15 jours.";


           // Créer une notification globale
           GlobalNotification::create([
            'message' => $message,
        ]);

        }
    }

    /**
     * Handle the Logiciel "deleted" event.
     */
    public function deleted(Logiciel $logiciel): void
    {

    }

    /**
     * Handle the Logiciel "restored" event.
     */
    public function restored(Logiciel $logiciel): void
    {

    }

    /**
     * Handle the Logiciel "force deleted" event.
     */
    public function forceDeleted(Logiciel $logiciel): void
    {

    }
}
