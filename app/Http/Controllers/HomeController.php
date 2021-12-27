<?php

namespace App\Http\Controllers;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.home.index', [
            'page' => 'today',
        ]);
    }
}
