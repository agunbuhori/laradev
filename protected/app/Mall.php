<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    /**
     * Get picture attribute
     *
     * @return void
     */
    public function getPictureAttribute($value)
    {
        return asset('pics/'.$value);
    }
    
    /**
     * Merchant relation
     *
     * @return void
     */
    public function merchants()
    {
    	return $this->hasMany(Merchant::class);
    }

    /**
     * Beacon relation
     *
     * @return void
     */
    public function beacons()
    {
    	return $this->hasMany(Beacon::class);
    }

    /**
     * Beacon relation
     *
     * @return void
     */
    public function broadcasts()
    {
        return $this->hasManyThrough(Broadcast::class, Beacon::class);
    }

    /**
     * Beacon relation
     *
     * @return void
     */
    public function parking_lots()
    {
        return $this->hasMany(ParkingLot::class);
    }

    /**
     * Beacon relation
     *
     * @return void
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Beacon relation
     *
     * @return void
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
