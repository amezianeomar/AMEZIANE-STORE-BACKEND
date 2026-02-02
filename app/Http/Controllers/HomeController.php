<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Affiche la page des catégories
     */
    public function categories()
    {
        return view('Categories');
    }

    /**
     * Affiche la page À propos
     */
    public function about()
    {
        return view('A_propos');
    }

    /**
     * Affiche la page Contact
     */
    public function contact()
    {
        return view('Contact');
    }
}
