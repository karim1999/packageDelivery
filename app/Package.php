<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Plank\Metable\Metable;

class Package extends Model
{
    use Metable;
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function drivers()
    {
        return $this->belongsToMany('App\Driver', 'driver_packages')->using('App\DriverPackage')->withPivot(['status'])->withTimestamps();
    }

    public function addressFrom()
    {
        return $this->belongsTo('App\Address', 'address_from');
    }

    public function addressTo()
    {
        return $this->belongsTo('App\Address', 'address_to');
    }


}
