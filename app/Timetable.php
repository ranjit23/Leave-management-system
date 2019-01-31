<?php

namespace App;

class Timetable extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
