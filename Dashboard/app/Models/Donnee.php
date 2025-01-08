<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donnee extends Model
{
    protected $table = 'donnees';

    protected $fillable = [
        'IdAct',
        'FormatData',
        'SourceData',
        'ResponsabeData',
        'NivSensData',
        'StatData',
        'DatRecpData',
        'DatMajData'
    ];

    // Définir la relation avec le modèle Actif
    public function actif()
    {
        return $this->belongsTo(Actif::class, 'IdAct', 'IdAct');
    }
}
