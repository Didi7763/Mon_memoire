<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'NumAdmin';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'NumAdmin',
        'NomCompAdmin',
        'NomCompUser',
        'MotPassUser',
        'StatAdmin',
        'ListAccApp',
        'DateCreationCompt',
        'ListPermApp',
        'UrlPhotoAdmin'
    ];

   
}
