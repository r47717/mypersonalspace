<?php

namespace App\Http\Controllers;

use App\Services\TodayService;
use App\Models\Today;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodayController extends Controller
{
    /**
     * @var TodayService
     */
    private $todayService;

    /**
     * TodayController constructor.
     * @param TodayService $todayService
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
            'data' => $this->todayService->getTodaysToday(Auth::user()),
        ];
    }

    public function save(Request $request)
    {
        $today = $this->todayService->getTodaysToday(Auth::user()) ?? new Today;
        $today->mood = $request->mood;
        $today->idea = $request->idea;
        $today->accomplishments = $request->accomplishments;
        $today->thanks = $request->thanks;
        $today->nothanks = $request->nothanks;
        $today->user_id = Auth::user()->id;
        $today->save();

        return [
            'success' => true,
            'message' => 'data has been saved',
        ];
    }
}
