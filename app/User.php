<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Cashier\Billable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Address;
use App\Listing;

class User extends Authenticatable implements JWTSubject
{
    use Billable;
    use Notifiable;

    protected $fillable = [
        'last_name', 'first_name', 'email', 'password', 'phone_number'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [ 'phone_number' ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function listings()
    {
        return $this->hasMany('App\Listing');
    }
    public function addresses()
    {
        return $this->hasMany('App\Address');
    }
    //Add Phone Number
    public function getPhoneNumberAttribute()
    {
        $data = $this->attributes['phone_number'];
        return "(".substr($data, 0, 3).") ".substr($data, 3, 3)."-".substr($data,6);
    }
}
