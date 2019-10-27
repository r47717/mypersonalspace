<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /**
     * NotesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return [
            'notes' => Note::where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function add(Request $request)
    {
        $note = new Note;
        $note->text = $request->text;
        $note->user_id = Auth::user()->id;
        $note->save();

        return [
            'success' => true,
            'message' => 'New note with id ' . $note->id . ' has been added',
        ];
    }
}
