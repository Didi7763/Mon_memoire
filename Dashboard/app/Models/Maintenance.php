<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    // Nom de la table associée
    protected $table = 'maintenances';

    // Clé primaire de la table
    protected $primaryKey = 'NumMaint';
    public $incrementing = true;
    protected $keyType = 'integer';

    // Colonnes pouvant être massivement assignées
    protected $fillable = [
        'NumMaint',
        'DesMaint',
        'TypMaint',
        'DatMaint',
        'NomTechMaint',
        'CoutMaint',
        'DatProchMaint',
        'ComtMaint',
        'IdAct', // Clé étrangère vers actif
    ];

    // Définition de la relation inverse avec Actif
    public function actif()
    {
        return $this->belongsTo(Actif::class, 'IdAct', 'IdAct');
    }
}
