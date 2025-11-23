<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Página de inicio
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Página de inicio (alias)
     */
    public function index()
    {
        return view('welcome');
    }
}
