<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
	/**
     * Role relation
     *
     * @return void
     */
    public function promotion()
    {
    	return $this->belongsTo(Promotion::class);
    }

    /**
     * Role relation
     *
     * @return void
     */
    public function beacon()
    {
        return $this->belongsTo(Beacon::class);
    }
}
