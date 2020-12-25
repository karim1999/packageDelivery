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
        return $this->belongsTo('App\Customer', 'address_from');
    }

    public function addressTo()
    {
        return $this->belongsTo('App\Customer', 'address_to');
    }

    public function getStatusAttribute()
    {
        $drivers= $this->drivers()->count();
        if($drivers > 0){
            return $this->drivers[$drivers - 1]->pivot->status;
        }else{
            return "Not Assigned";
        }
    }
    public function getDimensionsAttribute()
    {
        return $this->height."cm x".$this->width."cm x".$this->length;
    }
    public function getCurrentDriverAttribute()
    {
        $drivers= $this->drivers()->count();
        if($drivers > 0){
            return $this->drivers[$drivers - 1];
        }else{
            return false;
        }
    }

}
