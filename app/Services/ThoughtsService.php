<?php

namespace App\Services;

use App\Models\Thought;
use Illuminate\Support\Facades\Auth;

class ThoughtsService
{
    public function __construct()
    {
    }

    function newThought(string $text, bool $unique = false)
    {
        if ($unique && Thought::where('text', $text)->first()) {
            return null;
        }

        $thought = new Thought;
        $thought->text = $text;
        $thought->user_id = Auth::user()->id;
        $thought->save();

        return $thought;
    }
}
