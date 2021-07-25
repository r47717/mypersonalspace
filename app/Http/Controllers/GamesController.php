<?php

namespace App\Http\Controllers;

use App\Models\GamesRegistry;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index()
    {
        return view('pages.games.index', [
            'page' => 'games',
            'games' => GamesRegistry::$games,
        ]);
    }

    public function tetris()
    {
        return view('pages.games.tetris', [
            'page' => 'games',
        ]);
    }

    public function starWars()
    {
        return view('pages.games.star-wars', [
            'page' => 'games',
        ]);
    }
}
