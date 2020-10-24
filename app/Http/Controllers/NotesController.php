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
        return view('pages.notes.index', [
            'page' => 'notes',
            'notes' => Note::where('user_id', Auth::user()->id)->get(),
        ]);
    }

    public function add(Request $request)
    {
        $note = new Note;
        $note->text = $request->newNote;
        $note->user_id = Auth::user()->id;
        $note->save();

        return redirect('/notes');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $note = Note::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($note) {
            $note->text = $request->newText;
            $note->save();
        }

        return redirect('/notes');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $note = Note::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($note) {
            $note->delete();
            return redirect('/notes');
        }
    }

}
