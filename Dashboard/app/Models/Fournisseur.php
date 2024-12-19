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
}

