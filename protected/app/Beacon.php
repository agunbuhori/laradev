<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beacon extends Model
{
    /**
     * Promotion relation
     *
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    /**
     * Promotion relation
     *
     * @return void
     */
    public function broadcasts()
    {
    	return $this->hasMany(Broadcast::class);
    }

    /**
     * Promotion relation
     *
     * @return void
     */
    public function promotions()
    {
    	
    }

    /**
     * Promotion relation
     *
     * @return void
     */
    public function mall()
    {
        return $this->belongsTo(Mall::class);
    }

    /**
     * Promotion relation
     *
     * @return void
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
