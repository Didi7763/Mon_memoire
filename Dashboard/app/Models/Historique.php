<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Historique extends Model
{
    use Notifiable;
    protected $table = 'historiques';

    protected $primaryKey = 'NumHist';

    protected $fillable = [
        'DatAction',
        'DesAction',
        'IdAct',
    ];

    // Relation avec la table actifs
    public function actif()
    {
        return $this->belongsTo(Actif::class, 'IdAct', 'IdAct');
    }
}
