<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    public function index () {
        
        $name = "vinicius";
        $habits =['Jogar', 'Estudar programação', 'Videogames', 'Dormir'];

        return view('home', [
            'name' => $name,
            'habits' => $habits
        ]);
    }
}
