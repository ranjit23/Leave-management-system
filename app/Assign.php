<?php

namespace App;

class Assign extends Model
{
    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }
}
