<?php

namespace App\Http\Controllers;

use App\Models\GamesRegistry;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {
        View::share('gamesList', GamesRegistry::$games);
    }
}
