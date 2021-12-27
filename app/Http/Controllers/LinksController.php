<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinksController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function show()
    {
        return view('pages.links.index', [
            'page' => 'links',
        ]);
    }

    public function index()
    {
        return [
            'links' => Link::with('tags')->where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function new(Request $request)
    {
        $link = new Link;
        $link->user_id = Auth::user()->id;
        $link->link = $request->link;
        $link->comment = $request->comment;
        $link->save();

        if (!empty(trim($request->tags))) {
            $tags = explode(" ", $request->tags);
            foreach ($tags as $tag) {
                $link->tags()->attach($tag);
            }
        }

        return [
            'success' => true,
            'message' => 'new link has been added',
        ];
    }

    public function delete($id)
    {
        $link = Link::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($link) {
            $link->delete();
            return [
                'success' => true,
                'message' => "Link with id $id has been deleted",
            ];
        }

        return [
            'success' => false,
            'message' => "Link with id $id is not found",
        ];
    }
}
