<?php

namespace App\Observers;

use App\Models\Categorie;
use App\Models\GlobalNotification;
use App\Notifications\CategorieNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class CategorieObserver
{
    /**
     * Handle the Categorie "created" event.
     */
    public function created(Categorie $categorie): void
    {

    }

    /**
     * Handle the Categorie "updated" event.
     */
    public function updated(Categorie $categorie)
    {
        // Vérifier si QteStockMat est inférieur à QteMinStockMat
    if ($categorie->QteStockMat <= $categorie->QteMinStockMat) {
        $message = "La quantité en stock pour la catégorie de matériel {$categorie->NomCatMat} est inférieure ou égale au minimum requis. Veuillez vous réapprovisionner svp!";



        // Créer une notification globale
        GlobalNotification::create([
            'message' => $message,
        ]);
    }
    }

    /**
     * Handle the Categorie "deleted" event.
     */
    public function deleted(Categorie $categorie): void
    {

    }

    /**
     * Handle the Categorie "restored" event.
     */
    public function restored(Categorie $categorie): void
    {

    }

    /**
     * Handle the Categorie "force deleted" event.
     */
    public function forceDeleted(Categorie $categorie): void
    {

    }
}
