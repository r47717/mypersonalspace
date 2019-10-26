<?php

namespace App\Http\Controllers;

use App\File;
use App\Idea;
use Illuminate\Http\Request;

class IdeasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        $idea = new Idea;
        $idea->description = $request->description;
        $idea->save();

        return [
            'success' => true,
            'message' => 'new idea saved',
        ];
    }
}
