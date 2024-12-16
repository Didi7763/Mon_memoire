<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribuer extends Model
{
    use HasFactory;

    // Définir la table associée
    protected $table = 'attribuer';

    // Définir les clés primaires si nécessaire
    protected $primaryKey = 'DatAttAct'; // Change si ta clé primaire est différente

    public $incrementing = false; // Si ta clé primaire n'est pas un auto-incrément

    // Les champs qui peuvent être remplis
    protected $fillable = ['DatAttAct', 'IdAct', 'CodeUser'];

    // Relation avec Actif
    public function actif()
    {
        return $this->belongsTo(Actif::class, 'IdAct', 'IdAct');
    }

    // Relation avec Utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'CodeUser', 'CodeUser');
    }
}

