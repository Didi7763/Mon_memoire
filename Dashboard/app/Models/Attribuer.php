<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribuer extends Model
{
    use HasFactory;

    protected $table = 'attribuer';

    protected $fillable = ['IdAct', 'CodeUser', 'NumAdmin', 'DatAttAct'];

    public function actif()
    {
        return $this->belongsTo(Actif::class, 'IdAct', 'IdAct');
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'CodeUser', 'CodeUser');
    }
}
