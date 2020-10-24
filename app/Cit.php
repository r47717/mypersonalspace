<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cit extends Model
{
    protected $table = "cit";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
