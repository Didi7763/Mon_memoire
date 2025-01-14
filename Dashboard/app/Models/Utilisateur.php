<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'CodeUser';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'CodeUser',
        'NomCompUser',
        'ContactUser',
        'EmailUser'
    ];

    // Relation avec Employe
    public function employe()
    {
        return $this->hasMany(Employe::class, 'CodeUser', 'CodeUser');
    }

    // Relation avec Service
    public function service()
    {
        return $this->hasMany(Service::class, 'CodeUser', 'CodeUser');
    }
}
