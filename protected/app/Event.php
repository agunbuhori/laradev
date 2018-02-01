<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{	
    /**
     * Role relation
     *
     * @return void
     */
    public function mall()
    {
        return $this->belongsTo(Mall::class);
    }

    /**
     * Get picture attribute
     *
     * @return void
     */
    public function getPictureAttribute($value)
    {
    	return asset('pics/'.$value);
    }
}
