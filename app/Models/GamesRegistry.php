<?php

namespace App\Models;

abstract class GamesRegistry
{
    const Puzzle = 'головоломка';
    const Action = 'экшен';

    public const gameThumbnailUrls = [
        GamesRegistry::Action => '/images/games-puzzle.png',
        GamesRegistry::Puzzle => '/images/games-action.png',
    ];

    public static $games = [
        [
            'name' => 'Тетрис',
            'type' => GamesRegistry::Puzzle,
            'url' => 'tetris',
        ],
        [
            'name' => 'Звёздные войны',
            'type' => GamesRegistry::Action,
            'url' => 'star-wars',
        ],
        [
            'name' => 'Шарики',
            'type' => GamesRegistry::Action,
            'url' => 'balls',
        ],
        [
            'name' => 'Змейка',
            'type' => GamesRegistry::Action,
            'url' => 'snake',
        ],
        [
            'name' => 'Игра 15',
            'type' => GamesRegistry::Puzzle,
            'url' => 'game15',
        ],
    ];

}


