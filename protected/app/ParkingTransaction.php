<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingTransaction extends Model
{
    public $timestamps = false;
    /**
     * Role relation
     *
     * @return void
     */
    public function vehicle()
    {
    	return $this->belongsTo(Vehicle::class);
    }
    

    /**
     * Beacon relation
     *
     * @return void
     */
    public function parking_lot()
    {
    	return $this->belongsTo(ParkingLot::class);
    }
}
