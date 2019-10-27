<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Today extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
