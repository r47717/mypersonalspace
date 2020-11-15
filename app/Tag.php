<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class);
    }

    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }

    public function quotes()
    {
        return $this->belongsToMany(Quote::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function thoughts()
    {
        return $this->belongsToMany(Thought::class, 'thought_tag');
    }

    public function links()
    {
        return $this->belongsToMany(Link::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
