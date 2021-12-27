<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        return [
            'tags' => Tag::where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function new(Request $request)
    {
        $tag = new Tag;
        $tag->user_id = Auth::user()->id;
        $tag->tag = $request->newTag;
        $tag->save();

        return [
            'success' => true,
            'message' => "Tag $tag->tag added",
        ];
    }

    public function delete(Request $request)
    {
        $tag = tag::find($request->id);
        if (!empty($tag)) {
            $tag->delete();
            return [
                'success' => true,
                'message' => "Tag $tag->tag deleted",
            ];
        }

        return [
            'success' => false,
            'message' => "Tag $tag->tag is not found",
        ];
    }
}
