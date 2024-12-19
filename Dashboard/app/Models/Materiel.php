<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    protected $table = 'materiels';
    
    protected $fillable = [
        'IdAct',
        'MarqMat',
        'ModMarq',
        'NumSerieMat',
        'DatAcqMat',
        'StatMat',
        'QteMat',
        'DureVieMat',
        'IdFour',
        'RefCatMat'
    ];
}