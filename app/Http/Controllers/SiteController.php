<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index (): View
    {   
        return view('home');
    }

    public function dashboard (): View
    {
        $habits = Auth::user()->habits;

        return view('dashboard', compact('habits'));
    }
}

