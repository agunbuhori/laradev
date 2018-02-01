<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
	/**
	 * Get type attribute
	 *
	 * @return void
	 */
    public function getTypeAttribute($value)
    {
    	return ucwords($value);
    }

    /**
     * User relation
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
