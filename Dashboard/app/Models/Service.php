<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'CodeUser',
        'DesServ',
        'NpnomRespServ'
    ];

    // Relation inverse avec Utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'CodeUser', 'CodeUser');
    }
    public function employes()
{
    return $this->hasMany(Employe::class, 'CodeUser', 'CodeUser');
}



}
