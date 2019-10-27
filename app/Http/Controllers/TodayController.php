<?php

namespace App\Http\Controllers;

use App\Services\TodayService;
use App\Today;
use Illuminate\Http\Request;

class TodayController extends Controller
{
    /**
     * @var TodayService
     */
    private $todayService;

    /**
     * TodayController constructor.
     */
    public function __construct(TodayService $todayService)
    {
        $this->middleware('auth');
        $this->todayService = $todayService;
    }


    public function index()
    {
        return [
            'success' => true,
            'data' => $this->todayService->getTodaysToday(),
        ];
    }

    public function save(Request $request)
    {
        $today = $this->todayService->getTodaysToday() ?? new Today;
        $today->mood = $request->mood;
        $today->idea = $request->idea;
        $today->accomplishments = $request->accomplishments;
        $today->thanks = $request->thanks;
        $today->nothanks = $request->nothanks;
        $today->save();

        return [
            'success' => true,
            'message' => 'data has been saved',
        ];
    }
}
