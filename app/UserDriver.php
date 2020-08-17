<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserDriver extends Pivot
{
    public $incrementing = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function driver(){
        return $this->belongsTo('App\Driver');
    }
}
