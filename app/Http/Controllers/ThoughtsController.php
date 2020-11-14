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

    public function show()
    {
        return view('pages.thoughts.index', [
            'page' => 'thoughts',
        ]);
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

        if (!empty(trim($request->tags))) {
            $tags = explode(" ", $request->tags);
            foreach ($tags as $tag) {
                $thought->tags()->attach($tag);
            }
        }

        return [
            'success' => true,
            'message' => 'new thought has been added',
        ];
    }

    public function delete($id)
    {
        $thought = Thought::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($thought) {
            $thought->delete();
            return [
                'success' => true,
                'message' => "Thought with id $id has been deleted",
            ];
        }

        return [
            'success' => false,
            'message' => "Thought with id $id is not found",
        ];
    }
}
