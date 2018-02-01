<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    /**
     * Module relation
     *
     * @return void
     */
    public function module()
    {
    	return $this->belongsTo(Module::class);
    }
}
