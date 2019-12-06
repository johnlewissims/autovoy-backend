<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $fillable = [
        'user_id', 'listing_id', 'street_number', 'street', 'city', 'state', 'country', 'postal_code', 'postal_code_suffix'
    ];


    public function users()
    {
        return $this->belongsToMany('User');
    }
    public function listings()
    {
        return $this->belongsToMany('Listing');
    }
}
