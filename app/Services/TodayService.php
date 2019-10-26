<?php
namespace App\Services;


use App\Today;

class TodayService
{
    function getTodaysToday() {
        return Today::whereDate('created_at', date('Y-m-d'))->first();
    }
}
