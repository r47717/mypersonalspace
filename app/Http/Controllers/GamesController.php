<?php

namespace App\Http\Controllers;

use App\Models\GameTypes;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index()
    {
        $games = [
            [
                'name' => 'Тетрис',
                'type' => GameTypes::Puzzle,
                'imageUrl' => GameTypes::gameThumbnailUrls[GameTypes::Puzzle],
            ],
            [
                'name' => 'Звёздные войны',
                'type' => GameTypes::Action,
                'imageUrl' => GameTypes::gameThumbnailUrls[GameTypes::Action],
            ]
        ];

        return view('pages.games.index', [
            'page' => 'games',
            'games' => $games,
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
