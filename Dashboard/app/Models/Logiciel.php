<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Logiciel extends Model
{
    protected $table = 'logiciels';
    
    protected $fillable = [
        'IdAct',
        'VersionLog',
        'TypLicLog',
        'NbrLicLog',
        'NbrMinLicLog',
        'CleLicLog',
        'DatAchLog',
        'DatExpLog',
        'IdFour'
    ];
}