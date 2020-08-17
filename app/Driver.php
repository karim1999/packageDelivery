<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;

class Driver extends Authenticatable
{
    //
    use Billable, HasApiTokens, Notifiable;

    protected $guard = 'drivers';

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->using('App\UserDriver')->withPivot(['status'])->withTimestamps();
    }

    public function packages()
    {
        return $this->belongsToMany('App\Package')->using('App\DriverPackage')->withPivot(['status'])->withTimestamps();
    }

}
