<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function vehicles()
    {
    	return $this->hasMany(Vehicle::class);
    }

    public function maker()
    {
    	return $this->belongsTo(Maker::class);
    }
}
