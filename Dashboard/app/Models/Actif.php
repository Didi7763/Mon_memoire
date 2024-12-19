<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actif extends Model
{
    use HasFactory;

    // Lier le modèle à la table 'actifs'
    protected $table = 'actifs';

    // Colonnes mass-assignables
    protected $fillable = ['NomAct', 'ComtAct'];

    // Relation avec la table "attribuer"
    public function attributions()
    {
        return $this->hasMany(Attribuer::class, 'IdAct', 'IdAct');
    }
}
