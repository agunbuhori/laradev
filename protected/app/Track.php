<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    public function store()
    {
    	return $this->belongsTo(Store::class);
    }
}
