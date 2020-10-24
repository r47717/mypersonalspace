<?php

namespace App\Http\Controllers;

use App\Cit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.cit.index', [
            'page' => 'cit',
            'cits' => Cit::where('user_id', Auth::user()->id)->get(),
        ]);
    }

    public function new(Request $request)
    {
        $cit = new Cit;
        $cit->user_id = Auth::user()->id;
        $cit->cit = $request->newCit;
        $cit->author = $request->author;
        $cit->save();

        return redirect('/cit');
    }

    public function delete(Request $request)
    {
        $cit = Cit::find($request->id);
        if (!empty($cit)) {
            $cit->delete();
        }

        return redirect('/cit');
    }
}
