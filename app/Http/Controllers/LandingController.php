<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('layouts.landing');
    }
}
