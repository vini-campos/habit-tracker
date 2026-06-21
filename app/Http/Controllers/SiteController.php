<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    public function index () {
        
        $name = "vinicius";
        $habits =['Jogar', 'Estudar programação', 'Videogames', 'Dormir'];

        // compact passa a variavel direto para a view somente com o nome
        return view('home', compact('name', 'habits'));
    }

    public function dashboard ()
    {
        return view('dashboard');
    }
}

