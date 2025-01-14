<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    protected $table = 'materiels';

    protected $primaryKey = 'id';

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

    public function actif()
    {
        // 'IdAct' dans Materiel est la clé étrangère et 'IdAct' dans Actif est la clé primaire
        return $this->belongsTo(Actif::class, 'IdAct', 'IdAct');
    }

    public function fournisseur()
    {
        // 'IdFour' dans Materiel est la clé étrangère et 'IdFour' dans Fournisseur est la clé primaire
        return $this->belongsTo(Fournisseur::class, 'IdFour', 'IdFour');
    }

    public function categorie()
    {
        // 'RefCatMat' dans Materiel est la clé étrangère et 'RefCatMat' dans Categorie est la clé primaire
        return $this->belongsTo(Categorie::class, 'RefCatMat', 'RefCatMat');
    }
}
