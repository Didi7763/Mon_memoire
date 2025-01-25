<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribuer extends Model
{
    use HasFactory;
    protected $table = 'attribuer';


    protected $fillable = ['IdAct', 'CodeUser', 'NumAdmin', 'DatAttAct'];

    // Relation avec le modèle Actif
    public function actif()
    {
        return $this->belongsTo(Actif::class, 'IdAct');
    }

    // Relation avec le modèle Utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'CodeUser');
    }

    // Relation avec le modèle Admin
    public function user()
    {
        return $this->belongsTo(User::class, 'NumAdmin', 'id');
    }
}

