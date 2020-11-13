<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('pages.quotes.index', [
            'page' => 'quotes',
        ]);
    }

    public function index()
    {
        return [
            'quotes' => Quote::where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function new(Request $request)
    {
        $quote = new Quote;
        $quote->user_id = Auth::user()->id;
        $quote->quote = $request->quote;
        $quote->author = $request->author;
        $quote->save();

        return [];
    }

    public function delete(Request $request)
    {
        $quote = Quote::find($request->id);
        if (!empty($quote)) {
            $quote->delete();
        }

        return [];
    }
}
