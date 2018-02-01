<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	/**
     * Role relation
     *
     * @return void
     */
    public function authorizations()
    {
    	return $this->hasMany(Authorization::class);
    }
}
