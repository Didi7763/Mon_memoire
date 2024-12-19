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
}