<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    /**
     * Role relation
     *
     * @return void
     */
    public function broadcasts()
    {
        return $this->hasMany(Broadcast::class);
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
