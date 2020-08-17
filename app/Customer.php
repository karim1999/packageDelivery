<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public function address()
    {
        return $this->morphOne('App\Address', 'addressable');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
