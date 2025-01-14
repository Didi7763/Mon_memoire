<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donnee extends Model
{
    // Nom de la table (en cas de nom de table différent de "donnees")
    protected $table = 'donnees';

    // La clé primaire de la table donnees, vous devez probablement avoir une autre clé primaire pour cette table
    // mais en l'absence de cette information, je suppose que 'IdAct' est une clé étrangère et non une clé primaire.
    // Il est donc préférable de définir une autre clé primaire pour cette table si elle existe.
    // Par exemple :
     protected $primaryKey = 'id';  // Si 'id' est la clé primaire de cette table

    // Si vous avez des champs created_at et updated_at, laissez $timestamps à true.
    // Si non, mettez-le à false
    public $timestamps = true; // Si vous avez `created_at` et `updated_at` dans la table

    // Les champs que vous pouvez remplir en masse
    protected $fillable = [
        'IdAct', 'FormatData', 'SourceData', 'ResponsabeData',
        'NivSensData', 'StatData', 'DatRecpData', 'DatMajData'
    ];

    // Définir la relation inverse avec Actif
    public function actif()
    {
        // 'IdAct' dans Donnee est la clé étrangère et 'IdAct' dans Actif est la clé primaire
        return $this->belongsTo(Actif::class, 'IdAct', 'IdAct');
    }
}
