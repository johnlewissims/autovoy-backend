<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
  protected $fillable = [
      'user_id', 'pickup_address_id', 'dropoff_address_id', 'listing_id', 'title'
  ];
  public function pickupAddress()
  {
      return $this->belongsToMany('App\Address', 'address_listing_user', 'pickup_address_id', 'listing_id');
  }
  public function dropoffAddress()
  {
      return $this->belongsToMany('App\Address', 'address_listing_user', 'dropoff_address_id', 'listing_id');
  }
  public function users()
  {
      return $this->belongsToMany('App\User', 'address_listing_user', 'user_id', 'listing_id');
  }
}
