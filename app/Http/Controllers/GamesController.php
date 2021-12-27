<?php

namespace App\Http\Controllers;

use App\Models\GamesRegistry;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class GamesController extends BaseController
{
    public function index()
    {
        parent::__construct();
        return view('pages.games.index', [
            'page' => 'games',
            'games' => GamesRegistry::$games,
        ]);
    }

    public function __call($method, $parameters)
    {
        $game = Arr::first(GamesRegistry::$games, function ($value, $key) use ($method) {
            return $method === Str::camel($value['url']);
        });

        if (!empty($game)) {
            return view('pages.games.' . $game['url'], [
                'page' => 'games',
            ]);
        }

        abort(404);
    }
}
