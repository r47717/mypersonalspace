<?php

namespace App\Http\Controllers;

use App\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementsController extends Controller
{

    /**
     * AchievementsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('pages.achievements.index', [
            'page' => 'achievements',
        ]);
    }

    public function index()
    {
        return [
            'achievements' => Achievement::with('tags')->where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function add(Request $request)
    {
        $achievement = new Achievement;
        $achievement->achievement = $request->achievement;
        $achievement->user_id = Auth::user()->id;
        $achievement->save();

        if (!empty(trim($request->tags))) {
            $tags = explode(" ", $request->tags);
            foreach ($tags as $tag) {
                $achievement->tags()->attach($tag);
            }
        }

        return [
            'success' => true,
            'message' => 'new achievement has been added',
        ];
    }

    public function delete($id)
    {
        $achievement = Achievement::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($achievement) {
            $achievement->delete();
            return [
                'success' => true,
                'message' => "Achievement with id $id has been deleted",
            ];
        }

        return [
            'success' => false,
            'message' => "Achievement with id $id is not found",
        ];
    }
}
