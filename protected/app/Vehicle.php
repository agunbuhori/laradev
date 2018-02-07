<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function tracks()
    {
    	return $this->hasMany(Track::class);
    }
}
