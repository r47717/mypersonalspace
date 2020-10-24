<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.links.index', [
            'page' => 'links',
            'links' => Link::where('user_id', Auth::user()->id)->get(),
        ]);
    }

    public function new(Request $request)
    {
        $link = new Link;
        $link->user_id = Auth::user()->id;
        $link->link = $request->newLink;
        $link->comment = $request->comment;
        $link->save();

        return redirect('/links');
    }

    public function delete(Request $request)
    {
        $link = Link::find($request->id);
        if (!empty($link)) {
            $link->delete();
        }

        return redirect('/links');
    }
}
