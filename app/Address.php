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
        if ($this->type == "Manual"){
            return $this->street.", ".$this->city.", ".$this->state->name.", ".$this->country->name.", ".$this->postal_code;
        }else{
            return $this->name." (".$this->latitude.", ".$this->longitude.")";
        }
    }
    public function getAddressFormatWithLinkAttribute()
    {
        if ($this->type == "Manual"){
            return $this->getAddressFormatAttribute();
        }else{
            return '<a target="_blank" href="http://www.google.com/maps/place/'.$this->latitude.','.$this->longitude.'">'.$this->getAddressFormatAttribute().'</a>';
        }
    }

}
