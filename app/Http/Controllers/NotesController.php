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

    /**
     * NotesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('pages.notes.index', [
            'page' => 'notes',
        ]);
    }

    public function index(Request $request)
    {
        $notes = Note::with('tags')->where('user_id', Auth::user()->id)->get();

        return [
            'notes' => $notes,
        ];
    }

    public function add(Request $request)
    {
        if (!empty(trim($request->note)) && static::typeIsValid($request->type)) {
            $note = new Note;
            $note->text = $request->note;
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

        return [];
    }

    public static function typeIsValid($typeToCheck)
    {
        return array_key_exists($typeToCheck, static::$types);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $note = Note::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($note && !empty(trim($request->newNote)) && static::typeIsValid($request->type)) {
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
