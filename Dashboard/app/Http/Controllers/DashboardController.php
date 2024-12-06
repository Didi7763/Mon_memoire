<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function actifs()
    {
        return view('dashboard.actifs');
    }

    public function utilisateurs()
    {
        return view('dashboard.utilisateurs');
    }

    // Ajoutez des méthodes pour les autres sections.
}

