<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'employes';
    protected $primaryKey = 'CodeUser1';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'CodeUser1',
        'FonctEmp',
        'StatEmp',
        'ListActif',
        'CodeUser' // Clé étrangère vers Service
    ];

    // Relation inverse avec Utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'CodeUser1', 'CodeUser');
    }

    // Relation avec Service
    public function service()
    {
        return $this->belongsTo(Service::class, 'CodeUser', 'CodeUser');
    }
}
