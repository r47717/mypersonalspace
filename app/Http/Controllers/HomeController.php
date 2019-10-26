<?php

namespace App\Http\Controllers;

use App\File;
use App\Idea;
use App\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'tasks' => Task::all(),
            'files' => File::all(),
            'ideas' => Idea::all(),
        ]);
    }
}
