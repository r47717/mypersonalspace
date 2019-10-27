<?php

namespace App\Http\Controllers;

use App\Services\TodayService;

class HomeController extends Controller
{
    /**
     * @var TodayService
     */
    private $todayService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TodayService $todayService)
    {
        $this->middleware('auth');
        $this->todayService = $todayService;
    }

    protected function renderHome($page)
    {
        return view('home', [
            'page' => $page,
        ]);
    }

    public function index()
    {
        return $this->renderHome('today');
    }
}
