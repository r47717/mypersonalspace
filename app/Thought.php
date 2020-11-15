<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thought extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'thought_tag');
    }
}
