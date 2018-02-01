<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingLot extends Model
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
     * Role relation
     *
     * @return void
     */
    public function parking_transactions()
    {
    	return $this->hasMany(ParkingTransaction::class);
    }
}
