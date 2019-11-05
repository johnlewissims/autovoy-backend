<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $fillable = [
        'user_id', 'listing_id', 'street_number', 'street', 'city', 'state', 'country', 'postal_code', 'postal_code_suffix'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
