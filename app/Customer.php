<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public function address()
    {
        return $this->belongsTo('App\Address');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
