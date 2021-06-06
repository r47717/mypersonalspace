<?php

namespace App\Models;

abstract class GameTypes
{
    const Puzzle = 'головоломка';
    const Action = 'экшен';

    const gameThumbnailUrls = [
        GameTypes::Action => '/images/games-puzzle.png',
        GameTypes::Puzzle => '/images/games-action.png',
    ];
}
