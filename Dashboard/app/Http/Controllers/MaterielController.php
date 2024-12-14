<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function actifss()
    {
        return view('actif-materiel');
    }
}
