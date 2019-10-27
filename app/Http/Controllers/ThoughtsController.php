<?php

namespace App\Http\Controllers;

use App\Thought;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'thoughts' => Thought::where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function add(Request $request)
    {
        $thought = new Thought;
        $thought->text = $request->text;
        $thought->user_id = Auth::user()->id;
        $thought->save();

        return [
            'success' => true,
            'message' => 'new thought has been added',
        ];
    }
}
