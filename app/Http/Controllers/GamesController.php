<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index()
    {
        return view('pages.games.index', [
            'page' => 'games',
        ]);
    }
}
