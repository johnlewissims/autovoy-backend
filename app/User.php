<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Address;
use App\Listing;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'last_name', 'first_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function pickupAddresses()
    {
        return $this->belongsToMany('App\Address', 'address_listing_user', 'pickup_address_id', 'user_id');
    }
    public function dropoffAddresses()
    {
        return $this->belongsToMany('App\Address', 'address_listing_user', 'dropoff_address_id', 'user_id');
    }
    public function listings()
    {
        return $this->belongsToMany('App\Listing', 'address_listing_user', 'listing_id', 'user_id');
    }
}
