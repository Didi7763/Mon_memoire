<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categorie_materiels';
    protected $primaryKey = 'RefCatMat';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'RefCatMat',
        'NomCatMat',
        'QteStockMat',
        'QteMinStockMat',
        'NoteCatMat'
    ];

    public function materiels()
    {
        // 'RefCatMat' dans Materiel est la clé étrangère
        return $this->hasMany(Materiel::class, 'RefCatMat', 'RefCatMat');
    }
}
