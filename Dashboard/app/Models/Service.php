<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'CodeUser';
    public $incrementing = false;
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

}
