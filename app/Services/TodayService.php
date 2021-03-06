<?php

namespace App\Services;


use App\Models\Today;

class TodayService
{
    function getTodaysToday($user)
    {
        return Today::whereDate('created_at', date('Y-m-d'))->where('user_id', $user->id)->first();
    }
}
