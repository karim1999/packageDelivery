<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function drivers()
    {
        return $this->belongsToMany('App\Driver')->using('App\DriverPackage')->withPivot(['status'])->withTimestamps();
    }

    public function addressFrom()
    {
        return $this->morphOne('App\Address', 'addressable');
    }

    public function addressTo()
    {
        return $this->morphOne('App\Address', 'addressable');
    }


}
