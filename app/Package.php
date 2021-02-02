<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Plank\Metable\Metable;

class Package extends Model
{
    use Metable;
    //
    protected $appends = ['status'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function drivers()
    {
        return $this->belongsToMany('App\Driver', 'driver_packages')->using('App\DriverPackage')->withPivot(['status'])->withTimestamps();
    }
    public function driversPackages()
    {
        return $this->belongsToMany('App\DriverPackage', 'package_id','id');
    }

    public function addressFrom()
    {
        return $this->belongsTo('App\Customer', 'customer_from');
    }

    public function addressTo()
    {
        return $this->belongsTo('App\Customer', 'customer_to');
    }

    public function customerFrom()
    {
        return $this->belongsTo('App\Customer', 'customer_from');
    }

    public function customerTo()
    {
        return $this->belongsTo('App\Customer', 'customer_to');
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
