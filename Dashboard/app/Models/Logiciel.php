<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Logiciel extends Model
{
    protected $table = 'logiciels';

    protected $primaryKey = 'id';
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

    public function actif()
    {
        // 'IdAct' dans Donnee est la clé étrangère et 'IdAct' dans Actif est la clé primaire
        return $this->belongsTo(Actif::class, 'IdAct', 'IdAct');
    }
}
