<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index()
    {
        return view('games/GamesMain');
    }

    public function challenge()
    {
        return view('games/GamesChallenge');
    }
}