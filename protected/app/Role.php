<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Authorization relation
     *
     * @return void
     */
    public function authorizations()
    {
        return $this->hasMany(Authorization::class);
    }
}
