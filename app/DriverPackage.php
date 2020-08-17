<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DriverPackage extends Pivot
{
    //
    public $incrementing = true;

    public function package(){
        return $this->belongsTo('App\Package');
    }

    public function driver(){
        return $this->belongsTo('App\Driver');
    }
}
