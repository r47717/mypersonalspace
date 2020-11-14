<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public static $types = [
        'generic' => ['обычная', 'обычные'],
        'list' => ['список', 'списки'],
        'reminder' => ['напоминание', 'напоминания'],
        'experience' => ['опыт', 'опыт'],
        'wish' => ['желание', 'желания'],
    ];

    public static function typeIsValid($typeToCheck) {
        foreach (NotesController::$types as $type => $data) {
            if ($typeToCheck === $type) {
                return true;
            }
        }

        return false;
    }


    /**
     * NotesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (empty($request->type) || $request->type === 'all' || !NotesController::typeIsValid($request->type)) {
            $notes = Note::where('user_id', Auth::user()->id)->get();
            $filter = 'all';
        } else {
            $notes = Note::where('user_id', Auth::user()->id)->where('type', $request->type)->get();
            $filter = $request->type;
        }

        return view('pages.notes.index', [
            'page' => 'notes',
            'notes' => $notes,
            'types' => NotesController::$types,
            'filter' => $filter,
        ]);
    }

    public function add(Request $request)
    {
        if (!empty(trim($request->newNote)) && NotesController::typeIsValid($request->type)) {
            $note = new Note;
            $note->text = $request->newNote;
            $note->type = $request->type;
            $note->user_id = Auth::user()->id;
            $note->save();

            if (!empty(trim($request->tags))) {
                $tags = explode(" ", $request->tags);
                foreach ($tags as $tag) {
                    $note->tags()->attach($tag);
                }
            }
        }


        return redirect('/notes');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $note = Note::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($note && !empty(trim($request->newNote)) && NotesController::typeIsValid($request->type)) {
            $note->text = $request->newText;
            $note->type = $request->type;
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
