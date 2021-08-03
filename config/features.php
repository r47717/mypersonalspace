<?php

return [
    'today' => env('FEATURES_TODAY', true),
    'tasks' => env('FEATURES_TASKS', true),
    'books' => env('FEATURES_BOOKS', true),
    'links' => env('FEATURES_LINKS', true),
    'achievements' => env('FEATURES_ACHIEVEMENTS', true),
    'shop' => env('FEATURES_SHOP', true),
    'quotes' => env('FEATURES_QUOTES', true),
    'notes' => env('FEATURES_NOTES', true),
    'thoughts' => env('FEATURES_THOUGHTS', true),

    'games' => [
        'chess' => env('FEATURES_GAMES_CHESS', false),
    ]
];
