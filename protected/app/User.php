<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Role relation
     *
     * @return void
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

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
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
