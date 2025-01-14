<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actif extends Model
{
    use HasFactory;

    // Nom de la table (en cas d'utilisation d'un nom de table différent de "actifs")
    protected $table = 'actifs';

    // Définir la clé primaire de la table actifs
    protected $primaryKey = 'IdAct';

    // Assurez-vous que IdAct n'est pas auto-incrémenté
    public $incrementing = false;  // IdAct n'est pas auto-incrémenté
    protected $keyType = 'string'; // Spécifie que la clé primaire est une chaîne

    // Si vous n'avez pas de champs created_at et updated_at, vous pouvez désactiver les timestamps
    public $timestamps = true; // Si vous avez les colonnes `created_at` et `updated_at`, vous laissez ça sur true

    // Les champs que vous pouvez remplir en masse
    protected $fillable = [
        'IdAct', 'NomAct', 'ComtAct'
    ];

    // Définir la relation avec le modèle Donnee
    public function donnees()
    {
        return $this->hasMany(Donnee::class, 'IdAct', 'IdAct');
        // 'IdAct' dans le modèle Donnee est la clé étrangère, et 'IdAct' dans Actif est la clé primaire
    }

    public function logiciels()
    {
        return $this->hasMany(Logiciel::class, 'IdAct', 'IdAct');
        // 'IdAct' dans le modèle Donnee est la clé étrangère, et 'IdAct' dans Actif est la clé primaire
    }

    public function materiels()
    {
        return $this->hasMany(Materiel::class, 'IdAct', 'IdAct');
        // 'IdAct' dans le modèle Donnee est la clé étrangère, et 'IdAct' dans Actif est la clé primaire
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance ::class, 'IdAct', 'IdAct');
        // 'IdAct' dans le modèle Donnee est la clé étrangère, et 'IdAct' dans Actif est la clé primaire
    }
}
