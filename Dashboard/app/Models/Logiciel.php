<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Logiciel extends Model
{
    use Notifiable;
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

    public function fournisseur()
    {
        // 'IdAct' dans Donnee est la clé étrangère et 'IdAct' dans Actif est la clé primaire
        return $this->belongsTo(Fournisseur::class, 'IdFour', 'IdFour');
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'id'); // 'IdFour' est la clé étrangère
    }
}
