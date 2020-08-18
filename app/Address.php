<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    public function addressable()
    {
        return $this->morphTo();
    }
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
    public function state()
    {
        return $this->belongsTo('App\State');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function getAddressFormatAttribute()
    {
        return $this->street.", ".$this->city.", ".$this->state->name.", ".$this->country->name.", ".$this->postal_code;
    }

}
