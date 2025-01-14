<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $table = 'fournisseurs';

    protected $primaryKey = 'IdFour';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'IdFour',
        'NomFour',
        'ContFour',
        'EmailFour',
        'AdressFour',
        'TypProdFournit',
        'NomPersCont',
        'NotesFour',
    ];

    public function materiels()
    {
        // 'IdFour' dans Materiel est la clé étrangère
        return $this->hasMany(Materiel::class, 'IdFour', 'IdFour');
    }
}

