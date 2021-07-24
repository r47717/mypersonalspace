<?php

namespace App\Services;


use App\Models\Today;

class TodayService
{
    public function __construct()
    {
    }

    function getTodaysToday($user): Today
    {
        return Today::whereDate('created_at', date('Y-m-d'))->where('user_id', $user->id)->first();
    }
}
