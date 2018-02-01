<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    /**
     * Beacon relation
     *
     * @return void
     */
    public function beacons()
    {
    	return $this->hasMany(Beacon::class);
    }
}
