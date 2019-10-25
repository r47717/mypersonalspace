<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

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
        $notes = Note::all();

        return view('notes', [
            'notes' => $notes,
        ]);
    }

    public function add(Request $request)
    {
        $note = new Note;
        $note->text = $request->text;
        $note->save();

        return [
            'success' => true,
            'message' => 'New note with id ' . $note->id . ' has been added',
        ];
    }
}
