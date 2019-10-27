<?php

namespace App\Http\Controllers;

use App\Thought;
use Illuminate\Http\Request;

class ThoughtsController extends Controller
{

    /**
     * ThoughtsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return [
            'thoughts' => Thought::all(),
        ];
    }

    public function add(Request $request)
    {
        $thought = new Thought;
        $thought->text = $request->text;
        $thought->save();

        return [
            'success' => true,
            'message' => 'new thought has been added',
        ];
    }
}
