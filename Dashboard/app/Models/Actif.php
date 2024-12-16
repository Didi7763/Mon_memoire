<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actif extends Model
{
    use HasFactory;

    protected $table = 'actif';


    // Vous pouvez également définir les propriétés et relations ici
    protected $fillable = ['nom', 'type', 'utilisations'];

    public function attributions()
{
    return $this->hasMany(Attribuer::class, 'IdAct', 'IdAct');
}

}

